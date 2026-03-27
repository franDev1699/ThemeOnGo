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
    // Usamos sticky-top para que ocupe espacio y empuje el contenido hacia abajo, 
    // pero se mantenga arriba al hacer scroll.
    $navbar_class = 'navbar navbar-expand-lg sticky-top py-3 transition-bg glass-panel border-bottom-0 pb-3';
    ?>
    <!-- Navigation -->
    <nav id="mainNavbar" class="<?php echo esc_attr( $navbar_class ); ?>" style="background: rgba(255,255,255,0.2); z-index: 1030;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="fs-4 fw-medium"><?php bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-end" id="navbarNav">
                
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'navbar-nav font-weight-medium',
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 2,
                    ) );
                } else {
                    echo '<ul class="navbar-nav font-weight-medium"><li class="nav-item"><a class="nav-link" href="#">Asigna un menú en Apariencia > Menús</a></li></ul>';
                }
                ?>

                <?php if ( get_theme_mod( 'header_show_cta', true ) ) : ?>
                <div class="d-none d-lg-block ms-lg-4 mt-3 mt-lg-0">
                    <a href="<?php echo esc_url( get_theme_mod( 'header_cta_link', '#contact' ) ); ?>" class="btn btn-primary rounded-pill px-4 py-2">
                        <?php echo esc_html( get_theme_mod( 'header_cta_text', 'Reserva tu Cita' ) ); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>
