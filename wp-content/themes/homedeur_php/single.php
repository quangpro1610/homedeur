<?php get_header(); ?>
<?php 
	if ( have_posts() ) : 
		
		while ( have_posts() ) : the_post();
?>
			<section class="banner single_post">
				<div class="container">
					<?php the_post_thumbnail(); ?>
					<div class="content_banner">
						<div class="main_content_banner">
							<h1><?php the_title(); ?></h1>
							<p>Posted by <?php the_author(); ?></p>
						</div>
					</div>
				</div>
			</section>

			<section>
				<div class="container">
					<div class="blog_item single_post_content">
						<div class="blog_single_social">
							<div class="content_blog_item">
								<ul>
									<li><a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?p[url]=<?php the_permalink(); ?>','name','width=600,height=400'); return false;"><i class="ion-social-facebook"></i></a></li>
									<li><a href="#" onclick="window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>&via=homedeur','name','width=600,height=400'); return false;"><i class="ion-social-twitter"></i></a></li>
									<li><a href="#" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>','name','width=600,height=400'); return false;"><i class="ion-social-pinterest"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="wrap_content_blog_item">
							<div class="date_blog">
								<p class="day_month"><?php echo get_the_time('F j', $post->ID); ?></p>
								<p class="year"><?php echo get_the_time('Y', $post->ID); ?></p>
							</div><!-- .date_blog -->
							<div class="content_blog_item">
								<?php the_content(); ?>
								
								<div class="wrap_comment">
									<?php comments_template(); ?>
								</div>
							</div>
						</div>
					</div><!-- .blog_item -->

				</div><!-- .container -->

			</section>
<?php
		endwhile;
	endif;
?>
<?php get_footer(); ?>	