<?php

defined('ABSPATH') || exit;

get_header();
?>

<main class="woocommerce-page">
    <div style="width: 90%; margin: 40px auto;">
        
        <?php

        do_action('woocommerce_before_main_content');
        
        woocommerce_content();
        
        do_action('woocommerce_after_main_content');
        ?>
        
    </div>
</main>

<?php get_footer(); ?>