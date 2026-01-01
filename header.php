        <div class="container d-flex align-center justify-between">
            <?php get_template_part( 'template-parts/header/branding' ); ?>
            
            <div class="header-actions d-flex align-center">
                <?php get_template_part( 'template-parts/header/navigation' ); ?>
                <button class="theme-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'ai-dev-theme' ); ?>">
                    <span class="theme-toggle-icon"></span>
                </button>
            </div>
        </div>