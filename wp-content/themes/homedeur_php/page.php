<?php get_header(); ?>
<?php
	$banner_url = get_the_post_thumbnail_url();
	if( !$banner_url ){
		$banner_url = get_template_directory_uri() . '/images/banner-page.jpg';
	}
?>

		<section class="banner">
			<div class="container">
				<img src="<?php echo $banner_url; ?>" alt="banner">
			</div>
		</section>

		<section class="normal_page">
			<div class="container">
						
				<div class="content_normal_page">
					<?php
						// Start the loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							the_content();

						// End the loop.
						endwhile;
					?>
				</div>	

			</div><!-- .container -->

		</section>
		
<?php get_footer(); ?>