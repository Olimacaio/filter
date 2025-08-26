# 🔎 AJAX Filter WP Example

This is a **example of an AJAX filter** for WordPress, to search and display posts dynamically without reloading the page.  
The goal was to demonstrate how to integrate **same languages** in a small functional project.

---

## 🚀 Technologies & Tools Used

- **HTML** → Page structure  
- **PHP** → Hook and callback function in WordPress  
- **WordPress (WP_Query)** → Query posts with search parameters  
- **jQuery** → DOM manipulation and AJAX request  
- **AJAX** → Asynchronous communication between frontend and backend  
- **Bootstrap** → Styling and responsiveness  

---

## ⚙️ How It Works

1. The user types in the search field.  
2. jQuery listens to the `keyup` event and sends an AJAX request to `admin-ajax.php`.  
3. PHP in WordPress receives the data via `$_POST`, executes a `WP_Query`, and returns the results.  
4. jQuery injects the results into the page without a reload.  

---

## 📂 Project Structure

├── page.php # Example frontend with input and results container
├── functions.php # AJAX callback in PHP using WP_Query
└── README.md # Project documentation

---

## JQuery/Ajax
<script>
    jQuery(document).ready(function($) {
      $('#filter-input').on('keyup', function() {
          var search = $(this).val();

          $.ajax({
              url: '<?php echo admin_url("admin-ajax.php"); ?>',
              type: 'POST',
              data: {
                  action: 'myfilter',
                  search: search
              },
              success: function(response) {
                  $('#filter-results').html(response);
              }
          });
      });
  });  
</script>

---

## Functions (PHP)
add_action('wp_ajax_myfilter', 'test_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'test_filter_function');

function test_filter_function(){

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
   
---

## 🎯 Goal
This is a simple example to introduce the WordPress dynamic filter logic to display results without reloading the page. In this case, I integrated PHP, AJAX, and jQuery into a WordPress Query.
    

