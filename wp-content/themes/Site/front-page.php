<?php get_header(); ?>

<section class="hero">
    <h2>Fruits & Légumes Frais, Locaux et de Saison</h2>
    <p>Découvrez nos meilleurs produits directement du producteur à votre assiette.</p>
</section>

<section class="products">
    <h3>Nos Produits Phare</h3>

    <div class="product-grid">
        <div class="product-card">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pommes.jpg" alt="Pommes">
            <h4>Pommes</h4>
        </div>

        <div class="product-card">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/carottes.jpg" alt="Carottes">
            <h4>Carottes</h4>
        </div>

        <div class="product-card">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/tomates.jpg" alt="Tomates">
            <h4>Tomates</h4>
        </div>
    </div>
</section>

<?php get_footer(); ?>
