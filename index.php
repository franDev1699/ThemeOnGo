<?php
get_header();
?>

<main id="primary" class="site-main min-vh-100">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <div <?php post_class('container py-5 mt-5'); ?>>
                <?php
                if ( ! ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) ) {
                    echo '<h1 class="entry-title display-4 mt-5 mb-4">' . get_the_title() . '</h1>';
                }
                the_content();
                ?>
            </div>
            <?php
        endwhile;
    else :
        echo '<div class="container py-5 mt-5"><p>No se encontró contenido.</p></div>';
    endif;
    ?>
</main>

<?php
get_footer();
