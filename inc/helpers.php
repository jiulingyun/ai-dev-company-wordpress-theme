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
