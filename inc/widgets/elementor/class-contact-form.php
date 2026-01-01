<?php
/**
 * Contact Form Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Contact_Form extends Widget_Base {

	public function get_name() {
		return 'ai_contact_form';
	}

	public function get_title() {
		return __( 'AI Contact Form', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ai-dev-theme' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'       => __( 'Form Title', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Send us a message', 'ai-dev-theme' ),
				'placeholder' => __( 'Type your title here', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'form_shortcode',
			[
				'label'       => __( 'Form Shortcode', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( '[contact-form-7 id="123"...]', 'ai-dev-theme' ),
                'description' => __( 'Paste your Contact Form 7 or other form shortcode here. If empty, a default HTML form will be displayed.', 'ai-dev-theme' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="ai-contact-form-widget card p-xl border-primary" style="background: rgba(11, 16, 38, 0.8);">
            <?php if ( $settings['form_title'] ) : ?>
			    <h3 class="h4 mb-lg text-center"><?php echo esc_html( $settings['form_title'] ); ?></h3>
            <?php endif; ?>

            <?php if ( $settings['form_shortcode'] ) : ?>
                <div class="contact-form-shortcode">
                    <?php echo do_shortcode( $settings['form_shortcode'] ); ?>
                </div>
            <?php else : ?>
                <!-- Default Form Fallback -->
                <form class="contact-form">
                    <div class="mb-md">
                        <label for="name" class="form-label"><?php esc_html_e( 'Name', 'ai-dev-theme' ); ?></label>
                        <input type="text" id="name" class="form-control" placeholder="<?php esc_attr_e( 'Your Name', 'ai-dev-theme' ); ?>">
                    </div>
                    <div class="mb-md">
                        <label for="email" class="form-label"><?php esc_html_e( 'Email', 'ai-dev-theme' ); ?></label>
                        <input type="email" id="email" class="form-control" placeholder="<?php esc_attr_e( 'your@email.com', 'ai-dev-theme' ); ?>">
                    </div>
                    <div class="mb-lg">
                        <label for="message" class="form-label"><?php esc_html_e( 'Message', 'ai-dev-theme' ); ?></label>
                        <textarea id="message" class="form-control" rows="5" placeholder="<?php esc_attr_e( 'How can we help you?', 'ai-dev-theme' ); ?>"></textarea>
                    </div>
                    <button type="submit" class="button button--primary w-100">
                        <i class="fas fa-paper-plane me-2"></i><?php esc_html_e( 'Send Message', 'ai-dev-theme' ); ?>
                    </button>
                </form>
            <?php endif; ?>
		</div>
		<?php
	}
}
