<?php
/**
 * Blog Posts Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

class Blog_Posts extends Widget_Base {

	public function get_name() {
		return 'blog_posts';
	}

	public function get_title() {
		return __( 'Blog Posts', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
			'category',
			[
				'label' => __( 'Category', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
				'options' => $this->get_categories_list(),
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

        $this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'ai-dev-theme' ),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				],
			]
		);

        $this->end_controls_section();
	}

    protected function get_categories_list() {
        $categories = get_categories( [
            'orderby' => 'name',
            'order'   => 'ASC',
        ] );

        $options = [];
        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                $options[ $category->term_id ] = $category->name;
            }
        }
        return $options;
    }

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = [
			'post_type'      => 'post',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
		];

        if ( ! empty( $settings['category'] ) ) {
            $args['category__in'] = $settings['category'];
        }

		$query = new WP_Query( $args );

        $columns = $settings['columns'];

		if ( $query->have_posts() ) :
			?>
			<div class="grid grid--auto-fit gap-lg" style="--grid-min-width: <?php echo 100 / $columns * 0.8; ?>%;">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="fade-in-up h-100">
						<?php get_template_part( 'template-parts/content/content' ); ?>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php
		else :
			echo '<p>' . esc_html__( 'No posts found.', 'ai-dev-theme' ) . '</p>';
		endif;
	}
}
