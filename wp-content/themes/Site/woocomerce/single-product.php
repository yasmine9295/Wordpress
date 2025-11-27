<?php
defined( 'ABSPATH' ) || exit; // Sécurité : empêche l'accès direct au fichier
get_header(); // Charge le header du thème
?>

<main class="single-product-page">

    <?php 
    // Vérifie s'il y a des produits à afficher
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 
        
            global $product; // Récupération de l'objet produit WooCommerce
    ?>

        <article class="single-product-container">

            <!-- Titre du produit -->
            <h2 class="product-title"><?php the_title(); ?></h2>

            <!-- Image du produit -->
            <div class="product-image">
                <?php
                // Affiche l'image du produit s'il en a une
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('large');
                }
                ?>
            </div>

            <!-- Informations principales du produit -->
            <div class="product-summary">

                <!-- Prix du produit -->
                <div class="product-price">
                    <?php 
                    // Affiche le prix formaté (WooCommerce gère la mise en forme)
                    echo $product->get_price_html(); 
                    ?>
                </div>

                <!-- État du stock du produit -->
                <div class="product-stock">
                    <?php 
                    // Affiche le stock (en stock / rupture)
                    echo wc_get_stock_html( $product ); 
                    ?>
                </div>

                <!-- Bouton Ajouter au panier -->
                <div class="product-cart">
                    <?php 
                    // Affiche automatiquement le bon formulaire "Ajouter au panier"
                    // WooCommerce gère tous les types de produits (simple, variable, etc.)
                    woocommerce_template_single_add_to_cart();
                    ?>
                </div>

            </div>

            <!-- Description du produit -->
            <div class="product-description">
                <h3>Description</h3>
                <?php 
                // Affiche la description complète du produit
                the_content(); 
                ?>
            </div>

        </article>

    <?php 
        endwhile; 
    endif; 
    ?>

</main>

<?php get_footer(); // Charge le footer du thème ?>
