<?php
add_action('init', 'ldk_start_session', 1);
add_action('wp_logout', 'ldk_end_session');
add_action('wp_login', 'ldk_end_session');

function ldk_start_session() {
    if(!session_id()) {
        session_start();
    }
}

function ldk_end_session() {
    session_destroy ();
}

//wp_head
function hd_add_custom_meta(){
	$output = '';
	if(is_page_template( 'template/page-feeds.php' ) || is_page_template( 'template/page-setting.php' ) || is_page_template( 'template/page-wishlist.php' ) || is_page_template( 'template/page-wishlist-share.php' )){
		$output = '<meta name="robots" content="noindex, nofollow" />';
	}
	echo $output;
}

 //load scripts admin
function TheChon_add_scripts_admin(){
	wp_enqueue_media();
	wp_enqueue_style('admin-style',get_template_directory_uri().'/css/admin/admin-style.css');
	wp_register_script('admin-script',get_template_directory_uri().'/js/admin/admin-scripts.js',array(), '', true );
	$arr = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce( "ldktechnology" ),
	);
	wp_localize_script('admin-script','obj',$arr );
	wp_enqueue_script('admin-script');
}

//load scripts
function TheChon_add_scripts(){
	wp_enqueue_style( 'default-style', get_stylesheet_uri() );

	wp_enqueue_script( 'main-jquery', get_template_directory_uri().'/js/jquery.min.js', array(), '', true );
	wp_enqueue_script( 'jquery-ui', 'http://code.jquery.com/ui/1.11.4/jquery-ui.js', array('main-jquery'), '', true );

	wp_register_script('main-script',get_template_directory_uri().'/js/scripts.js',array('main-jquery'), '', true );
	wp_register_script('jquery-slider',get_template_directory_uri().'/js/jquery.flexslider-min.js',array('main-jquery'), '', true );
	wp_enqueue_script('jquery-slider');
	if (defined('DOING_AJAX') && DOING_AJAX) { 
		
	}else{
		// A string
		$_SESSION['ajax_nonce'] = "ldktechnology" . time();
		$arr = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( $_SESSION['ajax_nonce'] ),
		);
		wp_localize_script('main-script','obj',$arr );
		wp_enqueue_script('main-script');

		wp_register_script('ajax-user',get_template_directory_uri().'/js/ajax/ajax_user.js',array('main-jquery'), '', true );
		//wp_localize_script('ajax-user','obj',$arr );
		wp_enqueue_script('ajax-user');
		
		wp_register_script('ajax-theme',get_template_directory_uri().'/js/ajax/ajax_theme.js',array('main-jquery'), '', true );
		//wp_localize_script('ajax-user','obj',$arr );
		wp_enqueue_script('ajax-theme');

		wp_register_script('ajax-filter',get_template_directory_uri().'/js/ajax/ajax_filter.js',array('main-jquery'), '', true );
		//wp_localize_script('ajax-user','obj',$arr );
		wp_enqueue_script('ajax-filter');
	}
}

//remove adminbar
function remove_admin_bar() {
  	show_admin_bar(false);
}

//custom thumbnail size
function TheChon_thumbnail_size(){
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'hd_product', 'hd_teams' ) );
    add_image_size( 'home-slider-large', 1170, 600, true );
    add_image_size( 'thumb-product-post', 770, 440, true );
	add_image_size( 'thumb-slider-small', 170, 100, true );
	add_image_size( 'thumb-large', 570, 570, true );
    add_image_size( 'thumb-middle', 570, 270, true );
    add_image_size( 'thumb-small', 270, 270, true );
    add_image_size( 'thumb-sidebar', 100, 70, true );
}

//register menus
function TheChon_register_menus(){
	register_nav_menus( array(
			'main_menu' => 'Main menu',
			'user_rollout_menu' => 'User rollout menu',
			'footer_menu_1' => 'Footer menu 1',
			'footer_menu_2' => 'Footer menu 2',
			'footer_menu_3' => 'Footer menu 3',
			'blog_menu' => 'Blog menu',
		));
}

//Register Sidebar
function TheChon_footer_left_sidebar(){
	$args = array(
			'name'          => __( 'Footer left', 'hd_theme' ),
			'id'            => 'footer_left',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		);
	register_sidebar( $args );
}


function TheChon_footer_right_sidebar(){
	$args = array(
			'name'          => __('Footer menu %d'),
	        'id'            => 'footer_menu',          
			'description'   => '',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<p class="widgettitle">',
			'after_title'   => '</p>' 
		);
	register_sidebars( 3, $args );
}

function TheChon_page_about_sidebar(){
	$args = array(
			'name'          => __('About Page', 'hd_theme'),
	        'id'            => 'about_page',          
			'description'   => '',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
		);
	register_sidebar( $args );
}

function TheChon_subscribe_sidebar(){
	$args = array(
			'name'          => __('Subscribe', 'hd_theme'),
	        'id'            => 'subscribe',          
			'description'   => '',
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
		);
	register_sidebar( $args );
}
//Register HD_Product Post Type
function TheChon_HD_Product_post_type() {

	$labels = array(
		'name'                  => _x( 'HD Products', 'Post Type General Name', 'hd_theme' ),
		'singular_name'         => _x( 'HD Product', 'Post Type Singular Name', 'hd_theme' ),
		'menu_name'             => __( 'HD Products', 'hd_theme' ),
		'name_admin_bar'        => __( 'HD Product', 'hd_theme' ),
		'archives'              => __( 'Item Archives', 'hd_theme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'hd_theme' ),
		'all_items'             => __( 'All Items', 'hd_theme' ),
		'add_new_item'          => __( 'Add New Item', 'hd_theme' ),
		'add_new'               => __( 'Add New', 'hd_theme' ),
		'new_item'              => __( 'New Item', 'hd_theme' ),
		'edit_item'             => __( 'Edit Item', 'hd_theme' ),
		'update_item'           => __( 'Update Item', 'hd_theme' ),
		'view_item'             => __( 'View Item', 'hd_theme' ),
		'search_items'          => __( 'Search Item', 'hd_theme' ),
		'not_found'             => __( 'Not found', 'hd_theme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'hd_theme' ),
		'featured_image'        => __( 'Featured Image', 'hd_theme' ),
		'set_featured_image'    => __( 'Set featured image', 'hd_theme' ),
		'remove_featured_image' => __( 'Remove featured image', 'hd_theme' ),
		'use_featured_image'    => __( 'Use as featured image', 'hd_theme' ),
		'insert_into_item'      => __( 'Insert into item', 'hd_theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'hd_theme' ),
		'items_list'            => __( 'Items list', 'hd_theme' ),
		'items_list_navigation' => __( 'Items list navigation', 'hd_theme' ),
		'filter_items_list'     => __( 'Filter items list', 'hd_theme' ),
	);
	$args = array(
		'label'                 => __( 'HD Product', 'hd_theme' ),
		'description'           => __( 'HD Product Description', 'hd_theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'hd_product_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-cart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'hd_product', $args );

}

// Register HD Product Category
function TheChon_hd_product_cat() {

	$labels = array(
		'name'                       => _x( 'HD Categories', 'Taxonomy General Name', 'hd_theme' ),
		'singular_name'              => _x( 'HD Category', 'Taxonomy Singular Name', 'hd_theme' ),
		'menu_name'                  => __( 'HD Categories', 'hd_theme' ),
		'all_items'                  => __( 'All Items', 'hd_theme' ),
		'parent_item'                => __( 'Parent Item', 'hd_theme' ),
		'parent_item_colon'          => __( 'Parent Item:', 'hd_theme' ),
		'new_item_name'              => __( 'New Item Name', 'hd_theme' ),
		'add_new_item'               => __( 'Add New Item', 'hd_theme' ),
		'edit_item'                  => __( 'Edit Item', 'hd_theme' ),
		'update_item'                => __( 'Update Item', 'hd_theme' ),
		'view_item'                  => __( 'View Item', 'hd_theme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'hd_theme' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'hd_theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'hd_theme' ),
		'popular_items'              => __( 'Popular Items', 'hd_theme' ),
		'search_items'               => __( 'Search Items', 'hd_theme' ),
		'not_found'                  => __( 'Not Found', 'hd_theme' ),
		'no_terms'                   => __( 'No items', 'hd_theme' ),
		'items_list'                 => __( 'Items list', 'hd_theme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'hd_theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'hd_product_cat', array( 'hd_product' ), $args );

}


//Register HD_Teams Post Type
function HD_TEAM_post_type()
{

    $label = array(
        'name' => 'HD Teams',
        'singular_name' => 'team'
    );
    $args = array(
        'labels' => $label,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array('post_tag' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-users',
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post' //
    );
 
    register_post_type('hd_teams', $args); 
}

//Additional feature image for HD Product Category
function TheChon_hd_product_cat_add_feature_field() {
	?>
	<div class="form-field">
		<label for="term_meta[term_thumbnail]"><?php _e( 'Thumbnail image', 'hd_theme' ); ?></label>
		<input type="text" name="term_meta[term_thumbnail]" id="term_meta[term_thumbnail]" value="">
		<a href="#" class="button choose_image">Choose image</a>
		<p class="description"><?php _e( 'Enter a url image for this field','hd_theme' ); ?></p>
	</div>
	<div class="form-field">
		<label><?php _e( 'Featured top', 'hd_theme' ); ?></label>
		Enable
		<input type="radio" name="term_meta[term_pin_top]" value="true"/>
		Disable
		<input type="radio" name="term_meta[term_pin_top]" value="fale"/>
		<p class="description"><?php _e( 'Enable/Disable to set append on featured top main categories page','hd_theme' ); ?></p>
	</div>
<?php
}

function TheChon_hd_product_cat_edit_feature_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	//$term_meta = get_option( "taxonomy_$t_id" );
	$thumb_url = get_term_meta($t_id, 'term_thumbnail', true);
	$pin_top = get_term_meta($t_id, 'term_pin_top', true);
	$e_checked = $d_checked = '';
	if( isset($pin_top) && $pin_top == 'true' ){
	 	$e_checked = 'checked';
	}else{
		$d_checked = 'checked';
	}

?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[term_thumbnail]"><?php _e( 'Thumbnail image', 'hd_theme' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[term_thumbnail]" id="term_meta[term_thumbnail]" value="<?php echo esc_attr( $thumb_url ) ? esc_attr( $thumb_url ) : ''; ?>">
			<a href="#" class="button choose_image">Choose image</a>
			<p class="description"><?php _e( 'Enter a url image for this field','hd_theme' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label"><?php _e( 'Featured top', 'hd_theme' ); ?></label></th>
		<td>
			Enable
			<input type="radio" name="term_meta[term_pin_top]" value="true" <?php echo $e_checked; ?> />
			Disable
			<input type="radio" name="term_meta[term_pin_top]" value="false" <?php echo $d_checked; ?> />
			<p class="description"><?php _e( 'Enable/Disable to set append on featured top main categories page','hd_theme' ); ?></p>
		</td>
	</tr>
<?php
}

// Save feature image for HD Product Category
function save_taxonomy_feature_field( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				update_term_meta( $term_id, $key, $_POST['term_meta'][$key] );
			}
		}
	}
}

// Add fix class pagination
function posts_link_attributes_fl() {
    return 'class="fl button_blog ion-chevron-left"';
}
function posts_link_attributes_fr() {
    return 'class="fr button_blog ion-chevron-right"';
}

// Logout user
function hd_user_logout(){
    if(isset($_GET['logout'])){
        wp_logout();
        wp_redirect(home_url());
        exit;
    }
}

// Get the attachment ID from the file URL
function hd_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}


// get page url by slug
function hd_get_page_by_slug($slug='', $return=false){

	if( $slug == '' ){
		return;
	}

	$page = get_page_by_path( $slug );
	$page_url = get_permalink( $page );

	if($return){
		return $page_url;
	}else{
		echo $page_url;
	}
}


// get page url by slug
function hd_get_image_src_by_id($img_id='', $size='', $return=true){
	$img_attrs = wp_get_attachment_image_src( $img_id, $size );
	if(!empty($img_attrs)){
		$img_src = $img_attrs[0];
	}else{
		$img_src = '';
	}
	if($return){
		return $img_src;
	}else{
		echo $img_src;
	}
}

//get currency symbol
function hd_get_currency_symbol($retrun = true){
	if(is_user_logged_in()){
		$u_id = get_current_user_id();
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

	$symbol = '';
	
	if($currency=='eur'){
		$symbol = '€';
	}elseif($currency=='jpy'){
		$symbol = '¥';
	}elseif($currency=='gbp'){
		$symbol = '£';
	}else{
		$symbol = '$';
	}

	if($retrun){
		return $symbol;
	}else{
		echo $symbol;
	}
}

// Save price filter metadata when a post type HD_product is saved.
function save_product_meta_price_filter( $post_id, $post, $update ) {
    $slug = 'hd_product';
    if ( $slug != $post->post_type ) {
        return;
    }
    $arr = array('usd', 'eur', 'gbp', 'jpy');
    foreach ($arr as $key => $value) {
    	$currency = $value;
    	$m_key_regular = '_cmb_regular_price_' . $currency;
    	$m_key_sale = '_cmb_sale_price_' . $currency;
    	$m_key_filter_price = '_cmb_filter_price_' . $currency;
    	// echo $currency . ':' . $_REQUEST[$m_key_regular];
    	// echo $currency . ':' . $_REQUEST[$m_key_sale];

    	if(isset($_REQUEST[$m_key_sale]) && !empty($_REQUEST[$m_key_sale])  ){
    		$m_val_filter_price = $_REQUEST[$m_key_sale];
    	}else{
    		if(isset($_REQUEST[$m_key_regular]) && !empty($_REQUEST[$m_key_regular])){
    			$m_val_filter_price = $_REQUEST[$m_key_regular];
    		}
    		else{
    			$m_val_filter_price = 0;
    		}
    	}

    update_post_meta( $post_id, $m_key_filter_price, $m_val_filter_price);
    }
}
add_action( 'save_post', 'save_product_meta_price_filter', 10, 3 );

//custom query var
function add_my_rewrite() {
    add_rewrite_rule( 'user/([^/]+)', 'index.php?pagename=user&user_name=$matches[1]', 'top' );
	flush_rewrite_rules();
}
add_action('init', 'add_my_rewrite');

function add_my_var($vars) {
    $vars[] = 'user_name';
    return $vars;
}
add_filter('query_vars', 'add_my_var');
