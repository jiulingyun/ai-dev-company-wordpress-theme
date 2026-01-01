<?php
/**
 * Template part for displaying site branding
 *
 * @package AI_Dev_Theme
 */
?>
<div class="site-branding">
    <?php
    if ( has_custom_logo() ) {
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
