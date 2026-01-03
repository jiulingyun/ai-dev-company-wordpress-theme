<?php
/**
 * Theme helpers.
 *
 * @package AI_Dev_Theme
 */

if ( ! function_exists( 'ai_dev_theme_get_instance' ) ) {
	/**
	 * Get theme instance.
	 *
	 * @return \AI_Dev_Theme\Inc\Classes\AI_Dev_Theme
	 */
	function ai_dev_theme_get_instance() {
		return \AI_Dev_Theme\Inc\Classes\AI_Dev_Theme::get_instance();
	}
}

/**
 * Admin: Language filter dropdown for Polylang (posts/pages/projects).
 * Shows a language selector in the admin list table and provides a sensible default.
 */
if ( ! function_exists( 'ai_dev_theme_admin_language_filters' ) ) {
	/**
	 * Output language dropdown on edit screens for supported post types.
	 *
	 * @param string $post_type Current post type.
	 */
	function ai_dev_theme_admin_language_filters( $post_type ) {
		// Only run in admin edit list screens.
		if ( ! is_admin() ) {
			return;
		}

		// Determine which post types we want this for.
		$target_post_types = array( 'post', 'page' );
		if ( post_type_exists( 'project' ) ) {
			$target_post_types[] = 'project';
		}

		if ( ! in_array( $post_type, $target_post_types, true ) ) {
			return;
		}

		$languages = array();

		// Prefer Polylang API if available.
		if ( function_exists( 'pll_languages_list' ) ) {
			// pll_languages_list( array( 'fields' => 'slug' ) ) returns an array of slugs
			$pll_slugs = pll_languages_list( array( 'fields' => 'slug' ) );
			if ( ! empty( $pll_slugs ) && is_array( $pll_slugs ) ) {
				foreach ( $pll_slugs as $slug ) {
					$name = $slug;
					if ( function_exists( 'pll_get_language_name' ) ) {
						$name = pll_get_language_name( $slug );
					}
					$languages[ $slug ] = $name;
				}
			}
		} elseif ( taxonomy_exists( 'language' ) ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'language',
					'hide_empty' => false,
				)
			);
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$languages[ $term->slug ] = $term->name;
				}
			}
		}

		// If we don't have any languages, bail.
		if ( empty( $languages ) ) {
			return;
		}

		$current = isset( $_GET['lang'] ) ? sanitize_text_field( wp_unslash( $_GET['lang'] ) ) : '';

		echo '<select name="lang" id="filter-by-language" class="postform" style="margin-left:6px;">';
		echo '<option value="">' . esc_html__( 'All languages', 'ai-dev-theme' ) . '</option>';
		foreach ( $languages as $slug => $label ) {
			printf(
				'<option value="%s"%s>%s</option>',
				esc_attr( $slug ),
				selected( $current, $slug, false ),
				esc_html( $label )
			);
		}
		echo '</select>';
	}
	add_action( 'restrict_manage_posts', 'ai_dev_theme_admin_language_filters' );
}

if ( ! function_exists( 'ai_dev_theme_admin_default_language_filter' ) ) {
	/**
	 * Apply default language filter on admin lists when no explicit lang is provided.
	 *
	 * @param WP_Query $query Admin WP_Query instance.
	 */
	function ai_dev_theme_admin_default_language_filter( $query ) {
		// Only affect admin main queries on edit screens.
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		global $pagenow;
		if ( 'edit.php' !== $pagenow ) {
			return;
		}

		$post_type = $query->get( 'post_type' );
		if ( empty( $post_type ) ) {
			$post_type = isset( $_GET['post_type'] ) ? sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) : 'post';
		}

		$target_post_types = array( 'post', 'page' );
		if ( post_type_exists( 'project' ) ) {
			$target_post_types[] = 'project';
		}

		if ( ! in_array( $post_type, $target_post_types, true ) ) {
			return;
		}

		// If user explicitly selected a language, don't override.
		if ( isset( $_GET['lang'] ) && '' !== trim( wp_unslash( $_GET['lang'] ) ) ) {
			return;
		}

		$default_lang = '';
		if ( function_exists( 'pll_default_language' ) ) {
			$default_lang = pll_default_language();
		} elseif ( taxonomy_exists( 'language' ) ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'language',
					'hide_empty' => false,
					'number'     => 1,
				)
			);
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				$default_lang = $terms[0]->slug;
			}
		}

		if ( ! empty( $default_lang ) ) {
			$query->set( 'lang', $default_lang );
		}
	}
	add_action( 'pre_get_posts', 'ai_dev_theme_admin_default_language_filter' );
}

/**
 * Required plugins admin notice and quick actions (Elementor, Polylang).
 *
 * This shows a persistent admin notice prompting installation/activation
 * and provides direct install/activate links for users with proper capability.
 */
if ( ! function_exists( 'ai_dev_theme_required_plugins' ) ) {
	/**
	 * Return required plugins list.
	 *
	 * @return array
	 */
	function ai_dev_theme_required_plugins() {
		return array(
			array(
				'slug'      => 'elementor',
				'file'      => 'elementor/elementor.php',
				'name'      => 'Elementor',
			),
			array(
				'slug'      => 'polylang',
				'file'      => 'polylang/polylang.php',
				'name'      => 'Polylang',
			),
		);
	}
}

if ( ! function_exists( 'ai_dev_theme_required_plugins_notice' ) ) {
	/**
	 * Render admin notice for missing/disabled required plugins.
	 */
	function ai_dev_theme_required_plugins_notice() {
		if ( ! is_admin() ) {
			return;
		}

		$required = ai_dev_theme_required_plugins();
		if ( empty( $required ) ) {
			return;
		}

		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		$missing = array();
		foreach ( $required as $plugin ) {
			$slug = $plugin['slug'];
			$file = $plugin['file'];
			$name = $plugin['name'];

			if ( is_plugin_active( $file ) ) {
				continue;
			}

			$installed = file_exists( WP_PLUGIN_DIR . '/' . $slug );

			$missing[] = array(
				'slug'      => $slug,
				'file'      => $file,
				'name'      => $name,
				'installed' => $installed,
			);
		}

		if ( empty( $missing ) ) {
			// All good.
			return;
		}

		// Only show to users who can manage plugins.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			?>
			<div class="notice notice-warning">
				<p><?php esc_html_e( 'AI Dev Theme requires Elementor and Polylang to be installed and activated. Please contact the site administrator.', 'ai-dev-theme' ); ?></p>
			</div>
			<?php
			return;
		}

		// Build action links.
		$actions = array();
		foreach ( $missing as $m ) {
			if ( $m['installed'] ) {
				// Provide activate link.
				$activate_url = wp_nonce_url(
					self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $m['file'] ) ),
					'activate-plugin_' . $m['file']
				);
				$actions[] = sprintf( '<a class="button button-primary" href="%s">%s</a>', esc_url( $activate_url ), esc_html( sprintf( __( 'Activate %s', 'ai-dev-theme' ), $m['name'] ) ) );
			} else {
				// Provide install link.
				$install_url = wp_nonce_url(
					self_admin_url( 'update.php?action=install-plugin&plugin=' . rawurlencode( $m['slug'] ) ),
					'install-plugin_' . $m['slug']
				);
				$actions[] = sprintf( '<a class="button button-primary" href="%s">%s</a>', esc_url( $install_url ), esc_html( sprintf( __( 'Install %s', 'ai-dev-theme' ), $m['name'] ) ) );
			}
		}

		?>
		<div class="notice notice-error is-dismissible">
			<p>
				<strong><?php esc_html_e( 'AI Dev Theme requires additional plugins', 'ai-dev-theme' ); ?></strong><br/>
				<?php esc_html_e( 'For full functionality please install and activate the following plugins:', 'ai-dev-theme' ); ?>
			</p>
			<p>
				<?php
				foreach ( $missing as $m ) {
					echo esc_html( $m['name'] ) . ' ';
					if ( $m['installed'] ) {
						echo '<em>(' . esc_html__( 'installed, needs activation', 'ai-dev-theme' ) . ')</em>';
					} else {
						echo '<em>(' . esc_html__( 'not installed', 'ai-dev-theme' ) . ')</em>';
					}
					echo '<br/>';
				}
				?>
			</p>
			<p><?php echo implode( ' ', $actions ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'ai_dev_theme_required_plugins_notice' );
}

/**
 * Autoloader function.
 */
function ai_dev_theme_autoloader( $resource ) {
	$namespace_root   = 'AI_Dev_Theme\\';
	$resource         = trim( $resource, '\\' );

	if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
		// Not our namespace, bail out.
		return;
	}

	// Remove our root namespace.
	$resource = str_replace( $namespace_root, '', $resource );

	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/**
	 * Time to determine which type of resource path it is,
	 * so that we can deduce the correct file path for it.
	 */
	if ( empty( $path[0] ) || empty( $path[1] ) ) {
		return;
	}

	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[0] ) {

		switch ( $path[1] ) {
			case 'traits':
				$directory = 'inc/traits';
				$file_name = sprintf( 'trait-%s', trim( $path[2] ) );
				break;

			case 'widgets':
			case 'blocks': // phpcs:ignore PSR2.ControlStructures.SwitchDeclaration.TerminatingComment
				/**
				 * If there is class name provided for specific directory then load that.
				 * otherwise find in inc/ directory.
				 */
				if ( ! empty( $path[2] ) ) {
					$directory = sprintf( 'inc/%s', $path[1] );
					$file_name = sprintf( 'class-%s', trim( $path[2] ) );
					break;
				}
			default:
				$directory = 'inc/classes';
				$file_name = sprintf( 'class-%s', trim( $path[count( $path ) - 1] ) );
				break;
		}

		$resource_path = sprintf( '%s/%s/%s.php', untrailingslashit( get_template_directory() ), $directory, $file_name );

	}

	if ( empty( $resource_path ) ) {
		return;
	}

	/**
	 * If $is_valid_file has 0 means valid path or 2 means the file does not exist.
	 */
	$is_valid_file = validate_file( $resource_path );

	if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		// We already checked for existence of file.
		require_once( $resource_path ); // phpcs:ignore
	}
}

spl_autoload_register( 'ai_dev_theme_autoloader' );

if ( ! function_exists( 'ai_dev_theme_breadcrumbs' ) ) {
	/**
	 * Simple breadcrumb generator.
	 */
	function ai_dev_theme_breadcrumbs() {
		echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'ai-dev-theme' ) . '">';
		echo '<ul class="breadcrumbs-list">';
		// Home
		echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'ai-dev-theme' ) . '</a></li>';

		if ( is_home() || is_front_page() ) {
			// nothing more
		} elseif ( is_category() ) {
			$cat = get_queried_object();
			if ( $cat && ! is_wp_error( $cat ) ) {
				// include link to blog home if different
				$blog_page_id = get_option( 'page_for_posts' );
				if ( $blog_page_id ) {
					echo '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $blog_page_id ) ) . '">' . esc_html__( 'Blog', 'ai-dev-theme' ) . '</a></li>';
				}
				echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html( $cat->name ) . '</li>';
			}
		} elseif ( is_single() ) {
			$cats = get_the_category();
			if ( ! empty( $cats ) ) {
				$first = $cats[0];
				echo '<li class="breadcrumb-item"><a href="' . esc_url( get_category_link( $first->term_id ) ) . '">' . esc_html( $first->name ) . '</a></li>';
			}
			echo '<li class="breadcrumb-item current" aria-current="page">' . get_the_title() . '</li>';
		} elseif ( is_post_type_archive() ) {
			echo '<li class="breadcrumb-item current" aria-current="page">' . post_type_archive_title( '', false ) . '</li>';
		} elseif ( is_archive() ) {
			echo '<li class="breadcrumb-item current" aria-current="page">' . get_the_archive_title() . '</li>';
		} else {
			echo '<li class="breadcrumb-item current" aria-current="page">' . get_the_title() . '</li>';
		}

		echo '</ul>';
		echo '</nav>';
	}
}
