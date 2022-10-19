		
			<ul>
				<li><a href="<?php echo get_permalink(get_page_by_path('all-categories')); ?>">All categories</a></li>
			    <?php 
			    wp_list_categories( array(
			        'orderby' 		=> 'name',
			        'taxonomy'		=> 'hd_product_cat',
			        'hide_empty'	=>	false,
			        'title_li'		=> '',
			    ) ); ?> 
			</ul>