<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found py-3xl bg-dark position-relative overflow-hidden" style="min-height: 80vh; display: flex; align-items: center;">
            <div class="scanline"></div>
            
            <!-- Background Elements -->
            <div class="position-absolute top-50 start-50 translate-middle pointer-events-none">
                <div class="bg-primary opacity-10 blur-3xl rounded-circle" style="width: 600px; height: 600px;"></div>
            </div>

            <div class="container position-relative z-1 text-center">
                <header class="page-header mb-xl">
                    <h1 class="display-1 text-primary glitch mb-md" data-text="404" style="font-size: 8rem; font-weight: 800;">404</h1>
                    <h2 class="page-title h2 mb-md"><?php esc_html_e( 'System Error: Page Not Found', 'ai-dev-theme' ); ?></h2>
                    <div class="terminal-box bg-dark border border-secondary p-md d-inline-block text-start" style="max-width: 600px;">
                        <div class="d-flex gap-xs mb-sm border-bottom border-secondary pb-xs">
                            <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                        </div>
                        <code class="d-block text-muted mb-1">> initiatizing_search_protocol...</code>
                        <code class="d-block text-muted mb-1">> scanning_database...</code>
                        <code class="d-block text-danger mb-1">> error: target_url_not_found</code>
                        <code class="d-block text-white">> _</code>
                    </div>
                </header>

                <div class="page-content">
                    <p class="lead text-muted mb-xl"><?php esc_html_e( 'The requested resource has been moved, deleted, or never existed. Our AI agents are baffled.', 'ai-dev-theme' ); ?></p>
                    
                    <div class="d-flex justify-center gap-md">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button--primary">
                            <i class="fas fa-home me-2"></i><?php esc_html_e( 'Return Home', 'ai-dev-theme' ); ?>
                        </a>
                        <a href="javascript:history.back()" class="button button--outline">
                            <i class="fas fa-arrow-left me-2"></i><?php esc_html_e( 'Go Back', 'ai-dev-theme' ); ?>
                        </a>
                    </div>
                </div>
            </div>
		</section>

	</main>

<?php
get_footer();
