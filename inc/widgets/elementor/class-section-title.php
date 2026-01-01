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
			'description',
			[
				'label'       => __( 'Description (Grey)', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'End-to-end solutions powered by intelligence', 'ai-dev-theme' ),
                'rows'        => 2,
			]
		);

        $this->add_control(
			'link_text',
			[
				'label'       => __( 'Button Text', 'ai-dev-theme' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'View All', 'ai-dev-theme' ),
                'separator'   => 'before',
			]
		);

        $this->add_control(
			'link_url',
			[
				'label'       => __( 'Button Link', 'ai-dev-theme' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ai-dev-theme' ),
				'default'     => [
					'url' => '#',
				],
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
        
        // Flex alignment classes for the header container if button exists
        $header_class = 'section-header mb-xl fade-in-up';
        if ( ! empty( $settings['link_text'] ) && ! empty( $settings['link_url']['url'] ) ) {
            $header_class .= ' d-flex justify-between align-end';
            // Override alignment if button exists to standard split layout
            $align_class = 'text-left'; 
        } else {
            $header_class .= ' ' . $align_class;
        }
		?>
		<div class="<?php echo esc_attr( $header_class ); ?>">
            <div>
                <?php if ( $settings['subtitle'] ) : ?>
                    <span class="d-block text-primary h6 text-uppercase letter-spacing-sm mb-2"><?php echo esc_html( $settings['subtitle'] ); ?></span>
                <?php endif; ?>
                
                <?php if ( $settings['title'] ) : ?>
                    <h2 class="h2 mb-0"><?php echo esc_html( $settings['title'] ); ?></h2>
                <?php endif; ?>

                <?php if ( $settings['description'] ) : ?>
                    <p class="section-subtitle mt-sm text-muted"><?php echo esc_html( $settings['description'] ); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $settings['link_text'] ) && ! empty( $settings['link_url']['url'] ) ) : 
                $target = $settings['link_url']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $settings['link_url']['nofollow'] ? ' rel="nofollow"' : '';
                ?>
                <a href="<?php echo esc_url( $settings['link_url']['url'] ); ?>" class="button button--secondary"<?php echo $target . $nofollow; ?>>
                    <?php echo esc_html( $settings['link_text'] ); ?>
                </a>
            <?php endif; ?>
		</div>
		<?php
	}
}
