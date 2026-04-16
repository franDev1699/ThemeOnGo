<?php

function themeongo_customize_register( $wp_customize ) {

    // PANEL: ThemeOnGo Options
    $wp_customize->add_panel( 'themeongo_options', array(
        'priority'    => 30,
        'title'       => __( 'ThemeOnGo Options', 'themeongo' ),
        'description' => __( 'Global design configuration.', 'themeongo' ),
    ) );

    // SECTION: System Colors
    $wp_customize->add_section( 'themeongo_colors', array(
        'title'    => __( 'System Colors', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'color_dark_green', array(
        'default'           => '#506F67',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_dark_green', array(
        'label'   => __( 'Primary Color (Dark Green)', 'themeongo' ),
        'section' => 'themeongo_colors',
    ) ) );

    $wp_customize->add_setting( 'color_light_green', array(
        'default'           => '#8FAFA2',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_light_green', array(
        'label'   => __( 'Secondary Color (Light Green)', 'themeongo' ),
        'section' => 'themeongo_colors',
    ) ) );

    $wp_customize->add_setting( 'color_gold', array(
        'default'           => '#C5A25E',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_gold', array(
        'label'   => __( 'Accent Color (Gold)', 'themeongo' ),
        'section' => 'themeongo_colors',
    ) ) );

    $wp_customize->add_setting( 'color_nude', array(
        'default'           => '#EDE3D9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_nude', array(
        'label'   => __( 'Background Color (Nude)', 'themeongo' ),
        'section' => 'themeongo_colors',
    ) ) );

    // SECTION: Header — Background & Style
    $wp_customize->add_section( 'themeongo_header_config', array(
        'title'    => __( '🔷 Header — Background & Style', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 20,
    ) );

    // --- Background Mode ---
    $wp_customize->add_setting( 'header_bg_mode', array(
        'default'           => 'glass',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_bg_mode', array(
        'label'   => __( 'Background Mode', 'themeongo' ),
        'section' => 'themeongo_header_config',
        'type'    => 'select',
        'choices' => array(
            'glass'       => __( 'Glass (Blur + Transparency)', 'themeongo' ),
            'solid'       => __( 'Solid Color', 'themeongo' ),
            'transparent' => __( 'Fully Transparent', 'themeongo' ),
        ),
    ) );

    // --- Solid BG Color ---
    $wp_customize->add_setting( 'header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
        'label'       => __( 'Header Solid Background Color', 'themeongo' ),
        'section'     => 'themeongo_header_config',
        'description' => __( 'Used when mode is "Solid".', 'themeongo' ),
    ) ) );

    // --- Glass Opacity ---
    $wp_customize->add_setting( 'header_glass_opacity', array(
        'default'           => '15',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'header_glass_opacity', array(
        'label'       => __( 'Glass Opacity (0–100)', 'themeongo' ),
        'section'     => 'themeongo_header_config',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 100, 'step' => 5 ),
        'description' => __( 'Background fill strength when using Glass mode.', 'themeongo' ),
    ) );

    // --- Glass Blur ---
    $wp_customize->add_setting( 'header_glass_blur', array(
        'default'           => '12',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'header_glass_blur', array(
        'label'       => __( 'Glass Blur (px)', 'themeongo' ),
        'section'     => 'themeongo_header_config',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 40, 'step' => 1 ),
    ) );

    // --- Glass BG Color ---
    $wp_customize->add_setting( 'header_glass_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_glass_color', array(
        'label'       => __( 'Glass Background Tint Color', 'themeongo' ),
        'section'     => 'themeongo_header_config',
        'description' => __( 'The RGBA base color used with the opacity above in Glass mode.', 'themeongo' ),
    ) ) );

    // --- Border bottom ---
    $wp_customize->add_setting( 'header_show_border', array(
        'default'           => false,
        'sanitize_callback' => 'themeongo_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'header_show_border', array(
        'label'   => __( 'Show Bottom Border', 'themeongo' ),
        'section' => 'themeongo_header_config',
        'type'    => 'checkbox',
    ) );

    // --- Sticky ---
    $wp_customize->add_setting( 'header_sticky', array(
        'default'           => true,
        'sanitize_callback' => 'themeongo_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'header_sticky', array(
        'label'   => __( 'Sticky Header (Fixed on Scroll)', 'themeongo' ),
        'section' => 'themeongo_header_config',
        'type'    => 'checkbox',
    ) );

    // SECTION: Header — Navigation & Text Colors
    $wp_customize->add_section( 'themeongo_header_nav', array(
        'title'    => __( '🔷 Header — Navigation & Text', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 25,
    ) );

    // --- Nav Link Color ---
    $wp_customize->add_setting( 'header_nav_color', array(
        'default'           => '#2A2C2B',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_nav_color', array(
        'label'   => __( 'Navigation Link Color', 'themeongo' ),
        'section' => 'themeongo_header_nav',
    ) ) );

    // --- Nav Link Hover Color ---
    $wp_customize->add_setting( 'header_nav_hover_color', array(
        'default'           => '#506F67',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_nav_hover_color', array(
        'label'   => __( 'Navigation Link Hover Color', 'themeongo' ),
        'section' => 'themeongo_header_nav',
    ) ) );

    // --- Logo Width ---
    $wp_customize->add_setting( 'header_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'header_logo_width', array(
        'label'       => __( 'Logo Width (px)', 'themeongo' ),
        'section'     => 'themeongo_header_nav',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 50, 'max' => 500, 'step' => 5 ),
    ) );

    // SECTION: Header — CTA & Elements
    $wp_customize->add_section( 'themeongo_header_cta', array(
        'title'    => __( '🔷 Header — CTA & Elements', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 30,
    ) );

    // --- Show CTA ---
    $wp_customize->add_setting( 'header_show_cta', array(
        'default'           => true,
        'sanitize_callback' => 'themeongo_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'header_show_cta', array(
        'label'   => __( 'Show CTA Button', 'themeongo' ),
        'section' => 'themeongo_header_cta',
        'type'    => 'checkbox',
    ) );

    // --- CTA Text ---
    $wp_customize->add_setting( 'header_cta_text', array(
        'default'           => 'Reserva tu Cita',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_cta_text', array(
        'label'   => __( 'Button Text', 'themeongo' ),
        'section' => 'themeongo_header_cta',
        'type'    => 'text',
    ) );

    // --- CTA Link ---
    $wp_customize->add_setting( 'header_cta_link', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_cta_link', array(
        'label'   => __( 'Button Link (URL)', 'themeongo' ),
        'section' => 'themeongo_header_cta',
        'type'    => 'url',
    ) );

    // --- CTA Shape ---
    $wp_customize->add_setting( 'header_cta_shape', array(
        'default'           => 'rounded-pill',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_cta_shape', array(
        'label'   => __( 'Button Shape', 'themeongo' ),
        'section' => 'themeongo_header_cta',
        'type'    => 'select',
        'choices' => array(
            'rounded-pill' => __( 'Pill (fully rounded)', 'themeongo' ),
            'rounded-3'    => __( 'Rounded (soft corners)', 'themeongo' ),
            'rounded-0'    => __( 'Square', 'themeongo' ),
        ),
    ) );

    // --- CTA Size ---
    $wp_customize->add_setting( 'header_cta_size', array(
        'default'           => 'md',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_cta_size', array(
        'label'   => __( 'Button Size', 'themeongo' ),
        'section' => 'themeongo_header_cta',
        'type'    => 'select',
        'choices' => array(
            'sm' => __( 'Small', 'themeongo' ),
            'md' => __( 'Medium (default)', 'themeongo' ),
            'lg' => __( 'Large', 'themeongo' ),
        ),
    ) );

    // --- CTA Background Color ---
    $wp_customize->add_setting( 'header_cta_bg_color', array(
        'default'           => '#506F67',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_cta_bg_color', array(
        'label'   => __( 'Button Background Color', 'themeongo' ),
        'section' => 'themeongo_header_cta',
    ) ) );

    // --- CTA Text Color ---
    $wp_customize->add_setting( 'header_cta_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_cta_text_color', array(
        'label'   => __( 'Button Text Color', 'themeongo' ),
        'section' => 'themeongo_header_cta',
    ) ) );

    // --- CTA Hover BG Color ---
    $wp_customize->add_setting( 'header_cta_hover_bg_color', array(
        'default'           => '#8FAFA2',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_cta_hover_bg_color', array(
        'label'   => __( 'Button Hover Background Color', 'themeongo' ),
        'section' => 'themeongo_header_cta',
    ) ) );

    // --- Header Shortcode ---
    $wp_customize->add_setting( 'header_shortcode', array(
        'default'           => '',
        // use wp_kses_post to allow shortcode brackets and some HTML if desired
        'sanitize_callback' => 'wp_kses_post', 
    ) );
    $wp_customize->add_control( 'header_shortcode', array(
        'label'       => __( 'Header Shortcode', 'themeongo' ),
        'description' => __( 'Pega tu shortcode aquí (ej: [gtranslate]). Aparecerá a la derecha del menú.', 'themeongo' ),
        'section'     => 'themeongo_header_cta',
        'type'        => 'text',
    ) );

    // SECTION: Footer — Background & Style
    $wp_customize->add_section( 'themeongo_footer_config', array(
        'title'    => __( '🔶 Footer — Background & Style', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 40,
    ) );

    // --- Footer BG Color ---
    $wp_customize->add_setting( 'footer_bg_color', array(
        'default'           => '#2A2C2B',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
        'label'   => __( 'Footer Background Color', 'themeongo' ),
        'section' => 'themeongo_footer_config',
    ) ) );

    // --- Footer Text Color ---
    $wp_customize->add_setting( 'footer_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
        'label'   => __( 'Footer Text Color', 'themeongo' ),
        'section' => 'themeongo_footer_config',
    ) ) );

    // --- Footer Muted Text Color ---
    $wp_customize->add_setting( 'footer_muted_color', array(
        'default'           => 'rgba(255,255,255,0.6)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_muted_color', array(
        'label'       => __( 'Footer Muted / Description Text Color (rgba or hex)', 'themeongo' ),
        'section'     => 'themeongo_footer_config',
        'type'        => 'text',
        'description' => __( 'Used for the brand description and copyright. E.g. rgba(255,255,255,0.6)', 'themeongo' ),
    ) );

    // --- Footer Link Color ---
    $wp_customize->add_setting( 'footer_link_color', array(
        'default'           => 'rgba(255,255,255,0.7)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_link_color', array(
        'label'       => __( 'Footer Link Color (rgba or hex)', 'themeongo' ),
        'section'     => 'themeongo_footer_config',
        'type'        => 'text',
    ) );

    // --- Footer Link Hover Color ---
    $wp_customize->add_setting( 'footer_link_hover_color', array(
        'default'           => '#C5A25E',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_hover_color', array(
        'label'   => __( 'Footer Link Hover Color', 'themeongo' ),
        'section' => 'themeongo_footer_config',
    ) ) );

    // --- Footer Divider Color ---
    $wp_customize->add_setting( 'footer_divider_color', array(
        'default'           => 'rgba(255,255,255,0.1)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_divider_color', array(
        'label'       => __( 'Footer Divider / Border Color (rgba or hex)', 'themeongo' ),
        'section'     => 'themeongo_footer_config',
        'type'        => 'text',
    ) );

    // SECTION: Footer — Content
    $wp_customize->add_section( 'themeongo_footer_content', array(
        'title'    => __( '🔶 Footer — Content', 'themeongo' ),
        'panel'    => 'themeongo_options',
        'priority' => 45,
    ) );

    // --- Footer Brand Description ---
    $wp_customize->add_setting( 'footer_text', array(
        'default'           => 'Redefiniendo la belleza a través de la medicina estética de vanguardia. Cuidado profesional con resultados naturales.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'footer_text', array(
        'label'   => __( 'Brand Description Text', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'textarea',
    ) );

    // --- Footer "Links" Section Title ---
    $wp_customize->add_setting( 'footer_links_title', array(
        'default'           => 'Enlaces',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_links_title', array(
        'label'   => __( '"Links" Column Title', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );

    // --- Footer "Legal" Section Title ---
    $wp_customize->add_setting( 'footer_legal_title', array(
        'default'           => 'Legal',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_legal_title', array(
        'label'   => __( '"Legal" Column Title', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );

    // --- Legal Link 1 Text ---
    $wp_customize->add_setting( 'footer_legal_1_text', array(
        'default'           => 'Políticas de Privacidad',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_legal_1_text', array(
        'label'   => __( 'Legal Link 1 — Text', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'footer_legal_1_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_legal_1_url', array(
        'label'   => __( 'Legal Link 1 — URL', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'url',
    ) );

    // --- Legal Link 2 Text ---
    $wp_customize->add_setting( 'footer_legal_2_text', array(
        'default'           => 'Términos de Servicio',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_legal_2_text', array(
        'label'   => __( 'Legal Link 2 — Text', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'footer_legal_2_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_legal_2_url', array(
        'label'   => __( 'Legal Link 2 — URL', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'url',
    ) );

    // --- Footer "Follow" Section Title ---
    $wp_customize->add_setting( 'footer_social_title', array(
        'default'           => 'Síguenos',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_social_title', array(
        'label'   => __( '"Follow Us" Column Title', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );

    // --- Social Links ---
    $socials = array(
        'instagram' => 'Instagram URL',
        'facebook'  => 'Facebook URL',
        'tiktok'    => 'TikTok URL',
        'twitter'   => 'Twitter / X URL',
        'whatsapp'  => 'WhatsApp URL',
    );
    foreach ( $socials as $key => $label ) {
        $wp_customize->add_setting( 'footer_social_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'footer_social_' . $key, array(
            'label'   => __( $label, 'themeongo' ),
            'section' => 'themeongo_footer_content',
            'type'    => 'url',
        ) );
    }

    // --- Copyright Text ---
    $wp_customize->add_setting( 'footer_copyright', array(
        'default'           => 'Todos los derechos reservados.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_copyright', array(
        'label'   => __( 'Copyright Suffix Text', 'themeongo' ),
        'section' => 'themeongo_footer_content',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'themeongo_customize_register' );

function themeongo_sanitize_checkbox( $checked ) {
    return ( isset( $checked ) && true == $checked ) ? true : false;
}

/**
 * Convert hex color to RGB array.
 */
function themeongo_hex_to_rgb( $hex ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    return array(
        'r' => hexdec( substr( $hex, 0, 2 ) ),
        'g' => hexdec( substr( $hex, 2, 2 ) ),
        'b' => hexdec( substr( $hex, 4, 2 ) ),
    );
}

function themeongo_customizer_css() {
    // System colors
    $dark_green  = get_theme_mod( 'color_dark_green', '#506F67' );
    $light_green = get_theme_mod( 'color_light_green', '#8FAFA2' );
    $gold        = get_theme_mod( 'color_gold', '#C5A25E' );
    $nude        = get_theme_mod( 'color_nude', '#EDE3D9' );

    // Header
    $header_bg_mode     = get_theme_mod( 'header_bg_mode', 'glass' );
    $header_bg_color    = get_theme_mod( 'header_bg_color', '#ffffff' );
    $header_glass_color = get_theme_mod( 'header_glass_color', '#ffffff' );
    $header_glass_op    = (int) get_theme_mod( 'header_glass_opacity', 15 );
    $header_glass_blur  = (int) get_theme_mod( 'header_glass_blur', 12 );
    $header_nav_color   = get_theme_mod( 'header_nav_color', '#2A2C2B' );
    $header_nav_hover   = get_theme_mod( 'header_nav_hover_color', '#506F67' );
    $logo_width         = absint( get_theme_mod( 'header_logo_width', 150 ) );

    // CTA
    $cta_bg    = get_theme_mod( 'header_cta_bg_color', '#506F67' );
    $cta_text  = get_theme_mod( 'header_cta_text_color', '#ffffff' );
    $cta_hover = get_theme_mod( 'header_cta_hover_bg_color', '#8FAFA2' );

    // Footer
    $footer_bg           = get_theme_mod( 'footer_bg_color', '#2A2C2B' );
    $footer_text         = get_theme_mod( 'footer_text_color', '#ffffff' );
    $footer_muted        = get_theme_mod( 'footer_muted_color', 'rgba(255,255,255,0.6)' );
    $footer_link         = get_theme_mod( 'footer_link_color', 'rgba(255,255,255,0.7)' );
    $footer_link_hover   = get_theme_mod( 'footer_link_hover_color', '#C5A25E' );
    $footer_divider      = get_theme_mod( 'footer_divider_color', 'rgba(255,255,255,0.1)' );

    // Build header background CSS
    $rgb = themeongo_hex_to_rgb( $header_glass_color );
    $glass_opacity_decimal = round( $header_glass_op / 100, 2 );

    if ( 'glass' === $header_bg_mode ) {
        $nav_bg_css = 'background: rgba(' . $rgb['r'] . ',' . $rgb['g'] . ',' . $rgb['b'] . ',' . $glass_opacity_decimal . ') !important; backdrop-filter: blur(' . $header_glass_blur . 'px) !important; -webkit-backdrop-filter: blur(' . $header_glass_blur . 'px) !important;';
    } elseif ( 'solid' === $header_bg_mode ) {
        $nav_bg_css = 'background: ' . esc_attr( $header_bg_color ) . ' !important; backdrop-filter: none !important;';
    } else {
        $nav_bg_css = 'background: transparent !important; backdrop-filter: none !important;';
    }
    ?>
    <style type="text/css">
        /* --- System Colors --- */
        :root {
            --chloe-dark-green: <?php echo esc_attr( $dark_green ); ?>;
            --chloe-light-green: <?php echo esc_attr( $light_green ); ?>;
            --chloe-gold: <?php echo esc_attr( $gold ); ?>;
            --chloe-nude: <?php echo esc_attr( $nude ); ?>;
        }

        /* --- Logo --- */
        .custom-logo, .navbar-logo-img {
            max-width: <?php echo esc_attr( $logo_width ); ?>px !important;
            height: auto !important;
            object-fit: contain;
        }

        /* --- Header Background --- */
        #mainNavbar {
            <?php echo $nav_bg_css; ?>
        }

        /* --- Nav Links --- */
        #mainNavbar .nav-link {
            color: <?php echo esc_attr( $header_nav_color ); ?> !important;
        }
        #mainNavbar .nav-link:hover,
        #mainNavbar .nav-link:focus {
            color: <?php echo esc_attr( $header_nav_hover ); ?> !important;
        }

        /* --- CTA Button --- */
        #mainNavbar .tgo-header-cta {
            background-color: <?php echo esc_attr( $cta_bg ); ?> !important;
            color: <?php echo esc_attr( $cta_text ); ?> !important;
            border-color: <?php echo esc_attr( $cta_bg ); ?> !important;
        }
        #mainNavbar .tgo-header-cta:hover,
        #mainNavbar .tgo-header-cta:focus {
            background-color: <?php echo esc_attr( $cta_hover ); ?> !important;
            border-color: <?php echo esc_attr( $cta_hover ); ?> !important;
            color: <?php echo esc_attr( $cta_text ); ?> !important;
        }

        /* --- Footer --- */
        .tgo-footer {
            background-color: <?php echo esc_attr( $footer_bg ); ?> !important;
            color: <?php echo esc_attr( $footer_text ); ?>;
        }
        .tgo-footer h5,
        .tgo-footer .tgo-footer-site-name {
            color: <?php echo esc_attr( $footer_text ); ?> !important;
        }
        .tgo-footer .tgo-footer-muted {
            color: <?php echo esc_attr( $footer_muted ); ?> !important;
        }
        .tgo-footer .footer-links a {
            color: <?php echo esc_attr( $footer_link ); ?>;
        }
        .tgo-footer .footer-links a:hover {
            color: <?php echo esc_attr( $footer_link_hover ); ?>;
        }
        .tgo-footer .tgo-footer-divider {
            border-color: <?php echo esc_attr( $footer_divider ); ?> !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'themeongo_customizer_css' );
