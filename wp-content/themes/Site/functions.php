<?php
defined( 'ABSPATH' ) || exit; 

function fruit_legume_setup() {
    add_theme_support( 'post-thumbnails' ); 
    add_theme_support( 'title-tag' );       
    add_theme_support( 'woocommerce' );     

    register_nav_menus([
        'menu-principal' => 'Menu Principal',
        'footer-menu'    => 'Menu Pied de page',
    ]);
}
add_action( 'after_setup_theme', 'fruit_legume_setup' );

function fruit_legume_assets() {
    wp_enqueue_style( 'fruit-legume-style', get_stylesheet_uri() );
    wp_enqueue_script( 'fruit-legume-script', get_template_directory_uri() . '/assets/js/main.js', [], false, true );

    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' );
    }
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

add_filter( 'woocommerce_add_to_cart_redirect', 'fruit_legume_redirect_to_cart' );
function fruit_legume_redirect_to_cart( $url ) {
    return wc_get_cart_url();
}

// Hooks personnalisés

function fruit_legume_before_footer() {
    do_action('fruit_legume_before_footer');
}

add_action('fruit_legume_before_footer', function() {
    echo '<p>Livraison gratuite pour toute commande de plus de 50€ !</p>';
});
//2eme
function fruit_legume_after_header() {
    do_action('fruit_legume_after_header');
}

add_action('fruit_legume_after_header', function() {
    echo '<div class="promo-banner" style="background:#F4F4F4; padding:10px; text-align:center;">
            <strong>🌱 Fraîcheur garantie !</strong> Tous nos produits sont issus d\'agriculteurs locaux.
          </div>';
});

function fruit_legume_home_title($title) {
    return apply_filters('fruit_legume_home_title_filter', $title);
}

// filtre
add_filter('fruit_legume_home_title_filter', function($title) {
    return $title . ' Votre marché local de fruits & légumes frais';
});

//Custom Post Type
function fruit_legume_custom_post_type() {
    $labels = [
        'name'               => 'Recettes',
        'singular_name'      => 'Recette',
        'menu_name'          => 'Recettes',
        'add_new'            => 'Ajouter une recette',
        'add_new_item'       => 'Ajouter une nouvelle recette',
        'edit_item'          => 'Modifier la recette',
        'new_item'           => 'Nouvelle recette',
        'view_item'          => 'Voir la recette',
        'search_items'       => 'Rechercher une recette',
        'not_found'          => 'Aucune recette trouvée',
        'not_found_in_trash' => 'Aucune recette dans la corbeille',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-carrot',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'       => true,
    ];

    register_post_type('recette', $args);
}
add_action('init', 'fruit_legume_custom_post_type');

//Taxonomie personnalisée 
function fruit_legume_custom_taxonomy() {
    $labels = [
        'name'              => 'Types de recettes',
        'singular_name'     => 'Type de recette',
        'search_items'      => 'Rechercher un type',
        'all_items'         => 'Tous les types',
        'edit_item'         => 'Modifier le type',
        'update_item'       => 'Mettre à jour le type',
        'add_new_item'      => 'Ajouter un nouveau type',
        'new_item_name'     => 'Nom du nouveau type',
        'menu_name'         => 'Types de recettes',
    ];

    register_taxonomy('type_recette', 'recette', [
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ]);
}
add_action('init', 'fruit_legume_custom_taxonomy');
