<?php
/**
 * Support FAQ Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Support_FAQ extends Widget_Base {

    public function get_name() {
        return 'ai_faq';
    }

    public function get_title() {
        return __( 'Support FAQ', 'ai-dev-theme' );
    }

    public function get_icon() {
        return 'eicon-help';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label'       => __( 'Question', 'ai-dev-theme' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'What is your refund policy?', 'ai-dev-theme' ),
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label'       => __( 'Answer', 'ai-dev-theme' ),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => __( 'We offer a 30-day money-back guarantee for most products.', 'ai-dev-theme' ),
            ]
        );

        $this->add_control(
            'faqs',
            [
                'label'       => __( 'FAQs', 'ai-dev-theme' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'question' => __( 'What is your refund policy?', 'ai-dev-theme' ),
                        'answer'   => __( 'We offer a 30-day money-back guarantee for most products.', 'ai-dev-theme' ),
                    ],
                    [
                        'question' => __( 'How do I contact support?', 'ai-dev-theme' ),
                        'answer'   => __( 'Use the support form or email support@example.com.', 'ai-dev-theme' ),
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['faqs'] ) ) {
            return;
        }

        ?>
        <div class="ai-faq">
            <div class="container">
                <div class="accordion" id="ai-faq-accordion-<?php echo esc_attr( $this->get_id() ); ?>">
                    <?php
                    $index = 0;
                    foreach ( $settings['faqs'] as $faq ) :
                        $index++;
                        $q_id = 'ai-faq-' . $this->get_id() . '-' . $index;
                        ?>
                        <div class="accordion-item mb-md">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $q_id ); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr( $q_id ); ?>">
                                    <?php echo esc_html( $faq['question'] ); ?>
                                </button>
                            </h3>
                            <div id="<?php echo esc_attr( $q_id ); ?>" class="accordion-collapse collapse" data-bs-parent="#ai-faq-accordion-<?php echo esc_attr( $this->get_id() ); ?>">
                                <div class="accordion-body">
                                    <?php echo wp_kses_post( $faq['answer'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script>
        (function(){
            // Lightweight accordion behaviour for themes without Bootstrap JS
            var accId = "ai-faq-accordion-<?php echo esc_js( $this->get_id() ); ?>";
            var accordion = document.getElementById(accId);
            if (!accordion) return;

            // Initialize display state for collapses
            var collapses = accordion.querySelectorAll('.accordion-collapse');
            collapses.forEach(function(col){
                if (col.classList.contains('show')) {
                    col.style.display = 'block';
                    var btn = accordion.querySelector('[data-bs-target="#' + col.id + '"]');
                    if (btn) {
                        btn.classList.remove('collapsed');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                } else {
                    col.style.display = 'none';
                    var btn = accordion.querySelector('[data-bs-target="#' + col.id + '"]');
                    if (btn) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            function closeAllExcept(exceptId) {
                collapses.forEach(function(item){
                    if (item.id === exceptId) return;
                    item.classList.remove('show');
                    item.style.display = 'none';
                    var btn = accordion.querySelector('[data-bs-target="#' + item.id + '"]');
                    if (btn) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            var buttons = accordion.querySelectorAll('.accordion-button');
            buttons.forEach(function(btn){
                btn.addEventListener('click', function(e){
                    var targetSelector = btn.getAttribute('data-bs-target') || btn.getAttribute('data-target');
                    if (!targetSelector) return;
                    var target;
                    try {
                        target = document.querySelector(targetSelector);
                    } catch (err) {
                        return;
                    }
                    if (!target) return;

                    var isShown = target.classList.contains('show');
                    var parent = target.getAttribute('data-bs-parent') || null;
                    if (isShown) {
                        target.classList.remove('show');
                        target.style.display = 'none';
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                    } else {
                        if (parent) {
                            closeAllExcept(target.id);
                        }
                        target.classList.add('show');
                        target.style.display = 'block';
                        btn.classList.remove('collapsed');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        })();
        </script>
        <?php
    }
}


