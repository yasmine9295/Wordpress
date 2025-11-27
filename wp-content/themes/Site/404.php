<?php
defined( 'ABSPATH' ) || exit; 
get_header();
?>

<main class="page-404" style="text-align:center; padding:100px 20px;">
    <h1>404 - Page non trouvée</h1>
    <p>Oups ! La page que vous cherchez n'existe pas.</p>
    <a href="<?php echo home_url(); ?>" style="display:inline-block; margin-top:20px; padding:10px 20px; background:#4CAF50; color:white; text-decoration:none; border-radius:5px;">Retour à l'accueil</a>
</main>

<?php get_footer(); ?>
