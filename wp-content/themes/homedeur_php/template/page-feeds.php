<?php /*  Template Name: My Feeds template */ ?>
<?php
if(!is_user_logged_in()){
	wp_redirect(home_url());
}else{
	$u_id = get_current_user_id();
	$meta_feed = get_user_meta($u_id, 'user_feeds', true);
	if(is_array($meta_feed) && count($meta_feed)){
		$args = array(
			'post_type' 		=> 'hd_product',
			'posts_per_page'	=> 8,
			'tax_query' 		=> array(
								array(
									'taxonomy' => 'hd_product_cat',
									'field'    => 'term_id',
									'terms'    => $meta_feed,
								),
							),
		);
		$query = new WP_Query($args);
	}
}
get_header();
?>

<section class="main_content">
	<section class="user_dashboard">
				<div class="container">
	
					<div class="head head_feed">
						<div class="head_feed_content">
							<img src="<?php echo get_template_directory_uri();?>/images/head-feed.png" alt="" />
							<div>
								<h4>Welcome to your Feed</h4>
								<p>All products posted here are based on your categories of interest. To change or add more category, go to your <a href="http://homedeur.com/settings/">Settings Page</a></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<a href="#" class="toggle_head_feed"><i class="ion-android-arrow-dropup-circle"></i><i class="ion-android-arrow-dropdown-circle hidden"></i></a>
					</div>
					
					<div class="items items_load_more">
						<?php
						if(isset($query) ){
							if( $query->have_posts()):
								while( $query->have_posts() ) : 
										$query->the_post();
							
										hd_get_template_product('template/blocks/contents/product-item-share.php');
								endwhile;
							endif;
						}?>			
					</div><!-- .items -->
					<?php if($query->found_posts > 8){ ?>
						<div class="t_center pagination"><a href="#" class="button load_more" data-type="product" data-firstoffset="0" data-paged="2">Load More</a></div>
					<?php } ?>
				</div><!-- .container -->
	
			</section>
</section>
<?php get_footer();?>