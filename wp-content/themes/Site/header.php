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
            <?php wp_nav_menu([
                'theme_location' => 'menu-principal'
            ]); ?>
        </nav>
    </div>
</header>
