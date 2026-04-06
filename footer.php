    <footer class="footer bg-dark-bg text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4 justify-content-between mb-5">
                <div class="col-lg-4 col-md-6">
                    <a class="d-inline-block mb-3" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                       <?php if ( has_custom_logo() ) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <span class="fs-4 fw-medium text-white"><?php bloginfo( 'name' ); ?></span>
                        <?php endif; ?>
                    </a>
                    <p class="text-muted-light pe-lg-4 mt-3"><?php echo get_theme_mod('footer_text', 'Redefiniendo la belleza a través de la medicina estética de vanguardia. Cuidado profesional con resultados naturales.'); ?></p>
                </div>
                
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="text-white mb-4 fw-medium fs-6 text-uppercase tracking-widest">Enlaces</h5>
                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'footer',
                        'container'       => false,
                        'menu_class'      => 'list-unstyled footer-links',
                        'fallback_cb'     => '__return_false',
                    ) );
                    ?>
                </div>
                
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="text-white mb-4 fw-medium fs-6 text-uppercase tracking-widest">Legal</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#" class="text-decoration-none">Políticas de Privacidad</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">Términos de Servicio</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-12">
                    <h5 class="text-white mb-4 fw-medium fs-6 text-uppercase tracking-widest">Síguenos</h5>
                    <div class="social-links d-flex gap-3">
                        <a href="#" class="btn btn-outline-light rounded-circle social-btn d-flex align-items-center justify-content-center"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle social-btn d-flex align-items-center justify-content-center"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle social-btn d-flex align-items-center justify-content-center"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-secondary pt-4 text-center">
                <p class="text-muted-light small mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
