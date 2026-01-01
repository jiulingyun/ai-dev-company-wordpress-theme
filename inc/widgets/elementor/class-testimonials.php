<?php
/**
 * Testimonials Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Testimonials extends Widget_Base {

	public function get_name() {
		return 'testimonials';
	}

	public function get_title() {
		return __( 'Testimonials', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Testimonials', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'content',
			[
				'label' => __( 'Content', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 4,
				'default' => __( 'AI Dev Theme transformed our business workflow entirely. The AI integration is seamless and powerful.', 'ai-dev-theme' ),
			]
		);

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Name', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Sarah Connor', 'ai-dev-theme' ),
			]
		);

		$repeater->add_control(
			'position',
			[
				'label' => __( 'Position', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'CTO, TechCorp', 'ai-dev-theme' ),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Photo', 'ai-dev-theme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label' => __( 'Testimonials List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'John Smith', 'ai-dev-theme' ),
						'content' => __( 'The best AI theme I have ever used. Highly recommended!', 'ai-dev-theme' ),
					],
                    [
						'name' => __( 'Alice Doe', 'ai-dev-theme' ),
						'content' => __( 'Incredible design and functionality. It saved us months of development time.', 'ai-dev-theme' ),
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
		<div class="testimonials-grid grid grid--auto-fit gap-lg">
			<?php foreach ( $settings['testimonials'] as $index => $item ) : 
				$image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : Utils::get_placeholder_image_src();
				?>
				<div class="card testimonial-card fade-in-up p-lg d-flex flex-column" style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div class="testimonial-icon mb-md" style="font-size: 2rem; color: var(--color-primary); opacity: 0.5;">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    
                    <p class="testimonial-content mb-lg" style="font-size: 1.1rem; font-style: italic; line-height: 1.6; flex-grow: 1;">
                        "<?php echo esc_html( $item['content'] ); ?>"
                    </p>
                    
                    <div class="testimonial-author d-flex align-center gap-md">
                        <div class="testimonial-image" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 1px solid var(--color-border);">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <h4 class="testimonial-name mb-xs" style="font-size: 1rem; margin-bottom: 0;"><?php echo esc_html( $item['name'] ); ?></h4>
                            <span class="testimonial-position" style="font-size: 0.85rem; color: var(--color-text-muted);"><?php echo esc_html( $item['position'] ); ?></span>
                        </div>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
