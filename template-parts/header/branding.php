<?php
/**
 * Template part for displaying site branding
 *
 * @package AI_Dev_Theme
 */
?>
<div class="site-branding">
    <?php
	// Prefer customizer-provided light/dark logos if set
	$logo_light_id = get_theme_mod( 'logo_light' );
	$logo_dark_id  = get_theme_mod( 'logo_dark' );

	// (Debug output removed)

	if ( $logo_light_id || $logo_dark_id ) {
		// Output both images; support both attachment IDs or direct URLs
		if ( $logo_light_id ) {
			if ( is_numeric( $logo_light_id ) ) {
				echo wp_get_attachment_image( intval( $logo_light_id ), 'full', false, array( 'class' => 'site-logo site-logo--light', 'alt' => get_bloginfo( 'name' ) ) );
			} else {
				echo '<img class="site-logo site-logo--light" src="' . esc_url( $logo_light_id ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>';
			}
		}
		if ( $logo_dark_id ) {
			if ( is_numeric( $logo_dark_id ) ) {
				echo wp_get_attachment_image( intval( $logo_dark_id ), 'full', false, array( 'class' => 'site-logo site-logo--dark', 'alt' => get_bloginfo( 'name' ) ) );
			} else {
				echo '<img class="site-logo site-logo--dark" src="' . esc_url( $logo_dark_id ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>';
			}
		}
	} elseif ( has_custom_logo() ) {
        the_custom_logo();
    } elseif ( is_front_page() && is_home() ) {
        ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
    } else {
        ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
    }
    
    $description = get_bloginfo( 'description', 'display' );
    if ( $description || is_customize_preview() ) {
        ?>
        <p class="site-description"><?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php
    }
    ?>
</div>
