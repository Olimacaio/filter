<?php
add_action('wp_ajax_myfilter', 'test_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'test_filter_function');

function test_filter_function()
{

    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        's'              => $search,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<ul>';
        while ($query->have_posts()) : $query->the_post();
            echo '<li>' . get_the_title() . '</li>';
        endwhile;
        echo '</ul>';
        wp_reset_postdata();
    else :
        echo '<p>' . __('Não há resultados', 'domain') . '</p>';
    endif;

    wp_die();
}
?>
