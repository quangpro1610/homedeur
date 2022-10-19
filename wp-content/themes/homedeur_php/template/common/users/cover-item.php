			<div class="item cover">
				<div class="main_item">
					<img src="<?php echo get_template_directory_uri();?>/images/cover.jpg" alt="cover" />
					<div class="bottom_cover">
						<div>
							<h5><?php echo $u_name; ?>'s Wishlist</h5>
							<p><i class="ion-ios-location-outline"></i> <?php echo $u_location; ?></p>
						</div>
						<div class="user_info">
							<img src="<?php echo get_template_directory_uri();?>/images/avt.jpg" alt="avata" />
							<div class="social">
								<a href="<?php echo $u_facebook; ?>"><i class="ion-social-facebook"></i></a>
								<a href="<?php echo $u_twitter; ?>"><i class="ion-social-twitter"></i></a>
							</div>
						</div>
						<div class="user_control">
							<a href="<?php echo hd_get_page_by_slug('settings');?>"><i class="ion-android-settings"></i></a>
							<a href="#"><i class="ion-forward"></i></a>
						</div>
					</div>
				</div>
				<div class="details_item">
					<p><?php echo $u_description; ?></p>
				</div>
			</div><!-- .cover -->