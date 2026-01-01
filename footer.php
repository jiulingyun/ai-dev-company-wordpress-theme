<?php
/**
 * The template for displaying the footer
 *
 * @package AI_Dev_Theme
 */

?>

	<footer id="colophon" class="site-footer bg-darker pt-xl pb-lg mt-auto border-top border-light-subtle position-relative overflow-hidden">
        <!-- Decorative background elements -->
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden pointer-events-none" style="z-index: 0;">
            <div class="position-absolute top-0 end-0 bg-primary opacity-10 blur-3xl rounded-circle" style="width: 400px; height: 400px; transform: translate(30%, -30%);"></div>
            <div class="position-absolute bottom-0 start-0 bg-secondary opacity-10 blur-3xl rounded-circle" style="width: 300px; height: 300px; transform: translate(-30%, 30%);"></div>
        </div>

        <div class="container position-relative z-1">
            <!-- Top Footer / Widgets -->
            <div class="row mb-xl">
                <div class="col-lg-4 col-md-6 mb-lg mb-lg-0">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <div class="footer-branding mb-md">
                            <?php
                            if ( has_custom_logo() ) {
                                the_custom_logo();
                            } else {
                                ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="d-flex align-center text-decoration-none">
                                    <span class="site-title h3 mb-0 text-white"><?php bloginfo( 'name' ); ?></span>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <p class="text-muted mb-md"><?php bloginfo( 'description' ); ?></p>
                        <div class="social-links d-flex gap-md">
                            <?php
                            $twitter  = get_theme_mod( 'footer_social_twitter', '#' );
                            $github   = get_theme_mod( 'footer_social_github', '#' );
                            $linkedin = get_theme_mod( 'footer_social_linkedin', '#' );
                            
                            if ( $twitter ) : ?>
                                <a href="<?php echo esc_url( $twitter ); ?>" class="text-muted hover-primary transition-colors" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter fa-lg"></i></a>
                            <?php endif;
                            
                            if ( $github ) : ?>
                                <a href="<?php echo esc_url( $github ); ?>" class="text-muted hover-primary transition-colors" target="_blank" rel="noopener noreferrer"><i class="fab fa-github fa-lg"></i></a>
                            <?php endif;
                            
                            if ( $linkedin ) : ?>
                                <a href="<?php echo esc_url( $linkedin ); ?>" class="text-muted hover-primary transition-colors" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin fa-lg"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-2 col-md-6 mb-lg mb-lg-0">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php else : ?>
                        <h4 class="h6 text-white mb-md text-uppercase letter-spacing-sm"><?php esc_html_e( 'Company', 'ai-dev-theme' ); ?></h4>
                        <ul class="list-unstyled text-muted footer-links">
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'About Us', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Careers', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Blog', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Contact', 'ai-dev-theme' ); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="col-lg-2 col-md-6 mb-lg mb-lg-0">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    <?php else : ?>
                        <h4 class="h6 text-white mb-md text-uppercase letter-spacing-sm"><?php esc_html_e( 'Resources', 'ai-dev-theme' ); ?></h4>
                        <ul class="list-unstyled text-muted footer-links">
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Documentation', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'API Reference', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Community', 'ai-dev-theme' ); ?></a></li>
                            <li class="mb-sm"><a href="#" class="text-decoration-none text-muted hover-white transition-colors"><?php esc_html_e( 'Support', 'ai-dev-theme' ); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 col-md-6">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    <?php else : ?>
                        <h4 class="h6 text-white mb-md text-uppercase letter-spacing-sm"><?php esc_html_e( 'Newsletter', 'ai-dev-theme' ); ?></h4>
                        <p class="text-muted mb-md"><?php esc_html_e( 'Subscribe to our newsletter for the latest updates.', 'ai-dev-theme' ); ?></p>
                        <form class="footer-newsletter">
                            <div class="input-group">
                                <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="<?php esc_attr_e( 'Email address', 'ai-dev-theme' ); ?>">
                                <button class="button button--primary" type="button"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="row pt-lg border-top border-secondary border-opacity-25 align-center">
                <div class="col-md-6 mb-md mb-md-0">
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. 
                        <?php 
                        /* translators: %s: Theme author. */
                        printf( esc_html__( 'Theme by %s.', 'ai-dev-theme' ), 'AI Dev' ); 
                        ?>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'list-unstyled d-flex gap-lg justify-content-md-end mb-0',
                            'container'      => false,
                            'depth'          => 1,
                            'link_before'    => '<span class="text-muted hover-white transition-colors" style="font-size: 0.9rem;">',
                            'link_after'     => '</span>',
                        ) );
                    }
                    ?>
                </div>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
