<?php 
/**
 * Theme Option Page Example
 */
function theme_option_menu()
{
  //add_menu_page( 'Theme Options', 'Theme Options', 5, 'theme_options.php', 'theme_page');
	add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'theme_options.php', 'theme_page');
}
add_action('admin_menu', 'theme_option_menu');

function theme_page()
{
	require_once(get_template_directory() . '/includes/CMB/metabox-theme-option.php');
	$meta_boxes = apply_filters( 'cmb_meta_boxes', array() );
?>
	<h1>Theme settings</h1>
	
    <div class="theme_options">
    	<div>
    		<?php
				cmb_metabox_form( $meta_boxes['theme_option'], 'theme_option' );
			?>
    	</div>
    	<!--<div class="tabs">
    		<ul class="tab_links">
    			<li><a href="#tab1" class="active">Theme options</a></li>
    			<li><a href="#tab2">Home slider</a></li>
    		</ul>
    		<div class="tab_contents">
				<div id="tab1" class="tab active">
				    
				</div>
				<div id="tab2" class="tab">
				    
				</div>
			</div>
		</div>-->
    </div>
<?php
}