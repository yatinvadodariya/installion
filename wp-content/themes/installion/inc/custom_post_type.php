<?php
add_action('init', 'custom_post_type_archetype');

function custom_post_type_archetype() {
   //custom_post_type_testimonial();

}

function custom_post_type_testimonial() {
    $labels = array(
        'name' => _x('Testimonial', 'Testimonial', 'archetype'),
        'singular_name' => _x('Testimonial', 'Testimonial', 'archetype'),
        'menu_name' => __('Testimonial', 'archetype'),
        'name_admin_bar' => __('Testimonial', 'archetype'),
        'all_items' => __('All Testimonial', 'archetype'),
        'add_new_item' => __('Add New Testimonial', 'archetype'),
        'add_new' => __('Add New', 'archetype'),
        'new_item' => __('New Testimonial', 'archetype'),
        'edit_item' => __('Edit Testimonial', 'archetype'),
        'update_item' => __('Update Testimonial', 'archetype'),
        'view_item' => __('View Testimonial', 'archetype'),
        'view_items' => __('View Testimonial', 'archetype'),
        'search_items' => __('Search Testimonial', 'archetype'),
        'not_found' => __('Testimonial Not found', 'archetype'),
        'not_found_in_trash' => __('Testimonial Not found in Trash', 'archetype'),
        'featured_image' => __('Testimonial Image', 'archetype'),
        'set_featured_image' => __('Set Testimonial image', 'archetype'),
        'remove_featured_image' => __('Remove Testimonial image', 'archetype'),
        'use_featured_image' => __('Use as Testimonial image', 'archetype'),
        'insert_into_item' => __('Insert into Testimonial', 'archetype'),
        'uploaded_to_this_item' => __('Uploaded to this Testimonial', 'archetype'),
    );
    $args = array(
        'label' => __('Testimonial', 'archetype'),
        'description' => __('Testimonial Description', 'archetype'),
        'labels' => $labels,
		'supports' => array('title', 'thumbnail', 'page-attributes','trackbacks','custom-fields','revisions','editor'),
        'hierarchical' => false,
        'public' => true,
		'query_var' => true,
        'show_ui' => true,
        'rewrite' => array( 'slug' => 'testimonial' ),
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
    );
    register_post_type('archetypetestimonial', $args);
}
