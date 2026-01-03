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
