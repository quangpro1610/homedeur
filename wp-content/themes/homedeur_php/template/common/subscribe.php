<!-- .popup subscribe -->
<div id="subscribe" class="popup" >
	<a href="#" class="close_popup"><i class="ion-close-round"></i></a>
	<div class="main_popup">
		<div class="content_popup">
			<span>HOMEDEUR</span>
			<h1>FREE SUBSCRIPTION</h1>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<? echo get_template_directory_uri(); ?>/images/subscribe.png" alt="Logo">
			</a>
		<div class="form-subscribe">
			<?php if ( is_active_sidebar( 'subscribe' ) ) : ?>
				<?php dynamic_sidebar( 'subscribe' ); ?>
			<?php endif; ?>
		</div>	
		</div>
	</div>
</div> <!-- .end popup subscribe-->