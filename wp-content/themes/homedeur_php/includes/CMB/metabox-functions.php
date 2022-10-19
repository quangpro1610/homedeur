<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'custom_post_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
 
function custom_post_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	//include to home slider
	$meta_boxes['product_options'] = array(
		'id'         => 'product_options',
		'title'      => __( 'Product options', 'cmb' ),
		'pages'      => array( 'hd_product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' 		=> __( 'Include to home slider', 'cmb' ),
				'id'   		=> $prefix . 'include_to_home_slider',
				'type' 		=> 'radio_inline',
				'options' 	=> array(
					'false'		=> __( 'Disable (Default)', 'cmb' ),
					'true'   	=> __( 'Enable', 'cmb' ),
				),
				'default'	=>	'false',
			),
		)
	);
	
	//product status metabox
	$meta_boxes['product_status'] = array(
		'id'         => 'product_status',
		'title'      => __( 'Product status', 'cmb' ),
		'pages'      => array( 'hd_product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' 		=> __( 'Recommended', 'cmb' ),
				'id'   		=> $prefix . 'product_recommended',
				'type' 		=> 'radio_inline',
				'options' 	=> array(
					'false'		=> __( 'Disable (Default)', 'cmb' ),
					'true'   	=> __( 'Enable', 'cmb' ),
				),
			),
			array(
				'name' 		=> __( 'Discount', 'cmb' ),
				'id'   		=> $prefix . 'product_discount',
				'type' 		=> 'radio_inline',
				'options' 	=> array(
					'false'		=> __( 'Disable (Default)', 'cmb' ),
					'true'   	=> __( 'Enable', 'cmb' ),
				),
			),
			array(
				'name' 		=> __( 'Crowdfunding', 'cmb' ),
				'id'   		=> $prefix . 'product_crowdfunding',
				'type' 		=> 'radio_inline',
				'options' 	=> array(
					'false'		=> __( 'Disable (Default)', 'cmb' ),
					'true'   	=> __( 'Enable', 'cmb' ),
				),
			),
			array(
				'name' 		=> __( 'Video', 'cmb' ),
				'id'   		=> $prefix . 'product_video',
				'type' 		=> 'radio_inline',
				'options' 	=> array(
					'false'		=> __( 'Disable (Default)', 'cmb' ),
					'true'   	=> __( 'Enable', 'cmb' ),
				),
			),
		)
	);

	$meta_boxes['price_metabox'] = array(
		'id'         => 'price_metabox',
		'title'      => __( 'Product price', 'cmb' ),
		'pages'      => array( 'hd_product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Regular price', 'cmb' ),
				'desc' => __( 'Default USD.', 'cmb' ),
				'id'   => $prefix . 'regular_price_usd',
				'type' => 'text',
			),
			array(
				'name' => __( 'Sale price', 'cmb' ),
				'desc' => __( 'Default USD.', 'cmb' ),
				'id'   => $prefix . 'sale_price_usd',
				'type' => 'text',
			),
			array(
				'name' => __( 'Regular price EUR', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'regular_price_eur',
				'type' => 'text',
			),
			array(
				'name' => __( 'Sale price EUR', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'sale_price_eur',
				'type' => 'text',
			),
			array(
				'name' => __( 'Regular price GBP', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'regular_price_gbp',
				'type' => 'text',
			),
			array(
				'name' => __( 'Sale price GBP', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'sale_price_gbp',
				'type' => 'text',
			),
			array(
				'name' => __( 'Regular price JPY', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'regular_price_jpy',
				'type' => 'text',
			),
			array(
				'name' => __( 'Sale price JPY', 'cmb' ),
				/*'desc' => __( 'Here is the custom description about the title.', 'cmb' ),*/
				'id'   => $prefix . 'sale_price_jpy',
				'type' => 'text',
			),
		)
	);

	$meta_boxes['product_information_metabox'] = array(
		'id'         => 'information_metabox',
		'title'      => __( 'Product information', 'cmb' ),
		'pages'      => array( 'hd_product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Sold via name', 'cmb' ),
				'id'   => $prefix . 'product_sold_name',
				'type' => 'text',
			),
			array(
				'name' => __( 'Sold via link', 'cmb' ),
				'desc' => __( 'Sales addresses.', 'cmb' ),
				'id'   => $prefix . 'product_sold_link',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Dimension', 'cmb' ),
				'id'   => $prefix . 'product_dimension',
				'type' => 'text',
			),
			array(
				'name' => __( 'Color', 'cmb' ),
				'id'   => $prefix . 'product_color',
				'type' => 'text',
			),
			array(
				'name' => __( 'Material', 'cmb' ),
				'id'   => $prefix . 'product_material',
				'type' => 'text',
			),
			array(
				'name' => __( 'Shipping', 'cmb' ),
				'id'   => $prefix . 'product_shipping',
				'type' => 'text',
			),
			array(
				'name'    => __( "Editors's Rating", 'cmb' ),
				'id'      => $prefix . 'product_editors_rating',
				'type'    => 'radio',
				'options' => array(
					'1' => __( '1 star', 'cmb' ),
					'2' => __( '2 star', 'cmb' ),
					'3' => __( '3 star', 'cmb' ),
					'4' => __( '4 star', 'cmb' ),
					'5' => __( '5 star', 'cmb' ),
				),
			),
		)
	);

	$meta_boxes['product_slider_metabox'] = array(
		'id'         => 'slider_metabox',
		'title'      => __( 'Product slider', 'cmb' ),
		'pages'      => array( 'hd_product', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'id'   => $prefix . 'product_slider',
				'type' => 'group',
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'cmb' ),
					'remove_button' => __( 'Remove Entry', 'cmb' ),
					'sortable'      => true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'File',
						'id'   => 'file',
						'type' => 'file',
					),
				),
			),
		)
	);


	
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
