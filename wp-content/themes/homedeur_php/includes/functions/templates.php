<?php
function hd_get_template_category_item( $term_id='', $taxonomy='category', $size='small', $return=false ){

	if( empty($term_id) )
		return;

	$term = get_term_by( 'id', $term_id, $taxonomy );

	if( !$term )
		return;

	$term_name = $term->name;
	$url_img = get_term_meta($term_id, 'term_thumbnail', true);
	$img_id = hd_get_image_id( $url_img );

	if( $size == 'large' ){
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-large' );
	}elseif( $size == 'middle' ){
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-middle' );
	}else{
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-small' );
	}
	
	if(!empty($img_attrs)){
		$img_src = $img_attrs[0];
	}else{
		$img_src = '';
	}
    // add search form so that users can search other posts
	$item = '<div class="item item_cat">
				<div class="main_item">
					<div class="thumbnail">
						<div class="overlay"></div>
						<img src="'. $img_src .'" alt="'. $term_name .'" />
						<a href="'.esc_attr(get_term_link($term, $taxonomy)).'" class="button item_cat_link">'. $term_name .'</a>
					</div>
				</div>
			</div><!-- item -->';	

	if($return){

		return $item;

	}else{

		echo $item;

	}
}

function hd_get_template_product($template_part, $thumb_size = 'thumb-small', $view = false, $inc_class=''){
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
		$GLOBALS['user_wishlist'] = get_user_meta($u_id, 'user_wishlist', true);
		
	}else{
		$currency   = 'usd';
		$GLOBALS['user_wishlist'] = array();
	}

	$post_id = get_the_ID();
	
	if(!empty($currency)){
		$price_key = '_cmb_regular_price_' . $currency;
		$sale_key = '_cmb_sale_price_' . $currency;
		$price = get_post_meta( $post_id, $price_key, true); 
		$sale = get_post_meta( $post_id, $sale_key, true);
	}

	$symbol = hd_get_currency_symbol();
	$price = empty($price) ? 'Free' :  $symbol . $price;
	$sale = empty($sale) ? '' : $symbol . $sale;
	

	$p_recommended = get_post_meta( $post_id, '_cmb_product_recommended', true);
	$p_discount = get_post_meta( $post_id, '_cmb_product_discount', true);
	$p_crowdfunding = get_post_meta( $post_id, '_cmb_product_crowdfunding', true);
	$p_video = get_post_meta( $post_id, '_cmb_product_video', true);
	
	//load view item 2 col or 4 col
	$class = '';
	if($view == true){
		if(isset($_COOKIE['view_col'])){
			$class = $_COOKIE['view_col'];
		}
	}
	
	include( locate_template( $template_part, false, false ) ); 
}

// get cover
function hd_get_template_cover( $user_id='' ){

	if( $user_id == '' ){
		$user_id = get_current_user_id();
	}

	if(!is_numeric($user_id)){
		return;
	}

	$userdata = get_userdata($user_id);
	$usermeta = get_user_meta($user_id);

	$u_name = $u_description = $u_location = $u_facebook = $u_twitter = '';

	if( isset($usermeta['nickname']) ){
		$u_name = reset($usermeta['nickname']);
	}
	if( isset($usermeta['description']) ){
		$u_description = reset($usermeta['description']);
	}
	if( isset($usermeta['location']) ){
		$u_location = reset($usermeta['location']);
	}
	if( isset($usermeta['facebook']) ){
		$u_facebook = reset($usermeta['facebook']);
	}
	if( isset($usermeta['twitter']) ){
		$u_twitter = reset($usermeta['twitter']);
	}
	$template_part = 'template/users/cover-item.php';
	include( locate_template( $template_part, false, false ) );
}

function hd_get_template_form_feeds($redirect = ''){
	$user_feeds = array();
	if( is_user_logged_in() ){
		$user_id = get_current_user_id();
		$user_feeds = get_user_meta( $user_id, 'user_feeds', true );
		if( !is_array($user_feeds) || !count($user_feeds)){
			$user_feeds = array();
		}
	}

	$args = array(
			'hide_empty'	=> false,
			'exclude'		=>	24
		);
	$terms = get_terms( 'hd_product_cat', $args );

	$template_part = 'template/users/feeds.php';
	include( locate_template( $template_part, false, false ) );
}

// get random category with thumb-size
function hd_get_random_item_category( $thumb_size = 'thumb-middle', $return = false ){
	$args = array(
			'taxonomy'		=>	'hd_product_cat',
			'hide_empty'	=>	false,
			'exclude'		=>	24
		);
	$terms = get_terms($args);
	shuffle($terms);
	$term = $terms[0];
	$term_id = $term->term_id;
	$tern_name = $term->name;
	$tern_desc = $term->description;
	$term_link = get_term_link($term_id);
	$url_img = get_term_meta($term_id, 'term_thumbnail', true);
	$img_id = hd_get_image_id( $url_img );

	if( $thumb_size == 'thumb-large' ){
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-large' );
	}elseif( $thumb_size == 'thumb-small' ){
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-small' );
	}else{
		$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-middle' );
	}
	
	if(!empty($img_attrs)){
		$img_src = $img_attrs[0];
	}else{
		$img_src = '';
	}
	$html = '<div class="item random_cat_item item_cat">
				<div class="main_item">
					<div class="thumbnail">
						<div class="overlay"></div>
						<img width="570" height="270" src="'. $img_src .'" class="" alt="'. $term_name .'" />
						<div class="content_cat_item">
							<div>
								<h5>'. $tern_name .'</h5>
								<p>'.$tern_desc.'</p>
								<a href="'. $term_link .'" title="All categories" class="button item_cat_link">View Category</a>
							</div>
						</div>
					</div>
				</div>
			</div>';

	if($return){
		return $html;
	}else{
		echo $html;
	}

}

function hd_get_template_product_infos($p_id=''){
	if($p_id=='')
		return;

	$template_part = 'template/blocks/contents/product-item-information.php';
	include( locate_template( $template_part, false, false ) );
}

function hd_get_template_product_share($p_id=''){
	if($p_id=='')
		return;

	$template_part = 'template/blocks/social-share-sidebar.php';
	include( locate_template( $template_part, false, false ) );
}

//get template form email
function hd_get_template_popup_send_email($p_id=''){
	if(empty($p_id))
		return;
	
    $product = get_post( $p_id );
    $product_title = $product->post_title;
    $product_url = get_permalink($p_id);
	$template_part = 'template/common/send-email-popup.php';
	include( locate_template( $template_part, false, false ) );
}