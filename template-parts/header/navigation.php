<?php
/**
 * Template part for displaying navigation
 *
 * @package AI_Dev_Theme
 */
?>
<nav id="site-navigation" class="main-navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <?php esc_html_e( 'Primary Menu', 'ai-dev-theme' ); ?>
    </button>
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container_class'=> 'primary-menu-container',
            'fallback_cb'    => false,
        )
    );
    ?>
</nav>
