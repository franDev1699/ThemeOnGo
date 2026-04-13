<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeOnGo_Badge_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'themeongo_badge';
    }

    public function get_title() {
        return __( 'ThemeOnGo Badge (Float)', 'themeongo' );
    }

    public function get_icon() {
        return 'eicon-shape';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Badge Content', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_class',
            [
                'label' => __( 'Icon Class (FontAwesome)', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'fa-solid fa-leaf',
                'description' => 'Example: fa-solid fa-leaf, fa-solid fa-star',
            ]
        );

        $this->add_control(
            'badge_title',
            [
                'label' => __( 'Main Title', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Lorem Ipsum',
            ]
        );

        $this->add_control(
            'badge_subtitle',
            [
                'label' => __( 'Subtitle', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Dolor sit amet',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title = esc_html( $settings['badge_title'] );
        $subtitle = esc_html( $settings['badge_subtitle'] );
        $icon = esc_attr( $settings['icon_class'] );
        ?>
        <div class="floating-badge d-inline-flex glass-panel rounded-4 px-4 py-3 align-items-center shadow-sm">
            <div class="rounded-circle bg-light-green text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; box-shadow: 0 4px 10px rgba(139,163,158,0.4);">
                <i class="<?php echo $icon; ?>"></i>
            </div>
            <div class="text-start">
                <h6 class="mb-0 fw-bold text-dark fs-6"><?php echo $title; ?></h6>
                <small class="text-muted"><?php echo $subtitle; ?></small>
            </div>
        </div>
        <?php
    }
}
