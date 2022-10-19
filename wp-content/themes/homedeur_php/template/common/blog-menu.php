<?php
	if ( has_nav_menu( 'blog_menu' ) ) {

		$args = array(
				'theme_location' 	=> 	'blog_menu',
				'menu_class'		=>	'',
				'container'			=>	'',
			);

	    wp_nav_menu( $args );

	}