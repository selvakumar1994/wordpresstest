<?php

defined('ABSPATH') or die("No script kiddies please!");


$labels = array(
    'name' => _x('Everest FAQ Manager lite', 'post type general name', 'everest-faq-manager-lite'),
    'singular_name' => _x('Everest FAQ Manager lite', 'post type singular name', 'everest-faq-manager-lite'),
    'menu_name' => _x('Everest FAQ Manager Lite', 'admin menu', 'everest-faq-manager-lite'),
    'add_new' => _x('Add New Everest FAQ ', 'Everest FAQ', 'everest-faq-manager-lite'),
    'add_new_item' => __('Add New FAQ', 'everest-faq-manager-lite'),
    'edit' => __('Edit', 'everest-faq-manager-lite'),
    'new_item' => __('New Everest FAQ', 'everest-faq-manager-lite'),
    'edit_item' => __('Edit FAQ', 'everest-faq-manager-lite'),
    'view_item' => __('View FAQ', 'everest-faq-manager-lite'),
    'all_items' => __('All Everest FAQ', 'everest-faq-manager-lite'),
    'search_items' => __('Search Everest FAQ', 'everest-faq-manager-lite'),
    'not_found' => __('No Everest FAQ found.', 'everest-faq-manager-lite'),
    'not_found_in_trash' => __('No Everest FAQ found in Trash.', 'everest-faq-manager-lite'),
    'parent_item_colon' => __('Parent Everest FAQ:', 'everest-faq-manager-lite'),
);

$args = array(
    'labels' => $labels,
    'description' => __('Description.', 'everest-faq-manager-lite'),
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-pressthis',
    'query_var' => true,
    'rewrite' => array('slug' => 'everest-faq'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title')
);

register_post_type('everest-faq', $args);


