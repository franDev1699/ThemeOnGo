<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ThemeOnGo_Timeline_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'themeongo_timeline';
	}

	public function get_title() {
		return esc_html__( 'ThemeOnGo Timeline', 'themeongo' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Timeline Items', 'themeongo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'year',
			[
				'label' => esc_html__( 'Badge Text (e.g. Year)', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '202X',
			]
		);

		$repeater->add_control(
			'badge_color',
			[
				'label' => esc_html__( 'Badge Background Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#8FAFA2',
			]
		);

		$repeater->add_control(
			'badge_text_color',
			[
				'label' => esc_html__( 'Badge Text Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Lorem Ipsum Dolor',
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.',
			]
		);

		$repeater->add_control(
			'dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#506F67',
			]
		);

		$repeater->add_control(
			'dot_border_color',
			[
				'label' => esc_html__( 'Dot Border Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#D1AF8B',
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Timeline Items', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'year' => '201X',
						'title' => 'Lorem Ipsum Dolor',
						'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.',
						'badge_color' => '#8FAFA2',
					],
					[
						'year' => 'Ahora',
						'title' => 'Sit Amet Consectetur',
						'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'badge_color' => '#D1AF8B',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'themeongo' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'line_color',
			[
				'label' => esc_html__( 'Line Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#D1AF8B',
				'selectors' => [
					'{{WRAPPER}} .tgo-timeline::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2A2C2B',
				'selectors' => [
					'{{WRAPPER}} .tgo-timeline-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6c757d',
				'selectors' => [
					'{{WRAPPER}} .tgo-timeline-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['items'] ) ) {
			return;
		}

		echo '<div class="tgo-timeline-container">';
		echo '<div class="tgo-timeline">';

		foreach ( $settings['items'] as $item ) {
			$badge_bg = !empty($item['badge_color']) ? 'background-color: ' . esc_attr($item['badge_color']) . ';' : '';
			$badge_c = !empty($item['badge_text_color']) ? 'color: ' . esc_attr($item['badge_text_color']) . ';' : '';
			$badge_style = $badge_bg . $badge_c;

			$dot_c = !empty($item['dot_color']) ? 'background-color: ' . esc_attr($item['dot_color']) . ';' : '';
			$dot_b = !empty($item['dot_border_color']) ? 'border-color: ' . esc_attr($item['dot_border_color']) . ';' : '';
			$dot_style = $dot_c . $dot_b;

			echo '<div class="tgo-timeline-item">';
			echo '<div class="tgo-timeline-dot" style="' . $dot_style . '"></div>';
			echo '<div class="tgo-timeline-content">';
			
			if ( ! empty( $item['year'] ) ) {
				echo '<span class="tgo-timeline-badge" style="' . $badge_style . '">' . esc_html( $item['year'] ) . '</span>';
			}

			if ( ! empty( $item['title'] ) ) {
				echo '<h3 class="tgo-timeline-title">' . esc_html( $item['title'] ) . '</h3>';
			}

			if ( ! empty( $item['description'] ) ) {
				echo '<div class="tgo-timeline-desc">' . wp_kses_post( $item['description'] ) . '</div>';
			}

			echo '</div>'; // end tgo-timeline-content
			echo '</div>'; // end tgo-timeline-item
		}

		echo '</div>'; // end tgo-timeline
		echo '</div>'; // end tgo-timeline-container
	}
}
