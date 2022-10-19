<?php
	if ( has_nav_menu( 'main_menu' ) ) {

		$args = array(
				'theme_location' 	=> 	'main_menu',
				'menu_class'		=>	'',
				'container'			=>	'',
			);

	    wp_nav_menu( $args );
	}
?>