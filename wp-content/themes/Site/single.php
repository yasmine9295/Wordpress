<?php
get_header(); // Récuperer le header
// have_posts : Wordpress vérifie si du contenu doit être affiché
// the_posts : Si oui, wordpress charge les données du premier élément
while (have_posts()) : the_post();
?>
    <div style="width: 90%; margin: 40px auto;">
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    </div>
<?php
endwhile;
get_footer();
?>