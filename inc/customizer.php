<?php
/**
 * ThemeOnGo Theme Customizer
 */

function themeongo_customize_register( $wp_customize ) {
    // Panel: Theme Options
    $wp_customize->add_panel( 'themeongo_options', array(
        'priority'       => 30,
        'title'          => __( 'ThemeOnGo Options', 'themeongo' ),
        'description'    => __( 'Configuración global del diseño.', 'themeongo' ),
    ) );

    // Section: Colors
    $wp_customize->add_section( 'themeongo_colors', array(
        'title'    => __( 'Colores del Sistema', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 10,
    ) );

    // Setting: Primary Color (Dark Green)
    $wp_customize->add_setting( 'color_dark_green', array(
        'default'           => '#506F67',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_dark_green', array(
        'label'    => __( 'Color Primario (Verde Oscuro)', 'themeongo' ),
        'section'  => 'themeongo_colors',
    ) ) );

    // Setting: Secondary Color (Light Green)
    $wp_customize->add_setting( 'color_light_green', array(
        'default'           => '#8FAFA2',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_light_green', array(
        'label'    => __( 'Color Secundario (Verde Claro)', 'themeongo' ),
        'section'  => 'themeongo_colors',
    ) ) );

    // Setting: Accent Color (Gold)
    $wp_customize->add_setting( 'color_gold', array(
        'default'           => '#C5A25E',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_gold', array(
        'label'    => __( 'Color Acento (Dorado)', 'themeongo' ),
        'section'  => 'themeongo_colors',
    ) ) );

    // Setting: Nude/Background Color
    $wp_customize->add_setting( 'color_nude', array(
        'default'           => '#EDE3D9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_nude', array(
        'label'    => __( 'Color Fondo (Nude)', 'themeongo' ),
        'section'  => 'themeongo_colors',
    ) ) );
    
    // Section: Header Config
    $wp_customize->add_section( 'themeongo_header_config', array(
        'title'    => __( 'Configuración de Cabecera', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 20,
    ) );

    // Setting: Show header CTA button
    $wp_customize->add_setting( 'header_show_cta', array(
        'default'           => true,
        'sanitize_callback' => 'themeongo_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'header_show_cta', array(
        'label'    => __( 'Mostrar botón CTA en Cabecera', 'themeongo' ),
        'section'  => 'themeongo_header_config',
        'type'     => 'checkbox',
    ) );

    // Setting: Header CTA Text
    $wp_customize->add_setting( 'header_cta_text', array(
        'default'           => 'Reserva tu Cita',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_cta_text', array(
        'label'    => __( 'Texto del Botón CTA', 'themeongo' ),
        'section'  => 'themeongo_header_config',
        'type'     => 'text',
    ) );

    // Setting: Header CTA Link
    $wp_customize->add_setting( 'header_cta_link', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_cta_link', array(
        'label'    => __( 'Enlace del Botón CTA', 'themeongo' ),
        'section'  => 'themeongo_header_config',
        'type'     => 'url',
    ) );
    
    // Setting: Header Logo Width
    $wp_customize->add_setting( 'header_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'header_logo_width', array(
        'label'    => __( 'Ancho del Logo (px)', 'themeongo' ),
        'section'  => 'themeongo_header_config',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 500,
            'step' => 5,
        ),
    ) );
}
add_action( 'customize_register', 'themeongo_customize_register' );

/**
 * Sanitize checkbox
 */
function themeongo_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Output dynamic CSS to <head>
 */
function themeongo_customizer_css() {
    $dark_green = get_theme_mod( 'color_dark_green', '#506F67' );
    $light_green = get_theme_mod( 'color_light_green', '#8FAFA2' );
    $gold = get_theme_mod( 'color_gold', '#C5A25E' );
    $nude = get_theme_mod( 'color_nude', '#EDE3D9' );
    $logo_width = get_theme_mod( 'header_logo_width', 150 );
    ?>
    <style type="text/css">
        :root {
            --chloe-dark-green: <?php echo esc_attr( $dark_green ); ?>;
            --chloe-light-green: <?php echo esc_attr( $light_green ); ?>;
            --chloe-gold: <?php echo esc_attr( $gold ); ?>;
            --chloe-nude: <?php echo esc_attr( $nude ); ?>;
        }
        
        .custom-logo, .navbar-logo-img {
            max-width: <?php echo esc_attr( absint( $logo_width ) ); ?>px !important;
            height: auto !important;
            object-fit: contain;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'themeongo_customizer_css' );
