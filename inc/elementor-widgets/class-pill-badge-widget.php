<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeOnGo_Pill_Badge_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'themeongo_pill_badge';
    }

    public function get_title() {
        return __( 'ThemeOnGo Pill Badge', 'themeongo' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __( 'Text', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Clínica Estética Premium',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'themeongo' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'themeongo' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'themeongo' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Badge Styles', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color
        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Color de Fondo', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'var(--chloe-gold)', // default del tema
                'selectors' => [
                    '{{WRAPPER}} .themeongo-pill-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Text Color
        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color de Texto', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .themeongo-pill-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .themeongo-pill-badge',
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __( 'Padding', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => '10',
                    'right' => '20',
                    'bottom' => '10',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .themeongo-pill-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .themeongo-pill-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Shadow', 'themeongo' ),
                'selector' => '{{WRAPPER}} .themeongo-pill-badge',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $text = esc_html( $settings['badge_text'] );
        ?>
        <div class="themeongo-pill-badge-container">
            <span class="badge themeongo-pill-badge d-inline-block fw-medium tracking-wide" style="line-height: 1.5;">
                <?php echo $text; ?>
            </span>
        </div>
        <?php
    }
}
