<?php get_header(); ?>

<section class="main_content">
	<section class="single_product ">
			<div class="container">
				<div class="wrap_product">
				<?php if ( have_posts() ) : 
					while ( have_posts() ) : 
						the_post(); 
						$main_post_id = get_the_ID();
						hd_get_template_product('template/blocks/contents/product-item-single.php');
					endwhile; 
				endif;
				?>	
					<div class="sidebar_product">
						<div class="box_sidebar box_sidebar_320 ">
							<div class="heading_sidebar">Today's Most Viewed<a href="<?php echo get_home_url(); ?>" class="fr">View All</a></div>
		
							<div class="items">
								<?php
								$options = get_option('theme_option');
								$number_post = $options['_cmb_number_today_most_view'];
		
								$args = array(
									'post_type' 	=> 'hd_product',
									'posts_per_page'=>	$number_post,
									'orderby'		=> 'date',
									'order'			=> 'ASC'
								);
								$mostview = new WP_Query( $args );
								?>					
								<?php 
								if($mostview->have_posts()):
									while( $mostview->have_posts() ) : 
										$mostview->the_post();
										hd_get_template_product('template/blocks/contents/product-item-small.php');
									endwhile;
								endif; 
								?>		
							</div><!-- .items -->
						</div><!-- .box_sidebar -->
						<?php  hd_get_template_product_infos($main_post_id);?>
						<?php hd_get_template_product_share($main_post_id); ?>
					</div>
				</div><!-- .wrap_product -->
				<div class="wrap_product">
					<div class="main_product">
						<div class="wrap_comment">
							<div class="toggle_comment">
								<a href="#"><i class="ion-chatbubbles"></i>Show Comments</a>
								<a href="#" class="hidden"><i class="ion-chatbubbles"></i>Hide Comments</a>
							</div>
							<div class="main_comment">
								<?php comments_template(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="related_items">
					<div class="heading">
						<span class="title">Related Items</span>
						<div class="clearfix"></div>
					</div>
					<div class="items home_items">
					<?php
						$cats = wp_get_post_terms( $main_post_id, 'hd_product_cat' );
						foreach ( $cats as $cat ) {
							$cats_array[] .= $cat->term_id;
						}
						$related_items = new WP_Query(
							array(
								'post_type' =>'hd_product',
								'tax_query'	=> array(
						            array(
					                    'taxonomy' => 'hd_product_cat',
					                    'field' => 'id',
					                    'terms' => $cats_array
						            )
						        ),
								'orderby'       => 'rand',
		
								'post__not_in'  => array($main_post_id),
							)
						);
						if ($related_items->have_posts()) : 
							while ($related_items->have_posts()) : 
								$related_items->the_post();
								hd_get_template_product('template/blocks/contents/product-item-share.php');
							endwhile; 
						else: 
							_e('No related product.');
						endif; 
					?>
					<?php hd_get_random_item_category('thumb-middle'); ?>
					</div>
			</div><!-- .container -->
		</section>	
</section>
<?php get_footer(); ?>