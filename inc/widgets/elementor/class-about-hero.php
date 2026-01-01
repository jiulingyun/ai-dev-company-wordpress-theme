<?php
/**
 * About Hero Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class About_Hero extends Widget_Base {

	public function get_name() {
		return 'ai_about_hero';
	}

	public function get_title() {
		return __( 'AI About Hero', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-banner';
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
			'title',
			[
				'label'       => __( 'Title', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'About Us', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'subtitle',
			[
				'label'       => __( 'Subtitle', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'We are a team of AI enthusiasts building the future.', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'image',
			[
				'label' => __( 'Hero Image', 'ai-dev-theme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="about-hero text-center py-xl">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 mb-md glitch" data-text="<?php echo esc_attr( $settings['title'] ); ?>"><?php echo esc_html( $settings['title'] ); ?></h1>
                        <p class="lead text-muted mb-xl fade-in-up"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                        
                        <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                            <div class="about-hero__image position-relative fade-in-up" style="animation-delay: 0.2s;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-25 blur-3xl rounded-circle" style="z-index: -1;"></div>
                                <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>" class="img-fluid rounded border border-secondary shadow-lg">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
		</div>
		<?php
	}
}
