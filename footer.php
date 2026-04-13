    <?php
    $social_icons = array(
        'instagram' => 'fa-brands fa-instagram',
        'facebook'  => 'fa-brands fa-facebook-f',
        'tiktok'    => 'fa-brands fa-tiktok',
        'twitter'   => 'fa-brands fa-x-twitter',
        'whatsapp'  => 'fa-brands fa-whatsapp',
    );
    ?>
    <footer class="tgo-footer text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4 justify-content-between mb-5">

                <!-- Brand Column -->
                <div class="col-lg-4 col-md-6">
                    <a class="d-inline-block mb-3" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php if ( has_custom_logo() ) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <span class="fs-4 fw-medium tgo-footer-site-name"><?php bloginfo( 'name' ); ?></span>
                        <?php endif; ?>
                    </a>
                    <p class="tgo-footer-muted pe-lg-4 mt-3">
                        <?php echo esc_html( get_theme_mod( 'footer_text', 'Redefiniendo la belleza a través de la medicina estética de vanguardia. Cuidado profesional con resultados naturales.' ) ); ?>
                    </p>
                </div>

                <!-- Nav Links Column -->
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="mb-4 fw-medium fs-6 text-uppercase tracking-widest">
                        <?php echo esc_html( get_theme_mod( 'footer_links_title', 'Enlaces' ) ); ?>
                    </h5>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'list-unstyled footer-links',
                        'fallback_cb'    => '__return_false',
                    ) );
                    ?>
                </div>

                <!-- Legal Column -->
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="mb-4 fw-medium fs-6 text-uppercase tracking-widest">
                        <?php echo esc_html( get_theme_mod( 'footer_legal_title', 'Legal' ) ); ?>
                    </h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2">
                            <a href="<?php echo esc_url( get_theme_mod( 'footer_legal_1_url', '#' ) ); ?>" class="text-decoration-none">
                                <?php echo esc_html( get_theme_mod( 'footer_legal_1_text', 'Políticas de Privacidad' ) ); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?php echo esc_url( get_theme_mod( 'footer_legal_2_url', '#' ) ); ?>" class="text-decoration-none">
                                <?php echo esc_html( get_theme_mod( 'footer_legal_2_text', 'Términos de Servicio' ) ); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Social Column -->
                <div class="col-lg-3 col-md-12">
                    <h5 class="mb-4 fw-medium fs-6 text-uppercase tracking-widest">
                        <?php echo esc_html( get_theme_mod( 'footer_social_title', 'Síguenos' ) ); ?>
                    </h5>
                    <div class="social-links d-flex flex-wrap gap-3">
                        <?php foreach ( $social_icons as $key => $icon_class ) :
                            $url = get_theme_mod( 'footer_social_' . $key, '' );
                            if ( ! empty( $url ) ) : ?>
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-outline-light rounded-circle social-btn d-flex align-items-center justify-content-center"
                                   aria-label="<?php echo esc_attr( $key ); ?>">
                                    <i class="<?php echo esc_attr( $icon_class ); ?>"></i>
                                </a>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- Divider & Copyright -->
            <div class="border-top tgo-footer-divider pt-4 text-center">
                <p class="tgo-footer-muted small mb-0">
                    &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>.
                    <?php echo esc_html( get_theme_mod( 'footer_copyright', 'Todos los derechos reservados.' ) ); ?>
                </p>
            </div>

        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
