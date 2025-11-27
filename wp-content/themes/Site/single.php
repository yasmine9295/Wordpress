<?php
get_header();
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