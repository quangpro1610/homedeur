<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_theme_option_metaboxes' );
 
function cmb_theme_option_metaboxes( array $meta_boxes ) {

	$prefix = '_cmb_';

	$meta_boxes['theme_option'] = array(
		'id'        => 'theme_option',
		'title'     => __( 'Theme options', 'cmb' ),
		'show_on'	=> array( 'key' => 'options-page', 'value' => array( 'theme_options.php', ), ),
		'fields'    => array(
			array(
				'id'          	=> $prefix . 'header_sticky',
				'name'			=>	__( 'Header sticky', 'cmb' ),
				'description' 	=> __( 'Header sticky', 'cmb' ),
				'type'        	=> 'radio_inline',
				'options' 		=> array(
						'disable' => __( 'Disable (Default)', 'cmb' ),
						'enable'   => __( 'Enable', 'cmb' ),
				),
			),
			/*array(
				'id'			=> $prefix . 'slider_text',
				'name'			=>	__( 'Slider text', 'cmb' ),
				'type'        	=> 'textarea_small',
			),*/
			array(
				'id'			=>	$prefix . 'images_group',
				'name'			=>	__( 'Slider images', 'cmb' ),
				'type'			=>	'group',
				'options'		=>	array(
					'group_title'	=>	__( 'Slider {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    =>	__( 'Add Another Slider', 'cmb' ),
					'remove_button'	=>	__( 'Remove slider', 'cmb' ),
					'sortable'      =>	true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'Image',
						'id'   => 'slider_image',
						'type' => 'file',
					),
					array(
						'id'			=> 'slider_text',
						'name'			=>	__( 'Text', 'cmb' ),
						'type'        	=> 'textarea_small',
					),
					array(
						'id'			=> 'slider_url',
						'name'			=>	__( 'Url', 'cmb' ),
						'type'        	=> 'text',
					),
					/*array(
						'id'			=> 'option_hide_url',
						'name'			=>	__( 'Hide url with user logged in', 'cmb' ),
						'type'        	=> 'radio_inline',
						'options' 		=> array(
								'show'   => __( 'Show (Default)', 'cmb' ),
								'hide'  => __( 'Hide', 'cmb' ),
						),
						'default'		=>	'show',
					),*/

				),

			),
			array(
				'id'          	=> $prefix . 'featured_items_home',
				'name'			=>	__( 'Featured Home Item', 'cmb' ),
				'description' 	=> __( 'Show or hide Featured Home Item', 'cmb' ),
				'type'        	=> 'radio_inline',
				'options' 		=> array(
						'enable'   => __( 'Enable (Default)', 'cmb' ),
						'disable'  => __( 'Disable', 'cmb' ),
				),
			),
			
			array(
				'id'			=>	$prefix . 'bg_cover_group',
				'name'			=>	__( 'Backround cover images', 'cmb' ),
				'type'			=>	'group',
				'options'		=>	array(
					'group_title'	=>	__( 'Cover {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    =>	__( 'Add Another cover', 'cmb' ),
					'remove_button'	=>	__( 'Remove cover', 'cmb' ),
					'sortable'      =>	true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'Image',
						'id'   => 'cover_image',
						'type' => 'file',
					),
				),

			),

			array(
				'id'			=> $prefix . 'number_today_most_view',
				'name'			=>	__( 'Number today most view at single product', 'cmb' ),
				'type'        	=> 'text',
			),

			array(
				'id'			=> $prefix . 'social_facebook',
				'name'			=>	__( 'Facebook Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_twitter',
				'name'			=>	__( 'Twitter Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_pinterest',
				'name'			=>	__( 'Pinterest Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_googleplus',
				'name'			=>	__( 'Google Plus Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_tumblr',
				'name'			=>	__( 'Tumblr Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_instagram',
				'name'			=>	__( 'Instagram Link', 'cmb' ),
				'type'        	=> 'text',
			),
			array(
				'id'			=> $prefix . 'social_rss',
				'name'			=>	__( 'RSS Link', 'cmb' ),
				'type'        	=> 'text',
			),
		),
	);

	/*$meta_boxes['home_slider'] = array(
		'id'        => 'home_slider',
		'title'     => __( 'Home slider', 'cmb' ),
		'show_on'	=> array( 'key' => 'options-page', 'value' => array( 'theme_options.php', ), ),
		'fields'    => array(
			array(
				'id'			=> $prefix . 'slider_text',
				'name'			=>	__( 'Slider text', 'cmb' ),
				'type'        	=> 'textarea_small',
			),
			array(
				'id'			=>	$prefix . 'images_group',
				'name'			=>	__( 'Slider images', 'cmb' ),
				'type'			=>	'group',
				'options'		=>	array(
					'group_title'	=>	__( 'Image {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    =>	__( 'Add Another Image', 'cmb' ),
					'remove_button'	=>	__( 'Remove Image', 'cmb' ),
					'sortable'      =>	true, // beta
				),
				'fields'      => array(
					array(
						'name' => 'Image',
						'id'   => 'image',
						'type' => 'file',
					),
				),
			),
		),
	);*/
	

	return $meta_boxes;
}
