<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>
<body>
	<div id="slide_bar" class="main_menu">
		<!-- <form id="search" >
			<input type="text" name="s" autocomplete="off" placeholder="SEARCH ex. kitchen" />
			<button name="submit"><i class="ion-android-search"></i></button>
		</form> -->
		<?php get_search_form(); ?>
		<div id="menu">
			<?php get_template_part('template/common/categories', 'menu'); ?>
			<?php get_template_part('template/common/main', 'menu'); ?>
		</div>
	</div>
	
	<?php get_template_part('template/common/subscribe'); ?>
	
	<?php
		$options = get_option('theme_option');
		$header_sticky = $options['_cmb_header_sticky'];
		$class_sticky = '';
		if($header_sticky == 'enable'){
			$class_sticky = 'sticky';
		}
	?>
	<div class="main <?=$class_sticky;?>">
		<div class="main_overlay">
			
		</div>
		<header>
			<div class="container">
				<a href="#" class="fl toogle_menu">
					<!--i class="fa fa-bars"></i-->
					<div id="menu-toggle">
					  	<div id="hamburger">
					    	<span></span>
						    <span></span>
						    <span></span>
					  	</div>
					  	<div id="cross">
						    <span></span>
						    <span></span>
					  	</div>
					</div>Menu
				</a>
				<div class="fr nav-user">
					<?php
						if( is_user_logged_in()){
							get_template_part('template/common/user-rollout', 'menu');
						}else{ ?>
							<a href="#login" class="button btn_green link_popup">Sign In</a>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</header>
		<?php
		if( !is_user_logged_in() ){
			get_template_part('template/common/login', 'form');
		}
		?>