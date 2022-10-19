<?php /*  Template Name: Wishlist template */
if(!is_user_logged_in()){
	wp_redirect(home_url());
}else{
	$u_id = get_current_user_id();
	$meta_wishlist = get_user_meta($u_id, 'user_wishlist', true);
	if(is_array($meta_wishlist) && count($meta_wishlist)){
		$args = array(
			'post_type' 	=> 'hd_product',
			'posts_per_page'=> 10,
			'post__in' => $meta_wishlist,
		);
		$query = new WP_Query($args);
	}
}
get_header()	;
?>
<section class="main_content">
	<section class="user_dashboard">
		<div class="container">
			<div class="items top_wishlist">
				
			</div><!-- .items.top_wishlist -->
			<div class="items wishlist items_load_more">
				<?php
					hd_get_template_cover($u_id);
				?>
				<?php 
				if(isset($query) ) : 
					if( $query->have_posts()):
							while( $query->have_posts() ) : 
									$query->the_post();
								hd_get_template_product('template/blocks/contents/wishlist-item.php');
					
							endwhile;
					endif;
					else: 
				?>
					<div class="item wishlist_empty">
					<div class="main_item">
						<p class="head">MY WISHLIST</p>
						<p>You haven’t saved anything yet. Time to hustle, Add a Wishlist</p>
						<div>
							<img src="<?php echo get_template_directory_uri();?>/images/bear-3.png" alt="">
							<a href="#">Save Wishlist</a>
						</div>
					</div>
					</div><!-- .item -->
					<?php endif; ?>
				
			</div><!-- .items -->
			<?php if(count($meta_wishlist) > 10){?>	
			<div class="t_center pagination"><a href="#" class="button load_more" data-paged="2" data-type="wishlist">Load More</a></div>
			<?php } ?>
		</div><!-- .container -->
	
	</section>
</section>
<?php get_footer(); ?>
