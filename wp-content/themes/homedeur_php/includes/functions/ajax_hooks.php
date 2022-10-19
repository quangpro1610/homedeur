<?php
// ajax submit form login
add_action('wp_ajax_hd_ajax_user_login','hd_user_login');
add_action('wp_ajax_nopriv_hd_ajax_user_login','hd_user_login');

// ajax submit form sign-up
add_action('wp_ajax_hd_ajax_user_signup','hd_user_signup');
add_action('wp_ajax_nopriv_hd_ajax_user_signup','hd_user_signup');

// ajax submit login with facebook
add_action('wp_ajax_hd_ajax_user_login_facebook','hd_user_login_facebook');
add_action('wp_ajax_nopriv_hd_ajax_user_login_facebook','hd_user_login_facebook');

// ajax submit sign-up with facebook
add_action('wp_ajax_hd_ajax_user_signup_facebook','hd_user_signup_facebook');
add_action('wp_ajax_nopriv_hd_ajax_user_signup_facebook','hd_user_signup_facebook');

// ajax save product for user
add_action('wp_ajax_ajax_save_product_wishlist','hd_user_save_product_wishlist');
add_action('wp_ajax_nopriv_ajax_save_product_wishlist','hd_user_save_product_wishlist');

// ajax submit form edit profile from frond-end
add_action('wp_ajax_hd_ajax_user_edit_profile','hd_user_edit_profile');
add_action('wp_ajax_nopriv_hd_ajax_user_edit_profile','hd_user_edit_profile');

// ajax submit form change password from frond-end
add_action('wp_ajax_hd_ajax_user_update_pw','hd_user_change_pw');
add_action('wp_ajax_nopriv_hd_ajax_user_update_pw','hd_user_change_pw');

// ajax submit form save feeds category from frond-end
add_action('wp_ajax_hd_ajax_save_user_feeds','hd_save_user_feeds');
add_action('wp_ajax_nopriv_hd_ajax_save_user_feeds','hd_save_user_feeds');

// ajax submit form delete account from frond-end
add_action('wp_ajax_hd_ajax_user_delete_account','hd_ajax_user_delete_account');
add_action('wp_ajax_nopriv_hd_ajax_user_delete_account','hd_ajax_user_delete_account');

// ajax set view col
add_action('wp_ajax_ajax_hd_set_col_view','hd_set_col_view');
add_action('wp_ajax_nopriv_ajax_hd_set_col_view','hd_set_col_view');

// ajax load more items
add_action('wp_ajax_ajax_hd_load_more','hd_load_more');
add_action('wp_ajax_nopriv_ajax_hd_load_more','hd_load_more');

// ajax load template send email
add_action('wp_ajax_ajax_hd_get_template_popup_send_email','hd_get_popup_send_email');
add_action('wp_ajax_nopriv_ajax_hd_get_template_popup_send_email','hd_get_popup_send_email');

// ajax send email
add_action('wp_ajax_ajax_hd_send_message_product_by_email','hd_send_message_product_by_email');
add_action('wp_ajax_nopriv_ajax_hd_send_message_product_by_email','hd_send_message_product_by_email');


 // Add new fields
add_filter('user_contactmethods', 'hd_user_modify');


// Save data user after submit.
//add_action( 'personal_options_update', 'saver_radio_profile_fields' );
//add_action( 'edit_user_profile_update', 'saver_radio_profile_fields' );

/* Adding Image Upload Fields */
//add_action( 'show_user_profile', 'avatar_profile_fields' );
//add_action( 'edit_user_profile', 'avatar_profile_fields' );
