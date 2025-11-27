<?php
/**
 * Plugin Name: Fruit Légume Extension
 * Plugin URI: https://example.com
 * Description: Extension personnalisée pour ajouter un CPT Recettes, une taxonomie et des fonctionnalités WooCommerce
 * Version: 1.0.0
 * Author: Votre Nom
 * Author URI: https://example.com
 * Text Domain: fruit-legume-extension
 * Domain Path: /languages
 */

defined('ABSPATH') || exit; // Sécurité : empêche l'accès direct au fichier

// -------------------------------
// 1. CUSTOM POST TYPE "Recettes"
// -------------------------------
function fle_register_recettes_cpt() {

    // Labels visibles dans l'admin WordPress
    $labels = array(
        'name'                  => 'Recettes',
        'singular_name'         => 'Recette',
        'menu_name'             => 'Recettes',
        'add_new'               => 'Ajouter une recette',
        'add_new_item'          => 'Ajouter une nouvelle recette',
        'edit_item'             => 'Modifier la recette',
        'new_item'              => 'Nouvelle recette',
        'view_item'             => 'Voir la recette',
        'search_items'          => 'Rechercher des recettes',
        'not_found'             => 'Aucune recette trouvée',
        'not_found_in_trash'    => 'Aucune recette dans la corbeille',
    );

    // Arguments du CPT
    $args = array(
        'labels'                => $labels,
        'public'                => true,  // visible sur le site
        'has_archive'           => true,  // archive activée
        'publicly_queryable'    => true,  
        'show_ui'               => true,  
        'show_in_menu'          => true,  
        'menu_icon'             => 'dashicons-carrot', // icône menu admin
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'), // champs supportés
        'rewrite'               => array('slug' => 'recettes'), // URL personnalisée
        'show_in_rest'          => true, // compatible Gutenberg / REST API
    );

    // Enregistre le CPT "recette"
    register_post_type('recette', $args);
}
add_action('init', 'fle_register_recettes_cpt'); // Hook WordPress pour initialiser le CPT

// --------------------------------------
// 2. TAXONOMIE "Type de recette"
// --------------------------------------
function fle_register_type_recette_taxonomy() {

    // Labels visibles dans l'admin
    $labels = array(
        'name'              => 'Types de recette',
        'singular_name'     => 'Type de recette',
        'search_items'      => 'Rechercher des types',
        'all_items'         => 'Tous les types',
        'edit_item'         => 'Modifier le type',
        'update_item'       => 'Mettre à jour le type',
        'add_new_item'      => 'Ajouter un nouveau type',
        'new_item_name'     => 'Nouveau type de recette',
        'menu_name'         => 'Types de recette',
    );

    // Arguments de la taxonomie
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // style catégories
        'public'            => true, 
        'show_ui'           => true, 
        'show_admin_column' => true, 
        'show_in_rest'      => true, // REST API
        'rewrite'           => array('slug' => 'type-recette'),
    );

    // Enregistre la taxonomie pour le CPT "recette"
    register_taxonomy('type_recette', array('recette'), $args);
}
add_action('init', 'fle_register_type_recette_taxonomy'); // Hook pour initialiser la taxonomie

// --------------------------------------------------
// 3. HOOK / FILTRE WOOCOMMERCE : Modifier le bouton
// --------------------------------------------------
function fle_custom_add_to_cart_text($text) {
    // Si on est sur une page produit WooCommerce
    if (is_product()) {
        return '🛒 Ajouter à mon panier'; // Texte personnalisé
    }
    return $text; // sinon garde le texte original
}
add_filter('woocommerce_product_single_add_to_cart_text', 'fle_custom_add_to_cart_text');

// --------------------------------------------------
// 4. SHORTCODE : Afficher les recettes en grille
// --------------------------------------------------
function fle_recettes_shortcode($atts) {

    // Valeurs par défaut
    $atts = shortcode_atts(array(
        'nombre' => 6, // nombre de recettes affichées
        'type'   => '', // type de recette spécifique
    ), $atts);

    // Arguments pour la requête WP_Query
    $args = array(
        'post_type'      => 'recette',
        'posts_per_page' => intval($atts['nombre']),
        'post_status'    => 'publish',
    );

    // Filtrer par type si défini
    if (!empty($atts['type'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'type_recette',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($atts['type']),
            ),
        );
    }

    $query = new WP_Query($args); // Exécute la requête

    ob_start(); // Démarre le buffer pour retourner le contenu

    if ($query->have_posts()) {
        echo '<div class="recettes-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px;">';
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="recette-card" style="border:1px solid #ddd; padding:15px; border-radius:8px; text-align:center;">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium', array('style' => 'width:100%; height:auto; border-radius:5px; margin-bottom:10px;')); ?>
                    </a>
                <?php endif; ?>

                <h3 style="margin:10px 0; font-size:18px;">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none; color:#333;">
                        <?php the_title(); ?>
                    </a>
                </h3>

                <?php
                // Affiche le type de recette
                $types = get_the_terms(get_the_ID(), 'type_recette');
                if ($types && !is_wp_error($types)) {
                    echo '<p style="color:#4CAF50; font-size:14px; margin:5px 0;">';
                    echo esc_html($types[0]->name);
                    echo '</p>';
                }
                ?>

                <div class="recette-excerpt" style="font-size:14px; color:#666; margin:10px 0;">
                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                </div>

                <a href="<?php the_permalink(); ?>" class="button" style="display:inline-block; background:#4CAF50; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; margin-top:10px;">
                    Voir la recette
                </a>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p>Aucune recette trouvée.</p>';
    }

    wp_reset_postdata(); // Réinitialise la requête principale

    return ob_get_clean(); // Retourne le contenu généré
}
add_shortcode('recettes', 'fle_recettes_shortcode'); // Enregistre le shortcode [recettes]

// --------------------------------------------------
// Activation / Désactivation du plugin
// --------------------------------------------------
function fle_activation() {
    fle_register_recettes_cpt(); // Crée le CPT
    fle_register_type_recette_taxonomy(); // Crée la taxonomie
    flush_rewrite_rules(); // Met à jour les permaliens
}
register_activation_hook(__FILE__, 'fle_activation');

function fle_deactivation() {
    flush_rewrite_rules(); // Réinitialise les permaliens à la désactivation
}
register_deactivation_hook(__FILE__, 'fle_deactivation');
