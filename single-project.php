<?php
/**
 * The template for displaying all single projects
 *
 * @package AI_Dev_Theme
 */

get_header();

while ( have_posts() ) :
	the_post();
    
    // Get taxonomy terms
    $technologies = get_the_terms( get_the_ID(), 'technology' );
    $industries   = get_the_terms( get_the_ID(), 'industry' );
    
    // Get custom fields (example placeholders for now)
    $client_name = get_post_meta( get_the_ID(), 'project_client', true );
    $project_url = get_post_meta( get_the_ID(), 'project_url', true );
	?>

	<main id="primary" class="site-main">

        <!-- Hero Section -->
        <section class="project-hero alignfull">
            <div class="container">
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    
                    <div class="project-meta">
                        <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                            <span class="project-meta__item">
                                <span class="project-meta__label"><?php esc_html_e( 'Industry:', 'ai-dev-theme' ); ?></span>
                                <?php 
                                $industry_names = wp_list_pluck( $industries, 'name' );
                                echo esc_html( implode( ', ', $industry_names ) ); 
                                ?>
                            </span>
                        <?php endif; ?>

                        <?php if ( $client_name ) : ?>
                            <span class="project-meta__item">
                                <span class="project-meta__label"><?php esc_html_e( 'Client:', 'ai-dev-theme' ); ?></span>
                                <?php echo esc_html( $client_name ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>
            </div>
            
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="project-hero__image">
                    <?php the_post_thumbnail( 'full' ); ?>
                </div>
            <?php endif; ?>
        </section>

		<div class="container project-content-wrapper">
            <div class="project-main-content">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <aside class="project-sidebar">
                <div class="project-details-card">
                    <h3><?php esc_html_e( 'Project Details', 'ai-dev-theme' ); ?></h3>
                    
                    <?php if ( ! empty( $technologies ) && ! is_wp_error( $technologies ) ) : ?>
                        <div class="project-detail-group">
                            <h4><?php esc_html_e( 'Technologies', 'ai-dev-theme' ); ?></h4>
                            <div class="tags-list">
                                <?php foreach ( $technologies as $tech ) : ?>
                                    <span class="badge badge--tech"><?php echo esc_html( $tech->name ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $project_url ) : ?>
                        <div class="project-action">
                            <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener noreferrer" class="button button--primary button--block">
                                <?php esc_html_e( 'Visit Live Site', 'ai-dev-theme' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
		</div>

        <!-- Related Projects Navigation -->
        <div class="container">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ai-dev-theme' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ai-dev-theme' ) . '</span> <span class="nav-title">%title</span>',
                )
            );
            ?>
        </div>

	</main>

<?php
endwhile; // End of the loop.

get_footer();
