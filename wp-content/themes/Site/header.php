<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header">
    <div class="header-container">
        <h1 class="logo">
            <a href="<?php echo home_url(); ?>">Fruits & Légumes Frais</a>
        </h1>

        <nav class="main-nav">
            <?php 
            wp_nav_menu([
                'theme_location' => 'menu-principal',
                'container'      => false,
                'menu_class'     => 'main-menu',
                'fallback_cb'    => false,
            ]); 
            ?>
        </nav>

        <!-- Lien panier dans le header  -->
        <?php if (function_exists('WC')) : ?>
            <div class="header-cart">
                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                    Panier 
                    <span class="cart-count">
                        (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                    </span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</header>
