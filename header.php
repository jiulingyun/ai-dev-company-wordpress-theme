<?php
/**
 * The header for our theme
 *
 * @package AI_Dev_Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
        <div class="container d-flex align-center justify-between">
            <?php get_template_part( 'template-parts/header/branding' ); ?>
            
            <div class="header-actions d-flex align-center">
                <?php get_template_part( 'template-parts/header/navigation' ); ?>
                <button class="theme-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'ai-dev-theme' ); ?>">
                    <span class="theme-toggle-icon"></span>
                </button>
            </div>
        </div>
	</header>
