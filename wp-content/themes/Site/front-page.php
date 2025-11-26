<?php get_header(); ?>

<section class="hero">
    <h2>Fruits & Légumes Frais, Locaux et de Saison</h2>
    <p>Découvrez nos meilleurs produits directement du producteur à votre assiette.</p>
</section>

<section class="products">
    <h3>Nos Produits Phare</h3>

    <div class="product-grid">
        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $loop = new WP_Query($args);

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
        ?>
                <div class="product-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } else {
                            echo '<img src="' . wc_placeholder_img_src() . '" alt="Produit">';
                        }
                        ?>
                    </a>

                    <h4>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>

                    <div class="product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <div class="product-button">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucun produit disponible pour le moment.</p>';
        endif;
        ?>
    </div>

    <div class="shop-link" style="text-align: center; margin-top: 30px;">
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="button">
            Voir tous les produits →
        </a>
    </div>
</section>

<?php get_footer(); ?>