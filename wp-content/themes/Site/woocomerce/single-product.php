<?php
defined( 'ABSPATH' ) || exit; // sécurité : empêche l'accès direct
get_header(); // ton header personnalisé
?>

<main class="single-product-page">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            global $product; // objet produit WooCommerce
    ?>
            <!-- Titre du produit -->
            <h2><?php the_title(); ?></h2>

            <!-- Image du produit -->
            <div class="product-image">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('large');
                }
                ?>
            </div>

            <!-- Prix du produit -->
            <div class="product-summary">
                <?php
                if ( $product ) {
                    echo $product->get_price_html();
                }
                ?>
            </div>

            <!-- Description du produit -->
            <div class="product-description">
                <?php the_content(); ?>
            </div>

    <?php
        endwhile;
    endif;
    ?>

</main>

<?php get_footer(); // ton footer personnalisé ?>
