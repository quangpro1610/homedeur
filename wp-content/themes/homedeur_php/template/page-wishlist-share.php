<?php /*  Template Name: Wishlist share template */
$u_name = get_query_var('user_name');
if(empty($u_name)){
	wp_redirect(hd_get_page_by_slug('private-wishlist',true));
}else{
	$user_obj = get_userdatabylogin( $u_name );
	if(empty($user_obj)){
		wp_redirect(hd_get_page_by_slug('private-wishlist',true));
	}else{
		$u_id = $user_obj->ID;
		$user_meta = get_user_meta($u_id);
		$privacy   = $user_meta['u_privacy'];
		
		if(reset($privacy) !== 'public'){
			wp_redirect(hd_get_page_by_slug('private-wishlist',true));
		}else{
			$meta_wishlist = get_user_meta($u_id, 'user_wishlist', true);
			if(is_array($meta_wishlist) && count($meta_wishlist)){
				$args = array(
					'post_type' 	=> 'hd_product',
					'posts_per_page'=> -1,
					'post__in' => $meta_wishlist,
				);
				$query = new WP_Query($args);
			}
		}
	}
}

get_header();

?>
<section class="main_content">
	
	<section class="user_dashboard">
		<div class="container">
			<div class="items top_wishlist">
				
			</div><!-- .items.top_wishlist -->
			<div class="items wishlist">
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
			
		</div><!-- .container -->
	
	</section>
</section>
<?php get_footer(); ?>
