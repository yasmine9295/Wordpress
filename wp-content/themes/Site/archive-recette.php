<?php
defined( 'ABSPATH' ) || exit; // sécurité
get_header(); // inclut le header du thème
?>

<main class="archive-recette-page">
    <h1><?php post_type_archive_title(); ?></h1> <!-- Titre dynamique de l’archive -->

    <?php if ( have_posts() ) : ?>
        <div class="recettes-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px;">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="recette-card" style="border:1px solid #ddd; padding:15px; border-radius:8px; text-align:center;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', ['style'=>'width:100%; height:auto; border-radius:5px;']); ?>
                        </a>
                    <?php endif; ?>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p>Aucune recette trouvée.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
