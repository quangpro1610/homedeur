<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
 
 
 
// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
 
 
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	
	
	
	
	
	
	
	
	
	
	
	
	$meta_boxes['services_metabox'] = array(
		'id'         => 'services_metabox',
		'title'      => __( 'Services Additional Data', 'cmb' ),
		'pages'      => array( 'projects', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			
			
			
		
			array(
				'name'    => __( 'Secondary Content Area', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'secondary_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
			),
			
			
			array(
				'name' => __( 'PDF Details ', 'cmb' ),
				'desc' => __( 'Upload details of this centre.', 'cmb' ),
				'id'   => $prefix . 'pdfdetails_file',
				'type' => 'file',
			),
			
			array(
				'name' => __( 'Address', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'addressfield',
				'type' => 'textarea_small',
			),
			
			array(
				'name' => __( 'Other Contact Details', 'cmb' ),
				'desc' => __( 'Other contact details , Phone Fax etc. (optional)', 'cmb' ),
				'id'   => $prefix . 'otheraddressfield',
				'type' => 'textarea_small',
			),
			
			
			
						array(
				'name'         => __( 'Gallery Images', 'cmb' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb' ),
				'id'           => $prefix . 'image_file_list',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			
			
			array(
				'name' => __( 'Testimonial Area', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'testimonial_textarea',
				'type' => 'textarea_small',
				'repeatable' => true,
			),
			
			




		
			
			array(
				'id'          => $prefix . 'rating_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Rating {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Rating', 'cmb' ),
					'remove_button' => __( 'Remove Rating', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Rating Title',
						'id'   => 'ratetitle',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					
					
					
					array(
				'name'    => __( 'Rating Select', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'rating_select',
				'type'    => 'select',
				'options' => array(
					'1' => __( '1', 'cmb' ),
					'2'   => __( '2', 'cmb' ),
					'3'     => __( '3', 'cmb' ),
					'4'     => __( '4', 'cmb' ),
					'5'     => __( '5', 'cmb' ),
				),
			),
			
			
			
			


			
			
				),
			),
			
			
		),
	);

	
	
	
	
	$meta_boxes['links_metabox'] = array(
		'id'         => 'links_metabox',
		'title'      => __( 'Services Additional Data', 'cmb' ),
		'pages'      => array( 'ble_links', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			
			
			
array(
				'name' => __( 'Phone', 'cmb' ),
				'desc' => __( 'Add phone', 'cmb' ),
				'id'   => $prefix . 'phone_textmedium',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			
			
			array(
				'name' => __( 'Website URL', 'cmb' ),
				'desc' => __( 'Add web Url', 'cmb' ),
				'id'   => $prefix . 'weburl',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			
			
		),
	);

	
	
	
	
	
	
	
	
	
	
	
		$meta_boxes['header_metabox'] = array(
		'id'         => 'header_metabox',
		'title'      => __( 'Header Image Slider Data', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			
				
			array(
				'id'          => $prefix . 'headerslider_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Header Slider {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Slider', 'cmb' ),
					'remove_button' => __( 'Remove Slider', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(

					array(
						'name' => 'Description',
						'description' => 'Write a short description for this entry eg "&lt;div class=&quot;item&quot;&gt;<br>
&lt;h4&gt; “Volunteering with Blenheim &lt;/h4&gt;<br>
&lt;h4&gt;  was one of the best &lt;/h4&gt;<br>
&lt;h4&gt;  experiences of my life...”&lt;/h4&gt;<br>
&lt;div class=&quot;clearfix&quot;&gt;&lt;/div&gt;<br>
&lt;h5&gt;&lt;a href=&quot;#&quot;&gt;Read more about our training&lt;/a&gt;&lt;/h5&gt;<br>
&lt;/div&gt;"',
						'id'   => 'slider_description',
						'type' => 'textarea_small',
					),
					
					array(
					'name' => __('Slider', 'html5reset'),
					'description' => __('Slider Image', 'html5reset'),
					'id' => 'slider_uploader',
					'type' => 'file_list'
					),				

			
			
				),
			),
			
			
		),
	);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	// Add other metaboxes as needed

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
