<?php
/* Template Name: Feeds Select Template */ 
?>
<?php
	if( !is_user_logged_in() ){
		wp_redirect( home_url() );
	}
	get_header();
?>

<section class="main_content">
	<section class="user_dashboard">
				<div class="container">
							
					<div class="user_settings">
						<div class="head">
							<h6>Choose your Interest</h6>
							<p>Select atleast 5 categories to proceed to your Feed</p>
						</div>
						<div id="my_feed">
							<?php hd_get_template_form_feeds(hd_get_page_by_slug('settings', true)); ?>
						</div><!-- .feeds -->
	
					</div><!-- .user_settings -->
	
				</div><!-- .container -->
	
			</section>
</section>

<?php get_footer();?>
