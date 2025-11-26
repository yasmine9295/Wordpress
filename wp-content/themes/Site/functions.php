<?php

defined( 'ABSPATH' ) || exit; 

function fruit_legume_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );


    register_nav_menus([
        'menu-principal' => 'Menu Principal',
        'footer-menu'    => 'Menu Pied de page',
    ]);

    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'fruit_legume_setup' );
function fruit_legume_assets() {
    wp_enqueue_style( 'fruit-legume-style', get_stylesheet_uri() );
    wp_enqueue_script( 'fruit-legume-script', get_template_directory_uri() . '/assets/js/main.js', [], false, true );
}
add_action( 'wp_enqueue_scripts', 'fruit_legume_assets' );

function fruit_legume_widgets_init() {
    register_sidebar([
        'name'          => 'Sidebar Principale',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action( 'widgets_init', 'fruit_legume_widgets_init' );
add_filter( 'woocommerce_product_add_to_cart_text', function() {
    return __( 'Ajouter au panier', 'fruit-legume' );
});
