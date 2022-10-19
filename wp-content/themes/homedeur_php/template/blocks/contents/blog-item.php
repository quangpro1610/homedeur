<?php
	$cats = get_the_category();
	if(count($cats)){
		$cat = reset($cats);
	}
?>
<div class="blog_item">
	<p class="cat_blog_item"><?php echo $cat->name; ?></p>
	<a href="<?php the_permalink(); ?>" rel="nofollow" class="title_blog_item"><?php the_title(); ?></a>
	<p class="author_blog_item">By <?php echo get_the_author(); ?></p>
	<div class="wrap_content_blog_item">
		<div class="date_blog">
			<p class="day_month"><?php echo get_the_time('F j', $post->ID); ?></p>
			<p class="year"><?php echo get_the_time('Y', $post->ID); ?></p>
		</div><!-- .date_blog -->
		<div class="content_blog_item">
			<div class="main_blog_item">
				<div class="thumb_blog_item">
					<a href="<?php the_permalink(); ?>" rel="nofollow" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumb-blog'); ?></a>
				</div>
				<?php the_excerpt(); ?>
			</div>
			<div class="blog_share">
				<div class="heading_blog_share"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span></span><span></span><span></span></a></div>
				<ul>
					<li><a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?p[url]=<?php the_permalink(); ?>','name','width=600,height=400'); return false;"><i class="ion-social-facebook"></i></a></li>
					<li><a href="#" onclick="window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>&via=homedeur','name','width=600,height=400'); return false;"><i class="ion-social-twitter"></i></a></li>
					<li><a href="#" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>','name','width=600,height=400'); return false;"><i class="ion-social-pinterest"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!-- .blog_item -->