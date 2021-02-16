<?php

/**
 * Plugin Name: Neobabis Views Counter
 * Description: Basic code for Pages, Posts (or Custom posts types) views counter
 * Author: Neokazis Charalampos
 * Author URI: https://neobabis.gr
 * Version: 1.0
 */

//  Increase views counter by one
function neobabis_set_views_counter()
{
    $key = 'views_counter';
    $id = get_the_ID();
    $counter = (int) get_post_meta($id, $key, true);
    $counter++;
    update_post_meta($id, $key, $counter);
}

// Returns number of views
function neobabis_get_views_counter()
{
    $counter = get_post_meta(get_the_ID(), 'views_counter', true);
    return "$counter views";
}

// For filter: manage_$_columns
function neobabis_views_counter_columns($columns)
{
    $columns['views'] = 'Views';
    return $columns;
}

// For action: manage_$_custom_column
function neobabis_views_counter_custom_column($column)
{
    if ($column === 'views') {
        echo neobabis_get_views_counter();
    }
}

// WordPress Filters and actions
// Posts
add_filter('manage_posts_columns', 'neobabis_views_counter_columns');
add_action('manage_posts_custom_column', 'neobabis_views_counter_custom_column');
// Pages
add_filter('manage_pages_columns', 'neobabis_views_counter_columns');
add_action('manage_pages_custom_column', 'neobabis_views_counter_custom_column');
