<?php global $user_wishlist; ?>
<div class="item <?=$class;?> <?php if(isset($inc_class)) echo $inc_class; ?>">
	<div class="main_item">
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="overlay">
					<div><span></span><span></span><span></span></div>
				</div>
			</a>
			<a href="<?php the_permalink(); ?>" rel="nofollow"  title="<?php the_title(); ?>" class="hide_2_col">
				<?php
					if ( isset($thumb_size) ) { 
						the_post_thumbnail( $thumb_size ); // show featured image	
					} else {
						the_post_thumbnail( 'thumb-small');
					}
				?>
			</a>
			<a href="<?php the_permalink(); ?>" rel="nofollow" title="<?php the_title(); ?>" class="show_2_col">
				<?php
					the_post_thumbnail( 'thumb-middle');
				?>
			</a>
			<a href="<?php the_permalink(); ?>" class="button item_cat_link link_product"><?php echo get_the_title(); ?></a>
		</div>
		<div class="item_status">
			<?php if($p_recommended == 'true'){
				echo '<div>';
				echo '<span class="recommended"><i class="ion-thumbsup"></i></span>';
				echo '<span class="recommended status_hide"><i class="ion-thumbsup"></i><span>Recommended</span></span>';
				echo '</div>';
			}
			if($p_discount == 'true'){
				echo '<div>';
				echo '<span class="discount"><i class="ion-ios-pricetag"></i></span>';
				echo '<span class="discount status_hide"><i class="ion-ios-pricetag"></i><span>Discount</span></span>';
				echo '</div>';
			}
			if($p_crowdfunding == 'true'){
				echo '<div>';
				echo '<span class="crowdfunding"><i class="ion-ios-people"></i></span>';
				echo '<span class="crowdfunding status_hide"><i class="ion-ios-people"></i><span>Crowdfunding</span></span>';
				echo '</div>';
			}
			if($p_video == 'true'){
				echo '<div>';
				echo '<span class="video"><i class="ion-play"></i></span>';
				echo '</div>';
			}
			?>
		</div>
		<div class="item_control">
			<div class="fl">
			<?php if( is_user_logged_in() ){ ?>
				<a href="#" rel="nofollow" data-id="<?php echo $post_id; ?>" class="save_item <?php echo (in_array($post_id, $user_wishlist)) ? 'saved' : ''; ?>"><i class="ion-android-favorite"></i><span><?php echo (in_array($post_id, $user_wishlist)) ? 'Saved' : 'Save'; ?></span></a>	
			<?php }else{ ?>
				<a href="#login" rel="nofollow" data-id="<?php echo $post_id; ?>" class="save_item link_popup"><i class="ion-android-favorite"></i><span>Save</span></a>
			<?php } ?>
				
			</div>
			<div class="fr">
				<a href="#" class="share_item"><i class="ion-forward"></i><span>Share</span></a>
				<div class="box_share" style="display: none;">
					<ul>
						<li>
							<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?p[url]=<?php the_permalink(); ?>','name','width=600,height=400'); return false;" class="facebook" target="popup"><i class="ion-social-facebook"></i></a>
						</li>
						<li>
							<a href="#" onclick="window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?=get_the_title();?>&url=<?php the_permalink(); ?>&via=homedeur','name','width=600,height=400'); return false;" class="twitter" target="popup"><i class="ion-social-twitter"></i></a>
						</li>
						<li>
							<a href="#" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>','name','width=600,height=400'); return false;" class="pinterest" target="popup"><i class="ion-social-pinterest"></i></a>
						</li>
						<li>
							<a href="#" class="email" data-id="<?=$post_id;?>"><i class="ion-ios-email"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="details_item">
		<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
		<div class="price">
			<?php if(empty($sale))
			{
				echo '<span>'.$price.'</span>';
			} 
			else{
				echo '<span class="old_price">'.$price.'</span>' .'- <span>'.$sale.'</span>';
			}?>
		</div>
	</div>
</div><!-- .item -->