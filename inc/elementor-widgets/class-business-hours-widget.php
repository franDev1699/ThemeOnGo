<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ThemeOnGo_Business_Hours_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'themeongo_business_hours';
	}

	public function get_title() {
		return esc_html__( 'ThemeOnGo Business Hours', 'themeongo' );
	}

	public function get_icon() {
		return 'eicon-clock-o';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'themeongo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Horario de Atención',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Citas con y sin previa programación',
			]
		);
        
        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'fa-regular',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => esc_html__( 'View', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'themeongo' ),
					'stacked' => esc_html__( 'Stacked', 'themeongo' ),
					'framed' => esc_html__( 'Framed', 'themeongo' ),
				],
				'default' => 'stacked',
				'condition' => [
					'icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => esc_html__( 'Shape', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'themeongo' ),
					'square' => esc_html__( 'Square', 'themeongo' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
					'icon[value]!' => '',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'day',
			[
				'label' => esc_html__( 'Day', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Lunes',
			]
		);

		$repeater->add_control(
			'hours',
			[
				'label' => esc_html__( 'Hours', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '9:00 am - 7:00 pm',
			]
		);
        
        $repeater->add_control(
			'is_closed',
			[
				'label' => esc_html__( 'Is Closed?', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'themeongo' ),
				'label_off' => esc_html__( 'No', 'themeongo' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'days_list',
			[
				'label' => esc_html__( 'Days List', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'day' => 'Lunes', 'hours' => '9:00 am - 7:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Martes', 'hours' => '9:00 am - 7:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Miércoles', 'hours' => '9:00 am - 7:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Jueves', 'hours' => '9:00 am - 7:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Viernes', 'hours' => '9:00 am - 7:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Sábado', 'hours' => '9:00 am - 2:00 pm', 'is_closed' => '' ],
					[ 'day' => 'Domingo', 'hours' => 'Cerrado', 'is_closed' => 'yes' ],
				],
				'title_field' => '{{{ day }}}',
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
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .tgo-business-hours' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Icon Primary Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#EAE5DB',
				'selectors' => [
					'{{WRAPPER}} .tgo-bh-icon.view-stacked' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tgo-bh-icon.view-framed' => 'border: 2px solid {{VALUE}}; background-color: transparent;',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3f6771',
				'selectors' => [
					'{{WRAPPER}} .tgo-bh-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tgo-bh-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="tgo-business-hours card-shadow rounded-4 p-4">';
		echo '<div class="tgo-bh-header d-flex align-items-center mb-4">';
        
		$icon_view = $settings['icon_view'] ?? 'stacked';
		$icon_shape = $settings['icon_shape'] ?? 'circle';
		
		$icon_classes = 'tgo-bh-icon d-flex align-items-center justify-content-center me-3 view-' . esc_attr( $icon_view );
		
        if ( 'default' !== $icon_view ) {
            $icon_classes .= ' shape-' . esc_attr( $icon_shape );
            if ( 'circle' === $icon_shape ) {
                $icon_classes .= ' rounded-circle';
            } else {
                $icon_classes .= ' rounded-3';
            }
        }
		
		$icon_style = 'width: 50px; height: 50px; flex-shrink: 0;';
		if ( 'default' === $icon_view ) {
			$icon_style .= ' background-color: transparent !important; width: auto; height: auto; font-size: 28px; padding-right: 5px; margin-right: 15px;';
		}
		
        echo '<div class="' . esc_attr( $icon_classes ) . '" style="' . esc_attr( $icon_style ) . '">';
        \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
        echo '</div>';

        echo '<div class="tgo-bh-titles">';
		echo '<h3 class="tgo-bh-title mb-0 fs-4 fw-normal" style="color: #0b253b;">' . esc_html( $settings['title'] ) . '</h3>';
        echo '<p class="tgo-bh-subtitle mb-0 text-muted" style="font-size: 0.9em;">' . esc_html( $settings['subtitle'] ) . '</p>';
        echo '</div>'; // end tgo-bh-titles
        
		echo '</div>'; // end tgo-bh-header

        if ( ! empty( $settings['days_list'] ) ) {
            echo '<div class="tgo-bh-list">';
            foreach ( $settings['days_list'] as $index => $item ) {
                $closed_class = ( 'yes' === $item['is_closed'] ) ? 'text-dark' : 'fw-medium text-dark';
                $border_class = ( $index === count( $settings['days_list'] ) - 1 ) ? '' : 'border-bottom';
                
                echo '<div class="tgo-bh-item d-flex justify-content-between align-items-center py-3 ' . esc_attr( $border_class ) . '" style="border-color: #f0f0f0 !important;">';
                echo '<span class="tgo-bh-day ' . esc_attr( $closed_class ) . '">' . esc_html( $item['day'] ) . '</span>';
                
                // Color tweaks for open/closed to match image (open hours are darker teal/blue, closed is lighter gray)
                $hours_style = ( 'yes' === $item['is_closed'] ) ? 'color: #b0b8c1;' : 'color: #1c5270;';
                
                echo '<span class="tgo-bh-time fw-medium" style="' . $hours_style . '">' . esc_html( $item['hours'] ) . '</span>';
                echo '</div>';
            }
            echo '</div>';
        }

		echo '</div>'; // end tgo-business-hours
	}
}
