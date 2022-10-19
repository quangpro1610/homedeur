					<a href="#" class="profile_image">
						<?php
							$user_id = get_current_user_id();
							echo get_avatar( $user_id, 30);
						?>
						<i class="ion-chevron-down"></i>
					</a>
					<?php
						if ( has_nav_menu( 'user_rollout_menu' ) ) {

							$args = array(
									'theme_location' 	=> 	'user_rollout_menu',
									'menu_class'		=>	'',
									'container'			=>	'',
								);

						    wp_nav_menu( $args );
						}
					?>