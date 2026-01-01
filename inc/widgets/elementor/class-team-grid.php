<?php
/**
 * Team Grid Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Team_Grid extends Widget_Base {

	public function get_name() {
		return 'team_grid';
	}

	public function get_title() {
		return __( 'Team Grid', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Team Members', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => __( 'Name', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'ai-dev-theme' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'position',
			[
				'label' => __( 'Position', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'AI Engineer', 'ai-dev-theme' ),
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

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Bio', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => __( 'Expert in machine learning and neural networks.', 'ai-dev-theme' ),
			]
		);

        // Social Links
		$repeater->add_control(
			'linkedin',
			[
				'label' => __( 'LinkedIn URL', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://linkedin.com/in/...', 'ai-dev-theme' ),
			]
		);

        $repeater->add_control(
			'twitter',
			[
				'label' => __( 'Twitter URL', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com/...', 'ai-dev-theme' ),
			]
		);

        $repeater->add_control(
			'github',
			[
				'label' => __( 'GitHub URL', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://github.com/...', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'members',
			[
				'label' => __( 'Members List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Jane Smith', 'ai-dev-theme' ),
						'position' => __( 'Lead Data Scientist', 'ai-dev-theme' ),
					],
                    [
						'name' => __( 'Mike Ross', 'ai-dev-theme' ),
						'position' => __( 'Full Stack Developer', 'ai-dev-theme' ),
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
		<div class="team-grid grid grid--auto-fit gap-lg">
			<?php foreach ( $settings['members'] as $index => $item ) : 
				$image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : Utils::get_placeholder_image_src();
				?>
				<div class="card team-card fade-in-up text-center p-lg" style="animation-delay: <?php echo $index * 100; ?>ms;">
					<div class="team-card__image mb-md" style="width: 120px; height: 120px; margin-left: auto; margin-right: auto; border-radius: 50%; overflow: hidden; border: 2px solid var(--color-primary); box-shadow: var(--glow-primary);">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    
                    <h3 class="team-card__name mb-xs" style="font-size: 1.25rem;"><?php echo esc_html( $item['name'] ); ?></h3>
                    <p class="team-card__position mb-sm" style="color: var(--color-primary); font-family: var(--font-secondary); font-size: 0.875rem; text-transform: uppercase;"><?php echo esc_html( $item['position'] ); ?></p>
                    
                    <p class="team-card__bio mb-md" style="font-size: 0.9rem; color: var(--color-text-muted);"><?php echo esc_html( $item['description'] ); ?></p>
                    
                    <div class="team-card__social d-flex justify-center gap-sm">
                        <?php if ( ! empty( $item['linkedin']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['linkedin']['url'] ); ?>" target="_blank" class="button button--secondary" style="padding: 0.5em; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $item['twitter']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['twitter']['url'] ); ?>" target="_blank" class="button button--secondary" style="padding: 0.5em; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ( ! empty( $item['github']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['github']['url'] ); ?>" target="_blank" class="button button--secondary" style="padding: 0.5em; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-github"></i>
                            </a>
                        <?php endif; ?>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
