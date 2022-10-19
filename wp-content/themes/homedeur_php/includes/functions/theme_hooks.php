<?php
//load scripts admin
add_action( 'admin_enqueue_scripts', 'TheChon_add_scripts_admin' );

//remove adminbar
add_action('after_setup_theme', 'remove_admin_bar');

//custom thumbnail size
add_action('after_setup_theme', 'TheChon_thumbnail_size');

//wp_head
add_action('wp_head', 'hd_add_custom_meta');

//register menus
add_action( 'after_setup_theme', 'TheChon_register_menus' );

//load scripts
add_action( 'wp_enqueue_scripts', 'TheChon_add_scripts' );

//register sidebar
add_action( 'widgets_init', 'TheChon_footer_left_sidebar' );
add_action( 'widgets_init', 'TheChon_footer_right_sidebar' );
add_action( 'widgets_init', 'TheChon_page_about_sidebar' );
add_action( 'widgets_init', 'TheChon_subscribe_sidebar' );

//Register HD_Product Post Type
add_action( 'init', 'TheChon_HD_Product_post_type', 0 );

// Register HD Product Category
add_action( 'init', 'TheChon_hd_product_cat', 0 );

//Additional feature image for HD Product Category
add_action( 'hd_product_cat_add_form_fields', 'TheChon_hd_product_cat_add_feature_field', 10, 2 );
add_action( 'hd_product_cat_edit_form_fields', 'TheChon_hd_product_cat_edit_feature_field', 10, 2 );

// Save feature image for HD Product Category
add_action( 'edited_hd_product_cat', 'save_taxonomy_feature_field', 10, 2 );  
add_action( 'create_hd_product_cat', 'save_taxonomy_feature_field', 10, 2 );

// Add fix class pagination
add_filter('next_posts_link_attributes', 'posts_link_attributes_fl');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_fr');

// Logout user
add_action('init','hd_user_logout');

//Register HD_Teams Post Type
add_action('init', 'HD_TEAM_post_type');