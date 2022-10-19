<?php get_header(); ?>
	<section class="t_center head_blog_page">
		<div class="container">
			<div class="head_title_blog">
				<a href="<?php echo home_url(); ?>" class="logo">
					<span>HOME</span><span>DEUR</span><span>TM</span>
				</a>
				<h1>The Blogs</h1>
			</div>
			<div class="menu_blog">
				<a href="#" class="menu_blog_mobile"><i class="ion-navicon-round"></i></a>
				<?php
					echo get_template_part('template/common/blog', 'menu');
				?>
			</div>
		</div>
	</section>
	<section class="blog_page">
		<div class="container">
			<div class="blog_items">
			<?php 
				if ( have_posts() ) : 
					
					while ( have_posts() ) : the_post();

						 get_template_part('template/blocks/contents/blog','item');
			
					endwhile; 

					wp_reset_postdata();

				endif;

			?>
				<div class="pagination">
					<?php next_posts_link( 'Newer' ); ?>
					<?php previous_posts_link( 'Older' ); ?>	
				</div> 
			</div><!-- .blog_items -->	
		</div><!-- .container -->
	</section>
<?php get_footer(); ?>	