<?php /* Template Name: About */ ?>
<?php get_header(); ?>
<section class="main_content">
	<section class="banner">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/images/banner-about.jpg" alt="banner">
		</div>
	</section>
	<section class="about_page">
		<div class="container">
	
			<div class="t_center heading">
				<h2>What is Homeduer?</h2>
				<p>A powerful home product catalogue website to helping you explore, discover, collect and buy the best products for your home.</p>
			</div>
			
			<div class="t_center heading">
				<div class="line_heading"></div>
				<h2>Basic Features</h2>
				<p>Below are the basic features of the website and will be adding more in the future.</p>
			</div>
			
			<?php if ( is_active_sidebar( 'about_page' ) ) : ?>
					<?php dynamic_sidebar( 'about_page' ); ?>
			<?php endif; ?>
	
			<div class="t_center heading">
				<div class="line_heading"></div>
				<h2>The Team</h2>
				<p>We introduce you to our awesome family and still growing.</p>
			</div>
	
			<div class="items">
				<?php // WP_Query arguments
					$args = array (
						'post_type'		=>	array( 'hd_teams' ),
					);
				
					// The Query
					$query = new WP_Query( $args );
				
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
					?>		
						<div class="item">
							<div class="main_item">
								<?php the_post_thumbnail('thumb-small');?>
							</div>
							<div class="t_center details_item">
								<p><?php the_title();?></p>
								<?php the_content();?>
							</div>
						</div><!-- .item -->
				<?php
					}
					} else {
					// no posts found
				}
				wp_reset_postdata();?>
	
			</div><!-- .items -->
	
		</div><!-- .container -->
	
	</section>
</section>

<?php get_footer(); ?>		