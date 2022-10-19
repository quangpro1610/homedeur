		<footer>
			<div class="container">
				<div class="head_footer">
					<a href="<?php echo home_url(); ?>" class="logo">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" />
					</a>
				</div>
				<div class="main_footer">
					<div class="fl">
						<?php if ( is_active_sidebar( 'footer_left' ) ) : ?>
								<?php dynamic_sidebar( 'footer_left' ); ?>
						<?php endif; ?>
					</div>
					<div class="fr widget_sections">
						<div class="widget">
							<?php if ( is_active_sidebar( 'footer_menu' ) ) : ?>
								<?php dynamic_sidebar( 'footer_menu' ); ?>
							<?php endif; ?>
						</div>
						<div class="widget">
							<?php if ( is_active_sidebar( 'footer_menu-2' ) ) : ?>
								<?php dynamic_sidebar( 'footer_menu-2' ); ?>
							<?php endif; ?>
						</div>
						<div class="widget">
							<?php if ( is_active_sidebar( 'footer_menu-3' ) ) : ?>
								<?php dynamic_sidebar( 'footer_menu-3' ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- footer -->
	</div>
	<div class="clearfix"></div>
</body>
<?php wp_footer(); ?>
</html>