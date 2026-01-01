<?php
/**
 * Hero Section for Homepage
 *
 * @package AI_Dev_Theme
 */
?>
<section class="hero-home alignfull position-relative overflow-hidden d-flex align-center">
    <!-- Background Effect -->
    <div class="hero-home__bg scanline"></div>
    
    <div class="container position-relative z-index-1">
        <div class="grid grid--12 align-center">
            <div class="hero-home__content grid-column-span-12 grid-column-span-lg-8">
                <h1 class="hero-home__title glitch-text" data-text="BUILDING THE FUTURE WITH AI">
                    BUILDING THE FUTURE WITH AI
                </h1>
                
                <div class="hero-home__subtitle mt-md mb-lg">
                    <span class="typewriter" data-text="Empowering businesses with intelligent software solutions." data-speed="30" data-delay="500"></span>
                </div>
                
                <div class="hero-home__actions d-flex gap-md fade-in-up delay-1000">
                    <a href="#contact" class="button button--primary">
                        <?php esc_html_e( 'Start Project', 'ai-dev-theme' ); ?>
                    </a>
                    <a href="#projects" class="button button--secondary">
                        <?php esc_html_e( 'View Work', 'ai-dev-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
