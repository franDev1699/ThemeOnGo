<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-bs-spy="scroll" data-bs-target="#mainNavbar" data-bs-offset="100">
<?php wp_body_open(); ?>

    <?php
    $sticky         = get_theme_mod( 'header_sticky', true ) ? 'sticky-top' : '';
    $show_border    = get_theme_mod( 'header_show_border', false ) ? '' : 'border-bottom-0';
    $navbar_class   = 'navbar navbar-expand-lg py-3 ' . $sticky . ' ' . $show_border;

    // CTA settings
    $cta_shape = get_theme_mod( 'header_cta_shape', 'rounded-pill' );
    $cta_size  = get_theme_mod( 'header_cta_size', 'md' );
    $btn_size_class = ( 'sm' === $cta_size ) ? 'btn-sm px-3 py-1' : ( ( 'lg' === $cta_size ) ? 'btn-lg px-5 py-3' : 'px-4 py-2' );
    ?>
    <nav id="mainNavbar" class="<?php echo esc_attr( $navbar_class ); ?>">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="tgo-footer-site-name fs-4 fw-medium"><?php bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-end" id="navbarNav">

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav font-weight-medium',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'          => 2,
                    ) );
                } else {
                    echo '<ul class="navbar-nav font-weight-medium"><li class="nav-item"><a class="nav-link" href="#">Asigna un menú en Apariencia &rsaquo; Menús</a></li></ul>';
                }
                ?>

                <?php if ( get_theme_mod( 'header_show_cta', true ) ) : ?>
                <div class="d-none d-lg-block ms-lg-4 mt-3 mt-lg-0">
                    <a href="<?php echo esc_url( get_theme_mod( 'header_cta_link', '#contact' ) ); ?>"
                       class="btn tgo-header-cta <?php echo esc_attr( $cta_shape . ' ' . $btn_size_class ); ?>">
                        <?php echo esc_html( get_theme_mod( 'header_cta_text', 'Reserva tu Cita' ) ); ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php 
                $header_shortcode = get_theme_mod( 'header_shortcode', '' );
                if ( ! empty( $header_shortcode ) ) : ?>
                <div class="ms-lg-3 mt-3 mt-lg-0 d-flex align-items-center justify-content-lg-end header-shortcode-container">
                    <?php echo do_shortcode( wp_unslash( $header_shortcode ) ); ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>
