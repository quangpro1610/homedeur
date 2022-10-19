<?php
/*Template Name: Private Wishlist Template*/
?>
<?php get_header(); ?>

<section class="main_content">
	<section class=".private_wishlist">
		<div class="container">
			<div class="t_center main_private_wl">
				<img src="<?php echo get_template_directory_uri();?>/images/private_wishlist.png" alt="private wishlist">
				<h1>Private Wishlist</h1>
				<p>This page is Private and only the user can see it. 
				<?php 
				if(!is_user_logged_in()){?>
					Don't have an account? <a href="#login" class="link_popup"><b>Join Us Now</b></a> and start discovering cool products for your home.
				<?php } ?>
				</p>
			</div>
			<div class="t_center main_private_wl">
				<a href="<?php echo home_url() ?>" class="button"><i class="ion-arrow-left-c"></i>Back to Homeduer</a>
			</div>
		</div><!-- .container -->
	</section>
</section>
<?php get_footer('nocontent'); ?>