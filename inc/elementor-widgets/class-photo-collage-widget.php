<?php
/**
 * ThemeOnGo Photo Collage Widget
 *
 * Diseño de collage fotográfico:
 *  - Imagen principal grande a la izquierda
 *  - Dos imágenes apiladas a la derecha
 *  - Espaciado y border-radius configurables
 *  - Etiqueta flotante opcional sobre cualquiera de las imágenes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ThemeOnGo_Photo_Collage_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'themeongo_photo_collage';
    }

    public function get_title() {
        return __( 'ThemeOnGo Photo Collage', 'themeongo' );
    }

    public function get_icon() {
        return 'eicon-gallery-masonry';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    // -------------------------------------------------------------------------
    // CONTROLS
    // -------------------------------------------------------------------------
    protected function register_controls() {

        /* ====================================================
         * SECCIÓN: Imagen Principal (izquierda)
         * ==================================================== */
        $this->start_controls_section(
            'section_main_image',
            [
                'label' => __( 'Imagen Principal (Izquierda)', 'themeongo' ),
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
         * SECCIÓN: Imagen Superior Derecha
         * ==================================================== */
        $this->start_controls_section(
            'section_top_image',
            [
                'label' => __( 'Imagen Superior (Derecha)', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'top_image',
            [
                'label'   => __( 'Imagen', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->add_control(
            'top_image_alt',
            [
                'label'   => __( 'Texto Alt', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * SECCIÓN: Imagen Inferior Derecha
         * ==================================================== */
        $this->start_controls_section(
            'section_bottom_image',
            [
                'label' => __( 'Imagen Inferior (Derecha)', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bottom_image',
            [
                'label'   => __( 'Imagen', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->add_control(
            'bottom_image_alt',
            [
                'label'   => __( 'Texto Alt', 'themeongo' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * SECCIÓN: Etiqueta Flotante (Badge opcional)
         * ==================================================== */
        $this->start_controls_section(
            'section_badge',
            [
                'label' => __( 'Etiqueta Flotante (opcional)', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_enabled',
            [
                'label'        => __( 'Activar Etiqueta', 'themeongo' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Sí', 'themeongo' ),
                'label_off'    => __( 'No', 'themeongo' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'     => __( 'Texto', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'AURA',
                'condition' => [ 'badge_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'badge_target',
            [
                'label'     => __( 'Mostrar en', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'main',
                'options'   => [
                    'main'   => __( 'Imagen Principal', 'themeongo' ),
                    'top'    => __( 'Imagen Superior', 'themeongo' ),
                    'bottom' => __( 'Imagen Inferior', 'themeongo' ),
                ],
                'condition' => [ 'badge_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label'     => __( 'Posición', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'bottom-right',
                'options'   => [
                    'top-left'     => __( 'Arriba Izquierda', 'themeongo' ),
                    'top-right'    => __( 'Arriba Derecha', 'themeongo' ),
                    'bottom-left'  => __( 'Abajo Izquierda', 'themeongo' ),
                    'bottom-right' => __( 'Abajo Derecha', 'themeongo' ),
                ],
                'condition' => [ 'badge_enabled' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Layout General
         * ==================================================== */
        $this->start_controls_section(
            'style_layout',
            [
                'label' => __( 'Estilo — Layout', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'collage_gap',
            [
                'label'      => __( 'Espacio entre imágenes', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 12 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-collage' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-collage-right' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'collage_height',
            [
                'label'      => __( 'Altura total', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range'      => [
                    'px' => [ 'min' => 200, 'max' => 900 ],
                    'vh' => [ 'min' => 20,  'max' => 100 ],
                ],
                'default' => [ 'unit' => 'px', 'size' => 480 ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'left_column_ratio',
            [
                'label'      => __( 'Ancho columna izquierda (%)', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range'      => [ '%' => [ 'min' => 30, 'max' => 70 ] ],
                'default'    => [ 'unit' => '%', 'size' => 55 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-collage-left'  => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-collage-right' => 'flex: 1 1 auto;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Bordes Redondeados de Imágenes
         * ==================================================== */
        $this->start_controls_section(
            'style_borders',
            [
                'label' => __( 'Estilo — Bordes', 'themeongo' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_border_radius',
            [
                'label'      => __( 'Imagen Principal — Bordes', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'      => '24',
                    'right'    => '24',
                    'bottom'   => '24',
                    'left'     => '24',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'top_border_radius',
            [
                'label'      => __( 'Imagen Superior — Bordes', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'      => '24',
                    'right'    => '24',
                    'bottom'   => '24',
                    'left'     => '24',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bottom_border_radius',
            [
                'label'      => __( 'Imagen Inferior — Bordes', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'      => '24',
                    'right'    => '24',
                    'bottom'   => '24',
                    'left'     => '24',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-bottom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'images_shadow',
                'label'    => __( 'Sombra (todas las imágenes)', 'themeongo' ),
                'selector' => '{{WRAPPER}} .tgo-collage-main, {{WRAPPER}} .tgo-collage-top, {{WRAPPER}} .tgo-collage-bottom',
            ]
        );

        $this->end_controls_section();

        /* ====================================================
         * ESTILO: Etiqueta Flotante
         * ==================================================== */
        $this->start_controls_section(
            'style_badge',
            [
                'label'     => __( 'Estilo — Etiqueta Flotante', 'themeongo' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'badge_enabled' => 'yes' ],
            ]
        );

        $this->add_control(
            'badge_bg',
            [
                'label'     => __( 'Color de Fondo', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => 'rgba(255,255,255,0.85)',
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => __( 'Color del Texto', 'themeongo' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#2c2c2c',
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .tgo-collage-badge',
            ]
        );

        $this->add_control(
            'badge_border_radius',
            [
                'label'      => __( 'Bordes Redondeados', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 12 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-collage-badge' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_padding',
            [
                'label'      => __( 'Padding', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '8',
                    'right'    => '16',
                    'bottom'   => '8',
                    'left'     => '16',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tgo-collage-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_offset',
            [
                'label'      => __( 'Desplazamiento (offset)', 'themeongo' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [ 'px' => [ 'min' => -40, 'max' => 40 ] ],
                'default'    => [ 'unit' => 'px', 'size' => 12 ],
                'selectors'  => [
                    '{{WRAPPER}} .tgo-collage-badge.pos-top-left'     => 'top: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-collage-badge.pos-top-right'    => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-collage-badge.pos-bottom-left'  => 'bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tgo-collage-badge.pos-bottom-right' => 'bottom: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
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

        $main_url   = ! empty( $s['main_image']['url'] )   ? esc_url( $s['main_image']['url'] )   : '';
        $main_alt   = ! empty( $s['main_image_alt'] )      ? esc_attr( $s['main_image_alt'] )     : '';
        $top_url    = ! empty( $s['top_image']['url'] )    ? esc_url( $s['top_image']['url'] )    : '';
        $top_alt    = ! empty( $s['top_image_alt'] )       ? esc_attr( $s['top_image_alt'] )      : '';
        $bottom_url = ! empty( $s['bottom_image']['url'] ) ? esc_url( $s['bottom_image']['url'] ) : '';
        $bottom_alt = ! empty( $s['bottom_image_alt'] )    ? esc_attr( $s['bottom_image_alt'] )   : '';

        $badge_on      = ( 'yes' === ( $s['badge_enabled'] ?? 'no' ) );
        $badge_text    = esc_html( $s['badge_text']     ?? '' );
        $badge_target  = $s['badge_target']   ?? 'main';
        $badge_pos     = $s['badge_position'] ?? 'bottom-right';

        $placeholder = \Elementor\Utils::get_placeholder_image_src();
        if ( ! $main_url )   $main_url   = $placeholder;
        if ( ! $top_url )    $top_url    = $placeholder;
        if ( ! $bottom_url ) $bottom_url = $placeholder;
        ?>
        <div class="tgo-collage">

            <!-- Columna Izquierda: imagen principal grande -->
            <div class="tgo-collage-left">
                <div class="tgo-collage-img-wrap" style="position:relative;height:100%;">
                    <img class="tgo-collage-main"
                         src="<?php echo $main_url; ?>"
                         alt="<?php echo $main_alt; ?>" />
                    <?php if ( $badge_on && 'main' === $badge_target ) : ?>
                        <span class="tgo-collage-badge pos-<?php echo esc_attr( $badge_pos ); ?>"><?php echo $badge_text; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Columna Derecha: dos imágenes apiladas -->
            <div class="tgo-collage-right">

                <!-- Imagen Superior -->
                <div class="tgo-collage-img-wrap" style="position:relative;flex:1 1 0;min-height:0;">
                    <img class="tgo-collage-top"
                         src="<?php echo $top_url; ?>"
                         alt="<?php echo $top_alt; ?>" />
                    <?php if ( $badge_on && 'top' === $badge_target ) : ?>
                        <span class="tgo-collage-badge pos-<?php echo esc_attr( $badge_pos ); ?>"><?php echo $badge_text; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Imagen Inferior -->
                <div class="tgo-collage-img-wrap" style="position:relative;flex:1 1 0;min-height:0;">
                    <img class="tgo-collage-bottom"
                         src="<?php echo $bottom_url; ?>"
                         alt="<?php echo $bottom_alt; ?>" />
                    <?php if ( $badge_on && 'bottom' === $badge_target ) : ?>
                        <span class="tgo-collage-badge pos-<?php echo esc_attr( $badge_pos ); ?>"><?php echo $badge_text; ?></span>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <style>
        /* ── Photo Collage Widget ── */
        .elementor-widget-themeongo_photo_collage .tgo-collage {
            display: flex;
            align-items: stretch;
            width: 100%;
            box-sizing: border-box;
        }
        .elementor-widget-themeongo_photo_collage .tgo-collage-left {
            flex-shrink: 0;
        }
        .elementor-widget-themeongo_photo_collage .tgo-collage-right {
            display: flex;
            flex-direction: column;
            flex: 1 1 auto;
            min-height: 0;
        }
        .elementor-widget-themeongo_photo_collage .tgo-collage-main,
        .elementor-widget-themeongo_photo_collage .tgo-collage-top,
        .elementor-widget-themeongo_photo_collage .tgo-collage-bottom {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Badge */
        .elementor-widget-themeongo_photo_collage .tgo-collage-badge {
            position: absolute;
            z-index: 10;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            pointer-events: none;
            white-space: nowrap;
            letter-spacing: 0.06em;
        }
        .elementor-widget-themeongo_photo_collage .tgo-collage-badge.pos-top-left     { top: 12px;    left: 12px;   }
        .elementor-widget-themeongo_photo_collage .tgo-collage-badge.pos-top-right    { top: 12px;    right: 12px;  }
        .elementor-widget-themeongo_photo_collage .tgo-collage-badge.pos-bottom-left  { bottom: 12px; left: 12px;   }
        .elementor-widget-themeongo_photo_collage .tgo-collage-badge.pos-bottom-right { bottom: 12px; right: 12px;  }
        </style>
        <?php
    }
}
