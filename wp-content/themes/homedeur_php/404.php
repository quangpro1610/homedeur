<?php get_header(); ?>
	<section class="page_404">
		<div class="container">

			<div class="t_center main_404">
				<img src="<?php echo get_template_directory_uri();?>/images/404.png" alt="404 images">
				<h1>404 Page Not Found</h1>
				<p>You might want to check these categories instead</p>
			</div>

			<div class="items">
			<?php
			$args = array(
						'hide_empty'	=>	false,
						'exclude'		=>	24
				);
			$terms = get_terms( 'hd_product_cat', $args);
			shuffle($terms);
			$terms = array_slice($terms,0,4);
			
			if( $terms ){ ?>
					<?php
					foreach ($terms as $term) {
						$term_id = $term->term_id;
							hd_get_template_category_item( $term_id, 'hd_product_cat', 'small' );
					}?>
			<?php } ?>
				
			</div><!-- .items -->
			<div class="t_center main_404">
				<a href="<?php echo home_url(); ?>" class="button"><i class="ion-arrow-left-c"></i>Back to Homeduer</a>
			</div>
		</div><!-- .container -->
	</section>
<?php get_footer(); ?>