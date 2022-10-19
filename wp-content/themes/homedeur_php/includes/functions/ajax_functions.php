<?php
// ajax submit form login
function hd_user_login(){
     $return = array();
    if( $_POST['action'] != 'hd_ajax_user_login' )
        return;

    $email = $_POST['email'];
    $pw = $_POST['password'];

    $args = array(
        'user_login'    => $email,
        'user_password' => $pw,
        'remember'      => true
    );
 
    $user = wp_signon( $args, false );
    if ( is_wp_error( $user ) ) {
        $return['status'] = 'error';
        $return['message'] = 'Please check Email or Password!';
    }else{
        $return['status'] = 'success';
        $return['redirect'] = get_home_url();
    }

    die(json_encode($return));
}

// ajax submit form sign-up
function hd_user_signup(){
    $results = array();
    if( $_POST['action'] != 'hd_ajax_user_signup' ){
        return;
    }
    $firstname      = $_POST['firstname'];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
	
    $userdata = array(
        'user_login'  => $email,
        'first_name'  => $firstname,
        'user_email'  => $email,
        'user_pass'   => $password
    );

    $user  = wp_insert_user($userdata);
	
    if ( is_wp_error( $user) ) {
        $results['status'] = 'fail';
        $results['message'] = " Username In Use!";
    }else{
		
		//add to mailer list
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'official-mailerlite-sign-up-forms/mailerlite.php' ) ) {
			import_user_to_subscriber_list($email,$firstname);
		}
		
        $args = array(
            'user_login'    => $email,
            'user_password' => $password,
        );
     
        $user = wp_signon( $args, false );

        $feed_url = hd_get_page_by_slug('feed-select', true);

        if($feed_url){
            $redirect = $feed_url;
        }else{
            $redirect = get_home_url();
        }
        
        $results['status'] = 'success';
        $results['message'] = "Register Successful! Sign in to continue";
        $results['redirect'] = $redirect;
    }

    die(json_encode($results));
}

// ajax submit login with facebook
function hd_user_login_facebook(){
	if (defined('DOING_AJAX') && DOING_AJAX) { 
        check_ajax_referer( $_SESSION['ajax_nonce'], 'security' );
		
		$return = array();
		
		$email = $_POST['email'];
		$args = array(
			'user_login'    => $email
		);
		
		if( email_exists( $email )) {
			$user = wp_signon( $args, false );
			if ( is_wp_error( $user ) ) {
				$return['status'] = 'error';
				$return['message'] = 'Please check Email or Password!';
			}else{
				$return['status'] = 'success';
				$return['message'] = 'Login successful!';
				$return['redirect'] = get_home_url();
			}
		}else{
			$return['status'] = 'error';
			$return['message'] = 'Email does not exists. Please Signup!';
		}
		
		die(json_encode($return));
	}
	die('Nothing');
}

// ajax submit signup with facebook
function hd_user_signup_facebook(){
	if (defined('DOING_AJAX') && DOING_AJAX) { 
        check_ajax_referer( $_SESSION['ajax_nonce'], 'security' );
		
		$return = array();
		$first_name     = 	$_POST['first_name'];
		$email          = 	$_POST['email'];
		$password		=	wp_generate_password(8);
		
		$userdata = array(
			'user_login'  => $email,
			'first_name'  => $first_name,
			'user_email'  => $email,
			'user_pass'   => $password
		);

		$user  = wp_insert_user($userdata);
		
		if ( is_wp_error( $user) ) {
			$return['status'] = 'fail';
			$return['message'] = 'Username In Use!';
		}else{
			//send email after signup
			$subject = 'Register with facebook successful!';
			$message = "Hi, ". $first_name ."!\n\n";
			$message .= "Thank you for signup.\n\n";
			$message .= "Email login: ". $email ."\n\n";
			$message .= "Password: ". $password;
			
			wp_mail( $email, $subject, $message );
			
			//add to mailer list
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( 'official-mailerlite-sign-up-forms/mailerlite.php' ) ) {
				import_user_to_subscriber_list($email,$firstname);
			}
			
			$args = array(
				'user_login'    => $email,
				'user_password' => $password,
			);
		 
			$user = wp_signon( $args, false );

			$feed_url = hd_get_page_by_slug('feed-select', true);

			if($feed_url){
				$redirect = $feed_url;
			}else{
				$redirect = get_home_url();
			}
			
			$return['status'] = 'success';
			$return['message'] = "Register Successful! Sign in to continue";
			$return['redirect'] = $redirect;
		}
		die(json_encode($return));
	}
	die('Nothing');
}

//import_user_to_subscriber_list
function import_user_to_subscriber_list($email='', $first_name=''){
	if(empty($email))
		return;
	$api_key = get_option('mailerlite_api_key');
	//$api_key = '2afa7697d31a9d5f68613d70dcb68509';
	//list_id :3819225
	//list_id coi :4164287
	//echo 'key: '.$api_key;exit;
	require_once MAILERLITE_PLUGIN_DIR . "libs/mailerlite_rest/ML_Lists.php";
	require_once MAILERLITE_PLUGIN_DIR . "libs/mailerlite_rest/ML_Subscribers.php";
	$ML_Lists = new ML_Lists( $api_key );
	$list = $ML_Lists->getAll();
	
	$ML_Subscribers = new ML_Subscribers( $api_key );

	$subscriber = array(
		'email' => $email,
		'name' => $first_name,
	);
	$result = $ML_Subscribers->setId( 3819225 )->add( $subscriber );
}

// ajax submit form save product wishlist
function hd_user_save_product_wishlist(){
    if (defined('DOING_AJAX') && DOING_AJAX) { 
        check_ajax_referer( $_SESSION['ajax_nonce'], 'security' );
        $p_id = $_POST['product_id'];
        $user_id = get_current_user_id();
        if($user_id){
            $meta_key = "user_wishlist";
            $meta_wishlist = get_user_meta($user_id, $meta_key, true);
            
            if(!empty($meta_wishlist)){
                if(!in_array($p_id, $meta_wishlist)){
                    $meta_wishlist[$p_id] = $p_id;
                    $results['saved'] = 'set';
                }
                else{
                    unset($meta_wishlist[$p_id]);
                    $results['saved'] = 'unset';
                }
            
            }else{
                $meta_wishlist[$p_id] = $p_id;
                $results['saved'] = 'set';
            }

            update_user_meta( $user_id, $meta_key, $meta_wishlist);
            
            $results['status'] = 'success';

            die(json_encode($results));
        }else{
            die('Nothing.');
        }
    }
    die('Nothing.');
}
//quang
//Adding a Profile field.
function hd_user_modify($profile_fields) {

    // Add new fields
    $profile_fields['location'] = 'Location Address';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['twitter']  = 'Twitter URL';

    return $profile_fields;
}

// ajax submit form edit profile from frond-end
function hd_user_edit_profile(){
    $return= array();

    if( $_POST['action'] != 'hd_ajax_user_edit_profile' ){
        $return['status'] = false;
        $return['text'] = 'Sorry, nothing here!';
    }else{
        $name        = $_POST['u_name'];
        $email       = $_POST['u_email'];
        $location    = $_POST['u_location'];
        $face_url    = $_POST['u_face_url'];
        $twitter_url = $_POST['u_twitter_url'];
        $about       = $_POST['u_about'];
        $privacy     = $_POST['u_privacy'];
        $background  = $_POST['u_bg'];
        $currency    = $_POST['u_currency'];

        $user_id      = get_current_user_id();
       
        update_user_meta($user_id,'nickname',$name);
       
        $user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $email ) ); 

        update_user_meta($user_id,'location',$location);

        update_user_meta($user_id,'facebook',$face_url);

        update_user_meta($user_id,'twitter',$twitter_url);

        update_user_meta($user_id,'description',$about);

        update_user_meta($user_id,'u_privacy',$privacy);

        update_user_meta($user_id,'u_bg',$background);

        update_user_meta($user_id,'u_currency',$currency);
        
        $return['status'] = 'success';
        $return['message'] = 'edit successful!';
    }
    die(json_encode($return));
}

// ajax submit form change password from frond-end
function hd_user_change_pw(){
    $return  = array();
    if( $_POST['action'] != 'hd_ajax_user_update_pw' ){
        $return['status'] = false;
    }
    $old_pw       = $_POST['u_old_pw'];
    $new_pw       = $_POST['u_new_pw'];

    $user    = wp_get_current_user();

    if( wp_check_password( $old_pw, $user->data->user_pass, $user->ID )){
        $return['status'] = true;
    }else{
        $return['status'] = false;
    }

    if($return['status'] && !empty($new_pw))
    {
        wp_set_password( $new_pw, $user->ID );
        wp_signon(array('user_login' => $user->user_login, 'user_password' => $new_pw));
        $return['message'] = 'Edit successful!';
    }else{
        $return['status'] = false;
        $return['message'] = 'Edit failed!';
    }

    die(json_encode($return));
}

//ajax submit form save user feeds
function hd_save_user_feeds(){

    $return = array();
    if( $_POST['action'] != 'hd_ajax_save_user_feeds' ){
        $return['status'] = false;
        $return['message'] = 'Sorry!';
    }else{
        $post = get_post();
        $feeds_id = $_POST['feed_id'];
        $user_id = get_current_user_id();
        $meta_key = "user_feeds";
        $user_feeds = update_user_meta($user_id, $meta_key, $feeds_id);
        $return['status'] = true;
        $return['redirect'] = $_POST['redirect'];
        $return['message'] = 'Successful!';
    }
    die(json_encode($return));
}

//ajax submit form delete Account

function hd_ajax_user_delete_account(){
     $return = array();
    if (!is_user_logged_in() ) {
        $return['status'] = false;
        $return['message'] = 'Sorry!';
    }
    else{
        require_once(ABSPATH.'wp-admin/includes/user.php' );
        $user_id = wp_get_current_user();
        wp_delete_user( $user_id->ID);

        $return['redirect'] = get_home_url();
        $return['status'] = true;
        $return['message'] = 'Delete account cuccessful!';
    }
    die(json_encode($return));
}


//ajax loa more in all page
function hd_load_more(){
    if( $_POST['action'] != 'ajax_hd_load_more' ){
        return;
    }
    if($_POST['data_type'] == 'category' ){
        hd_load_more_categories();
    }elseif($_POST['data_type'] == 'wishlist' ){
        hd_load_more_wishlist();
    }else{
        hd_load_more_products();
    }
	exit;
}
function hd_load_more_products(){
    $paged = $_POST['paged'];

    if(is_user_logged_in()){
        $u_id = get_current_user_id();
        $user_data  = get_userdata($u_id);
        $user_meta  = get_user_meta($u_id);
        $currency   = $user_meta['u_currency'];
    
        if( count($currency) && $currency[0] != '' ){
            $currency   = $currency[0];
        }else{
            $currency   = 'usd';
        }
    }else{
        $currency   = 'usd';
    }
	
	$firstoffset = 0;
	if( isset($_POST['firstoffset']) && is_numeric($_POST['firstoffset'])){
		$firstoffset = $_POST['firstoffset'];
	}
	$offset = (($paged - 1) * 8) + $firstoffset;
    $m_key_filter= '_cmb_filter_price_' . $currency;
	$ppp = 8;
	if( isset($_POST['clone']) && is_numeric($_POST['clone'])){
		$ppp = $ppp + $_POST['clone'];
	}
    $args = array(
            'post_type'         => 	'hd_product',
            'posts_per_page'    => 	$ppp,
			'offset'			=>	$offset,
            'paged'             =>  $paged
        );
	
    if(isset($_POST['key']) && ($_POST['key'] != '') ){
		$args['s']	=	$_POST['key'];
	}
	
	if(isset($_POST['startprice']) && is_numeric($_POST['startprice']) ){
        $m_query = array(
                        'key' => $m_key_filter,
                        'value' => $_POST['startprice'],
                        'compare' => '>=',
                        'type' => 'numeric'
                    );

        $range['meta_query'][] = $m_query;
        $args = array_merge($args,$range);
    }

    if(isset($_POST['endprice']) && is_numeric($_POST['endprice']) ){
        $m_query_e = array(
                        'key' => $m_key_filter,
                        'value' => $_POST['endprice'],
                        'compare' => '<=',
                        'type' => 'numeric'
                    );
        $range['meta_query'][] = $m_query_e;
        $args = array_merge($args,$range);
    }
    
    if(isset($_POST['sortby'])){
		$order = array();
        if($_POST['sortby'] == 'newest'){
            $order = array(
                        'orderby'   =>  'date',
                    );
        }
        if($_POST['sortby'] == 'oldest'){
            $order = array(
                        'orderby'   =>  'date',
                        'order'     =>  'ASC'
                    );
        }
        if($_POST['sortby'] == 'price_asc'){
            $order = array(
                        'meta_key'  =>  $m_key_filter,
                        'orderby'   =>  'meta_value_num',
                        'order'     =>  'ASC',
                    );
        }
        if($_POST['sortby'] == 'price_desc'){
            $order = array(
                        'meta_key'  =>  $m_key_filter,
                        'orderby'   =>  'meta_value_num',
                        'order'     =>  'DESC',
                    );
        }
        if($_POST['sortby'] == 'popular'){
            $order = array(
                        'orderby' => 'comment_count'
                    );
        }

        $args = array_merge($args,$order);

    }

    if(isset($_POST['term_id']) && ($_POST['term_id'] !== '')){
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'hd_product_cat',
                                    'field'    => 'id',
                                    'terms'    => $_POST['term_id'],
                                ),
                            );
    }
	
    $products = new WP_Query( $args );
    $html = '';
    if( $products->have_posts()) :
		$i = 0;
        while( $products->have_posts() ) : $products->the_post();
			$i++;
            if(isset($_POST['view']) && ($_POST['view'] == 'true')){
				$view = true;
            }else{
				$view = false;
            }
			$class = '';
			if($i == $ppp){
				if( isset($_POST['clone']) && is_numeric($_POST['clone'])){
					$class='item_clone';
				}
			}
			$html .= hd_get_template_product('template/blocks/contents/product-item-share.php', 'thumb-small', $view, $class);
			
        endwhile;
    endif;
	
    die($html);

}
function hd_load_more_wishlist(){
        $paged = $_POST['paged'];     
        $u_id = get_current_user_id();
        $meta_wishlist = get_user_meta($u_id, 'user_wishlist', true);
        if( $paged == 2 ){
            $position = 10;
        }else{
            $position = ($paged-1)*8 + 2;
        }
        $terms = array_slice($meta_wishlist, $position, 8);
        if(is_array($meta_wishlist) && count($meta_wishlist)){
            $args = array(
                'post_type'     => 'hd_product',
                'posts_per_page'=> -1,
                'post__in'      => $terms,
                'paged'         =>  $paged
            );
            $products = new WP_Query($args);
        }
    $html = '';
    if( $products->have_posts()) :
        while( $products->have_posts() ) : 
            $products->the_post(); 
            $html .= hd_get_template_product('template/blocks/contents/wishlist-item.php');
        endwhile;
    endif;

    die($html);

}
function hd_load_more_categories(){
    

    $paged = $_POST['paged'];
    
	$offset = ($paged - 1) * 8 + 2;
	$args = array(
				'number'		=>	8,
                'offset'		=>	$offset,
				'exclude'		=>	24,
				'meta_query' => array(
					array(
							'key' => 'term_pin_top',
							'value' => 'false',
						),
				),
				'hide_empty'	=>	false
            );
	
    $terms = get_terms( 'hd_product_cat', $args );
    //$terms = array_slice($terms, $position, 8);

    if($terms){
        $html = '';
        foreach ($terms as $term) {
            $term_id = $term->term_id;
            $html .= hd_get_template_category_item( $term_id, 'hd_product_cat', 'small' );
        }
    }
    
    die($html);

}

//load template send email popup
function hd_get_popup_send_email(){
    if( $_POST['action'] != 'ajax_hd_get_template_popup_send_email' )
        return;

    $product_id = $_POST['product_id'];

    $html = hd_get_template_popup_send_email($product_id);
    die($html);
}

//send email
function hd_send_message_product_by_email(){
    if( $_POST['action'] != 'ajax_hd_send_message_product_by_email' )
        return;
        
    $from       =   $_POST['email_from'];
    $to         =   $_POST['email_to'];
    $to         =   str_replace(' ','',$to);
    $to         =   explode(',',$to);
    $flag       =   true;
    foreach( $to as $email ){
        if(!is_email($email)){
            $flag = false;
            break;
        }
    }
    $subject    =   'Email from Homedeur';
    $message    =   $_POST['mail_content'];
    $p_url      =   $_POST['url_post'];
    $p_title    =   $_POST['product_title'];
    $parts      =   explode("@", $from);
    $email_name =   $parts[0];
    if( empty($from) || empty($to) ){
        $error = __('Please enter fully information to send.');
    }else if(!is_email($from)){
        $error = __('Invalid e-mail address.');
    }else if( $flag == false ){
        $error = __('Invalid recipient e-mail address.');
    }else{
        $message .= "\r\n";
        $message .= "Sharing Product with You - ".$p_title. "\r\n";
        $message .= "View the Photos here :".$p_url. "\r\n";
        $headers  = 'From: '.$email_name.' <'.$from.'>' . "\r\n";
        $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        $mail = wp_mail( $to, $subject, $message, $headers);
        if( $mail ){
            $success = 'Your message has been send!';
        }else{
            $error = 'Error! Your message hasn\'t been send.';
        }
    }
    if( ! empty( $error ) ){
        $result = array('status'=>false, 'message'=>__($error));
    }
    if( ! empty( $success ) ){
        $result = array('status'=>true, 'message'=>__($success));
    }
    die(json_encode($result)); 
}