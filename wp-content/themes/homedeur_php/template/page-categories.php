<?php
	/**
	Template name: All categories Template
	**/
?>
<?php get_header(); ?>

		<section class="main_content">
			<section>
				<div class="container">
					<div class="heading t_center">
						<span class="title">Featured Categories</span>
						<div class="clearfix"></div>
					</div>
					
					<?php get_template_part('template/blocks/featured','categories'); ?>
			
					<div class="heading t_center">
						<span class="title">All Categories</span>
						<div class="clearfix"></div>
					</div><!-- .heading -->
					<?php
						$args = array(
									'number'		=>	10,
									'exclude'		=>	24,
									'meta_query' => array(
							            array(
							                    'key' => 'term_pin_top',
							                    'value' => 'false',
							                ),
						        	),
									'hide_empty'	=>	false
								);
						$terms = get_terms( 'hd_product_cat', $args );
			
						if( $terms ){ ?>
							<div class="items categories_items items_load_more">
								<?php
								$i = 1;
								foreach ($terms as $term) {
									$term_id = $term->term_id;
									if( $i==1 || $i==2 ){
										hd_get_template_category_item( $term_id, 'hd_product_cat', 'middle' );
									}else{
										hd_get_template_category_item( $term_id, 'hd_product_cat', 'small' );
									}
									$i++;
								}?>
							</div><!-- .items.categories_items -->
						<?php } ?>
					<?php if( $i > 10 ){ ?>
						<div class="t_center pagination"><a href="#" class="button load_more" data-paged="2" data-type="category">Load More</a></div>
					<?php } ?>
			
				</div><!-- .container -->
			
			</section>
		</section>

<?php get_footer(); ?>