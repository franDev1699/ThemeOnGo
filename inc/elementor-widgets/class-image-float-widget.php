<?php
/**
 * ThemeOnGo Image Float Widget
 *
 * Imagen principal con bordes redondeados y dos elementos flotantes opcionales:
 *  1. Tarjeta de estadística (ícono + número + subtexto)
 *  2. Imagen circular superpuesta
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeOnGo_Image_Float_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'themeongo_image_float';
    }

    public function get_title() {
        return __( 'ThemeOnGo Image Float', 'themeongo' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'fontawesome', 'font-awesome-5-all', 'font-awesome-5-solid' ];
    }

    // -------------------------------------------------------------------------
    // CONTROLS
    // -------------------------------------------------------------------------
    protected function register_controls() {

        /* ====================================================
         * SECCIÓN: Imagen Principal
         * ==================================================== */
        $this->start_controls_section(
            'section_main_image',
            [
                'label' => __( 'Imagen Principal', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label'   => __( 'Imagen', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->add_control(
            'main_image_alt',
            [
                'label'   => __( 'Texto Alt', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * SECCIÓN: Tarjeta Flotante (Float A)
         * ==================================================== */
        $this->start_controls_section(
            'section_float_card',
            [
                'label' => __( 'Tarjeta Flotante', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'float_card_enabled',
            [
                'label'        => __( 'Activar Tarjeta', 'themeongo' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Sí', 'themeongo' ),
                'label_off'    => __( 'No', 'themeongo' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'float_card_icon',
            [
                'label'     => __( 'Icono', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'float_card_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_card_value',
            [
                'label'     => __( 'Valor / Número', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '4.9/5',
                'condition' => [ 'float_card_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_card_label',
            [
                'label'     => __( 'Subtexto', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'Reseñas de pacientes',
                'condition' => [ 'float_card_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_card_position',
            [
                'label'   => __( 'Posición', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'top-left',
                'options' => [
                    'top-left'     => __( 'Arriba Izquierda', 'themeongo' ),
                    'top-right'    => __( 'Arriba Derecha', 'themeongo' ),
                    'bottom-left'  => __( 'Abajo Izquierda', 'themeongo' ),
                    'bottom-right' => __( 'Abajo Derecha', 'themeongo' ),
                ],
                'condition' => [ 'float_card_enabled' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * SECCIÓN: Imagen Circular Flotante (Float B)
         * ==================================================== */
        $this->start_controls_section(
            'section_float_circle',
            [
                'label' => __( 'Imagen Circular Flotante', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'float_circle_enabled',
            [
                'label'        => __( 'Activar Imagen Circular', 'themeongo' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Sí', 'themeongo' ),
                'label_off'    => __( 'No', 'themeongo' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'float_circle_image',
            [
                'label'     => __( 'Imagen Circular', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                'condition' => [ 'float_circle_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_circle_alt',
            [
                'label'     => __( 'Texto Alt', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '',
                'condition' => [ 'float_circle_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_circle_position',
            [
                'label'   => __( 'Posición', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom-right',
                'options' => [
                    'top-left'     => __( 'Arriba Izquierda', 'themeongo' ),
                    'top-right'    => __( 'Arriba Derecha', 'themeongo' ),
                    'bottom-left'  => __( 'Abajo Izquierda', 'themeongo' ),
                    'bottom-right' => __( 'Abajo Derecha', 'themeongo' ),
                ],
                'condition' => [ 'float_circle_enabled' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Imagen Principal
         * ==================================================== */
        $this->start_controls_section(
            'style_main_image',
            [
                'label' => __( 'Estilo — Imagen Principal', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_image_border_radius',
            [
                'label'      => __( 'Bordes Redondeados', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'      => '32',
                    'right'    => '32',
                    'bottom'   => '32',
                    'left'     => '32',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-main-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_image_height',
            [
                'label'      => __( 'Altura', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', '%' ],
                'range'      => [
                    'px' => [ 'min' => 100, 'max' => 900 ],
                    'vh' => [ 'min' => 10,  'max' => 100 ],
                    '%'  => [ 'min' => 10,  'max' => 100 ],
                ],
                'default' => [ 'unit' => 'px', 'size' => 480 ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-main-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'main_image_shadow',
                'selector' => '{{WRAPPER}} .tgo-if-main-img',
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Tarjeta Flotante
         * ==================================================== */
        $this->start_controls_section(
            'style_float_card',
            [
                'label'     => __( 'Estilo — Tarjeta Flotante', 'themeongo' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'float_card_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'float_card_bg',
            [
                'label'     => __( 'Color de Fondo', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'float_card_icon_color',
            [
                'label'     => __( 'Color del Icono', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#e6b94a',
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-card .tgo-if-card-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tgo-if-card .tgo-if-card-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'float_card_value_color',
            [
                'label'     => __( 'Color del Valor', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#1a1a2e',
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-card-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'float_card_label_color',
            [
                'label'     => __( 'Color del Subtexto', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-card-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'float_card_border_radius',
            [
                'label'      => __( 'Bordes Redondeados', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 16 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-if-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'float_card_shadow',
                'selector' => '{{WRAPPER}} .tgo-if-card',
            ]
        );

        $this->add_control(
            'float_card_offset',
            [
                'label'      => __( 'Desplazamiento (offset)', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => -60, 'max' => 60 ] ],
                'default'    => [ 'unit' => 'px', 'size' => -16 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-if-card.pos-top-left'     => 'top: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-card.pos-top-right'    => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-card.pos-bottom-left'  => 'bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-card.pos-bottom-right' => 'bottom: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Imagen Circular
         * ==================================================== */
        $this->start_controls_section(
            'style_float_circle',
            [
                'label'     => __( 'Estilo — Imagen Circular', 'themeongo' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'float_circle_enabled' => 'yes' ],
            ]
        );

        $this->add_responsive_control(
            'float_circle_size',
            [
                'label'      => __( 'Tamaño', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 60, 'max' => 280 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 130 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-if-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'float_circle_border_color',
            [
                'label'     => __( 'Color del Borde', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .tgo-if-circle' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'float_circle_border_width',
            [
                'label'      => __( 'Ancho del Borde', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 12 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 4 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-if-circle' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'float_circle_shadow',
                'selector' => '{{WRAPPER}} .tgo-if-circle',
            ]
        );

        $this->add_control(
            'float_circle_offset',
            [
                'label'      => __( 'Desplazamiento (offset)', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => -60, 'max' => 60 ] ],
                'default'    => [ 'unit' => 'px', 'size' => -24 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-if-circle.pos-top-left'     => 'top: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-circle.pos-top-right'    => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-circle.pos-bottom-left'  => 'bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-if-circle.pos-bottom-right' => 'bottom: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // -------------------------------------------------------------------------
    // RENDER
    // -------------------------------------------------------------------------
    protected function render() {
        $s = $this->get_settings_for_display();

        $main_url  = ! empty( $s['main_image']['url'] )         ? esc_url( $s['main_image']['url'] )         : '';
        $main_alt  = ! empty( $s['main_image_alt'] )            ? esc_attr( $s['main_image_alt'] )           : '';

        $card_on   = ( 'yes' === $s['float_card_enabled'] );
        $circle_on = ( 'yes' === $s['float_circle_enabled'] );

        $card_pos   = sanitize_html_class( str_replace( '-', '-', $s['float_card_position']   ?? 'top-left' ) );
        $circle_pos = sanitize_html_class( $s['float_circle_position'] ?? 'bottom-right' );

        $circle_url = ! empty( $s['float_circle_image']['url'] ) ? esc_url( $s['float_circle_image']['url'] ) : '';
        $circle_alt = ! empty( $s['float_circle_alt'] )          ? esc_attr( $s['float_circle_alt'] )         : '';
        ?>
        <div class="tgo-if-wrapper">

            <?php if ( $main_url ) : ?>
                <img class="tgo-if-main-img"
                     src="<?php echo $main_url; ?>"
                     alt="<?php echo $main_alt; ?>" />
            <?php else : ?>
                <div class="tgo-if-main-img tgo-if-placeholder"></div>
            <?php endif; ?>

            <?php if ( $card_on ) : ?>
                <div class="tgo-if-card pos-<?php echo esc_attr( $card_pos ); ?>">
                    <span class="tgo-if-card-icon">
                        <?php
                        $icon_data  = $s['float_card_icon'] ?? [];
                        $icon_value = $icon_data['value'] ?? 'fas fa-star';

                        // Intentar SVG/render oficial de Elementor
                        ob_start();
                        if ( ! empty( $icon_value ) ) {
                            \Elementor\Icons_Manager::render_icon( $icon_data, [ 'aria-hidden' => 'true' ] );
                        }
                        $icon_html = trim( ob_get_clean() );

                        if ( $icon_html ) {
                            echo $icon_html;
                        } else {
                            // Fallback garantizado: <i> con inline color para que FA lo muestre
                            $icon_class = esc_attr( $icon_value );
                            echo '<i class="' . $icon_class . '" aria-hidden="true" style="color:#e6b94a;font-size:1.3rem;"></i>';
                        }
                        ?>
                    </span>
                    <div class="tgo-if-card-text">
                        <span class="tgo-if-card-value"><?php echo esc_html( $s['float_card_value'] ); ?></span>
                        <span class="tgo-if-card-label"><?php echo esc_html( $s['float_card_label'] ); ?></span>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ( $circle_on && $circle_url ) : ?>
                <div class="tgo-if-circle pos-<?php echo esc_attr( $circle_pos ); ?>">
                    <img src="<?php echo $circle_url; ?>" alt="<?php echo $circle_alt; ?>" />
                </div>
            <?php endif; ?>

        </div>
        <?php
    }
}
