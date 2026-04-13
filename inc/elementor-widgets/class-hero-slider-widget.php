<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeOnGo_Hero_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'themeongo_hero_slider';
    }

    public function get_title() {
        return __( 'ThemeOnGo Hero Slider', 'themeongo' );
    }

    public function get_icon() {
        return 'eicon-slideshow';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'slides_section',
            [
                'label' => __( 'Slides', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slides_list',
            [
                'label' => __( 'Slider Images', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => 'Slide Item',
            ]
        );

        $this->add_control(
            'slider_interval',
            [
                'label' => __( 'Interval (ms)', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4000,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'badge_section',
            [
                'label' => __( 'Floating Badge', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __( 'Show Badge', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'themeongo' ),
                'label_off' => __( 'No', 'themeongo' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'badge_icon',
            [
                'label' => __( 'Icon (FA Class)', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'fa-solid fa-leaf',
                'condition' => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_title',
            [
                'label' => __( 'Title', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Lorem Ipsum',
                'condition' => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_subtitle',
            [
                'label' => __( 'Subtitle', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Dolor sit amet',
                'condition' => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Slider Style', 'themeongo' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '20',
                    'right' => '100',
                    'bottom' => '20',
                    'left' => '100',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} .carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_height',
            [
                'label' => __( 'Max Height', 'themeongo' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 900,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 650,
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-item img' => 'max-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    '{{WRAPPER}} .carousel-inner' => 'max-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $interval = absint( $settings['slider_interval'] );
        $slides = $settings['slides_list'];
        $slider_id = 'heroCarousel_' . $this->get_id();

        if ( empty( $slides ) ) {
            return;
        }
        ?>
        <div class="position-relative d-inline-block w-100 parallax-element" data-speed="0.05">
            <div id="<?php echo esc_attr( $slider_id ); ?>" class="carousel slide carousel-fade position-relative shadow-lg"
                 data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr( $interval ); ?>">
                
                <div class="carousel-indicators" style="bottom: 15px; z-index: 15;">
                    <?php foreach ( $slides as $index => $slide ) : ?>
                        <button type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
                    <?php endforeach; ?>
                </div>
                
                <div class="carousel-inner" style="overflow: hidden;">
                    <?php foreach ( $slides as $index => $slide ) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?> w-100">
                            <img src="<?php echo esc_url( $slide['image']['url'] ); ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="prev" style="z-index: 15;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr( $slider_id ); ?>" data-bs-slide="next" style="z-index: 15;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
            <?php if ( 'yes' === $settings['show_badge'] ) : ?>
            <div class="floating-badge position-absolute glass-panel rounded-4 px-4 py-3 d-flex align-items-center parallax-element" data-speed="0.1" style="bottom: 30px; left: -40px; z-index: 20;">
                <div class="rounded-circle bg-light-green text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; box-shadow: 0 4px 10px rgba(139,163,158,0.4);">
                    <i class="<?php echo esc_attr( $settings['badge_icon'] ); ?>"></i>
                </div>
                <div class="text-start">
                    <h6 class="mb-0 fw-bold text-dark fs-6"><?php echo esc_html( $settings['badge_title'] ); ?></h6>
                    <small class="text-muted"><?php echo esc_html( $settings['badge_subtitle'] ); ?></small>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
