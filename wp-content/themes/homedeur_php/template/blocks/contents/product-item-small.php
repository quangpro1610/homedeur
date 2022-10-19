<div class="item item_small">
	<div class="main_item">
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>" rel="nofollow" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('thumb-small'); ?>
			</a>
		</div>
	</div>
	<div class="details_item">
		<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
		<div class="price">
			<?php
			if(empty($sale))
			{
				echo '<span class="price">'.$price.'</span>';
			} 
			else{
				echo '<span class="price">'.$sale.'</span>';
			}?>
		</div>
	</div>
</div><!-- .item.item_small -->