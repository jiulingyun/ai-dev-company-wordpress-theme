<?php
/**
 * AI SEO Features
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class AI_SEO {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_action( 'add_meta_boxes', [ $this, 'add_seo_meta_box' ] );
		add_action( 'save_post', [ $this, 'save_seo_meta_box' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

    public function enqueue_admin_scripts() {
        // Enqueue admin styles/scripts if needed
    }

	public function add_seo_meta_box() {
		$screens = [ 'post', 'page', 'project' ];
		foreach ( $screens as $screen ) {
			add_meta_box(
				'ai_seo_meta',
				__( 'AI SEO Optimization', 'ai-dev-theme' ),
				[ $this, 'render_seo_meta_box' ],
				$screen,
				'side',
				'default'
			);
		}
	}

	public function render_seo_meta_box( $post ) {
		wp_nonce_field( 'ai_seo_meta_action', 'ai_seo_meta_nonce' );

		$seo_title       = get_post_meta( $post->ID, '_ai_seo_title', true );
		$seo_description = get_post_meta( $post->ID, '_ai_seo_description', true );
		$seo_keywords    = get_post_meta( $post->ID, '_ai_seo_keywords', true );
		?>
		<div class="ai-seo-meta-box">
            <div class="mb-3">
                <button type="button" class="button button-primary w-100" id="ai-generate-seo">
                    <span class="dashicons dashicons-superhero-alt me-1"></span>
                    <?php esc_html_e( 'Auto-Generate with AI', 'ai-dev-theme' ); ?>
                </button>
                <p class="description small mt-1">
                    <?php esc_html_e( 'Let our AI agents analyze your content and generate optimized meta tags.', 'ai-dev-theme' ); ?>
                </p>
            </div>

            <hr>

			<p>
				<label for="ai_seo_title"><strong><?php esc_html_e( 'SEO Title', 'ai-dev-theme' ); ?></strong></label>
				<input type="text" id="ai_seo_title" name="ai_seo_title" value="<?php echo esc_attr( $seo_title ); ?>" class="widefat" placeholder="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>">
			</p>

			<p>
				<label for="ai_seo_description"><strong><?php esc_html_e( 'SEO Description', 'ai-dev-theme' ); ?></strong></label>
				<textarea id="ai_seo_description" name="ai_seo_description" class="widefat" rows="3"><?php echo esc_textarea( $seo_description ); ?></textarea>
			</p>

            <p>
				<label for="ai_seo_keywords"><strong><?php esc_html_e( 'Focus Keywords', 'ai-dev-theme' ); ?></strong></label>
				<input type="text" id="ai_seo_keywords" name="ai_seo_keywords" value="<?php echo esc_attr( $seo_keywords ); ?>" class="widefat" placeholder="<?php esc_html_e( 'e.g. AI, Development, WordPress', 'ai-dev-theme' ); ?>">
			</p>
		</div>
        <script>
        jQuery(document).ready(function($) {
            $('#ai-generate-seo').on('click', function(e) {
                e.preventDefault();
                var $btn = $(this);
                $btn.addClass('updating-message').text('<?php esc_html_e( 'Analyzing Content...', 'ai-dev-theme' ); ?>');
                
                // Simulate AI delay
                setTimeout(function() {
                    // Simple logic to generate description from content if empty
                    var content = $('#content').val();
                    var title = $('#title').val();
                    
                    if (!content && typeof wp !== 'undefined' && wp.editor) {
                        content = wp.editor.getContent('content');
                    }

                    // Strip HTML
                    var strippedContent = content ? content.replace(/(<([^>]+)>)/gi, "") : "";
                    
                    // Generate Mock Data
                    var mockDesc = strippedContent.substring(0, 150) + '...';
                    
                    $('#ai_seo_title').val(title + ' | AI Dev Company');
                    if(mockDesc) $('#ai_seo_description').val(mockDesc);
                    $('#ai_seo_keywords').val('AI, Tech, Future');
                    
                    $btn.removeClass('updating-message').text('<?php esc_html_e( 'Regenerate', 'ai-dev-theme' ); ?>');
                    alert('<?php esc_html_e( 'AI SEO Meta Tags Generated!', 'ai-dev-theme' ); ?>');
                }, 1500);
            });
        });
        </script>
		<?php
	}

	public function save_seo_meta_box( $post_id ) {
		if ( ! isset( $_POST['ai_seo_meta_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['ai_seo_meta_nonce'], 'ai_seo_meta_action' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['ai_seo_title'] ) ) {
			update_post_meta( $post_id, '_ai_seo_title', sanitize_text_field( $_POST['ai_seo_title'] ) );
		}

		if ( isset( $_POST['ai_seo_description'] ) ) {
			update_post_meta( $post_id, '_ai_seo_description', sanitize_textarea_field( $_POST['ai_seo_description'] ) );
		}

        if ( isset( $_POST['ai_seo_keywords'] ) ) {
			update_post_meta( $post_id, '_ai_seo_keywords', sanitize_text_field( $_POST['ai_seo_keywords'] ) );
		}
	}
}
