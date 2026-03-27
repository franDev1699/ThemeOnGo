<?php
/**
 * The template for displaying all single pages
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) :
            the_content();
        else :
            ?>
            <main id="primary" class="site-main min-vh-100">
                <div class="container py-5 mt-5">
                    <h1 class="display-4 mt-5 mb-4"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </main>
            <?php
        endif;
    endwhile;
endif;

get_footer();
