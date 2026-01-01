<?php
/**
 * Project Showcase Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

class Project_Showcase extends Widget_Base {

	public function get_name() {
		return 'project_showcase';
	}

	public function get_title() {
		return __( 'Project Showcase', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'ai-dev-theme' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'ai-dev-theme' ),
					'title' => __( 'Title', 'ai-dev-theme' ),
					'rand' => __( 'Random', 'ai-dev-theme' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'DESC', 'ai-dev-theme' ),
					'ASC' => __( 'ASC', 'ai-dev-theme' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = [
			'post_type'      => 'project',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
		];

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
			?>
			<div class="grid grid--auto-fit gap-lg">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="fade-in-up">
						<?php get_template_part( 'template-parts/projects/card' ); ?>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php
		else :
			echo '<p>' . esc_html__( 'No projects found.', 'ai-dev-theme' ) . '</p>';
		endif;
	}
}
