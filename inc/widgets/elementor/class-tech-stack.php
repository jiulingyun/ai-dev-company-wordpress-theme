<?php
/**
 * Tech Stack Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Tech_Stack extends Widget_Base {

	public function get_name() {
		return 'tech_stack';
	}

	public function get_title() {
		return __( 'Tech Stack', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Technologies', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Technology Name', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'React', 'ai-dev-theme' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'ai-dev-theme' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-react',
					'library' => 'brands',
				],
			]
		);

		$repeater->add_control(
			'url',
			[
				'label' => __( 'Link', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ai-dev-theme' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'technologies',
			[
				'label' => __( 'Technologies List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'React', 'ai-dev-theme' ),
						'icon' => [ 'value' => 'fab fa-react', 'library' => 'brands' ],
					],
					[
						'name' => __( 'Python', 'ai-dev-theme' ),
						'icon' => [ 'value' => 'fab fa-python', 'library' => 'brands' ],
					],
					[
						'name' => __( 'AWS', 'ai-dev-theme' ),
						'icon' => [ 'value' => 'fab fa-aws', 'library' => 'brands' ],
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="tech-stack-grid grid grid--auto-fit gap-md text-center">
			<?php foreach ( $settings['technologies'] as $index => $item ) : 
				$target = $item['url']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['url']['nofollow'] ? ' rel="nofollow"' : '';
				$tag = ! empty( $item['url']['url'] ) ? 'a' : 'div';
				$href = ! empty( $item['url']['url'] ) ? ' href="' . esc_url( $item['url']['url'] ) . '"' . $target . $nofollow : '';
				?>
				<<?php echo $tag . $href; ?> class="card tech-card p-md d-flex flex-column align-center justify-center fade-in-up" style="animation-delay: <?php echo $index * 50; ?>ms;">
					<div class="tech-icon mb-sm" style="font-size: 2.5rem; color: var(--color-primary);">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<span class="tech-name" style="font-family: var(--font-secondary); font-size: 0.9rem; font-weight: 600;"><?php echo esc_html( $item['name'] ); ?></span>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
