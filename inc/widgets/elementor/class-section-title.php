<?php
/**
 * Section Title Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Section_Title extends Widget_Base {

	public function get_name() {
		return 'ai_section_title';
	}

	public function get_title() {
		return __( 'AI Section Title', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-heading';
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
			'subtitle',
			[
				'label'       => __( 'Subtitle (Small)', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Our Features', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title (Large)', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Why Choose Us', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'align',
			[
				'label'   => __( 'Alignment', 'ai-dev-theme' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => __( 'Left', 'ai-dev-theme' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ai-dev-theme' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ai-dev-theme' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $align_class = 'text-' . $settings['align'];
		?>
		<div class="section-header mb-xl fade-in-up <?php echo esc_attr( $align_class ); ?>">
            <?php if ( $settings['subtitle'] ) : ?>
			    <span class="d-block text-primary h6 text-uppercase letter-spacing-sm mb-2"><?php echo esc_html( $settings['subtitle'] ); ?></span>
            <?php endif; ?>
            
            <?php if ( $settings['title'] ) : ?>
			    <h2 class="h2 mb-0"><?php echo esc_html( $settings['title'] ); ?></h2>
            <?php endif; ?>
		</div>
		<?php
	}
}
