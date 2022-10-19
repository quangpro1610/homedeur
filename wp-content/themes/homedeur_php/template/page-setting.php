<?php /* Template Name: Setting Template */ ?>
<?php	
	if( !is_user_logged_in() ){
		wp_redirect( home_url() );
	}
wp_head();
?>
<?php get_header(); ?>
<?php
	$options = get_option('theme_option');
	$bg_cover = $options['_cmb_bg_cover_group'];
?>

<section class="main_content">
	<section class="user_dashboard <?=$class_section;?>">
			<div class="container">	
				<div class="user_settings">		
					<ul class="nav_dashboard">
						<li class="active"><a href="#edit_profile">Edit Profile</a></li>
						<li><a href="#password">Password</a></li>
						<li><a href="#my_feed">My Feed</a></li>
						<li><a href="#delete_account">Delete Account</a></li>
					</ul>
					<div class="tab_contents">
						<div id="edit_profile" class="tab active">
							<form class="content_form">
								<div class="row">
									<div class="col_2 user_meta">
										<p class="head_form">User Information</p>
		
									<?php
										$user_id    = get_current_user_id(); 
									  
										$user_data  = get_userdata($user_id);
										$user_meta  = get_user_meta($user_id);
										
		
										$first_name = $user_meta['first_name'];
										if(!empty($first_name)){
											$first_name = reset($first_name);
										}
		
										$email      = $user_data->user_email;
										if(!empty($email)){
											$email = $email;
										}
		
										$location   = $user_meta['location'];
										if(!empty($location)){
											$location = reset($location);
										}
		
										$facebook   = $user_meta['facebook'];
										if(!empty($facebook)){
											$facebook = reset($facebook);
										}
		
										$twitter    = $user_meta['twitter'];
										if(!empty($twitter)){
											$twitter = reset($twitter);
										}
		
										$about      = $user_meta['description'];
										if(!empty($about)){
											$about = reset($about);
										}
		
										$privacy    = $user_meta['u_privacy'];
										if(!empty($privacy)){
											$privacy = reset($privacy);
										}
							
										$background = $user_meta['u_bg'];
										if(!empty($background)){
											$background = reset($background);
										}
						
										$currency   = $user_meta['u_currency'];
										if(!empty($currency)){
											$currency = reset($currency);
										}
										
		
									?>
									<div class="profile_image">
									<?php echo get_avatar( $user_id, 66); ?>
									
									<a href="https://gravatar.com/emails/" class="button"><i class="ion-image">&nbsp;</i>Edit Photo</a>
		
									<input type="hidden" id="userid" value="<?php echo $current_user->ID ;?>"/>
									<input type="hidden" id="_nonce" value="<?php  echo wp_create_nonce('delete_user_avatar') ;?>"/>
									</div>
									<input type="text" name="u_name" placeholder="Name" value="<?php echo $first_name; ?>"/>
									<input type="text" name="u_email" placeholder="Email" value="<?php echo $email; ?>"/>
									<input type="text" name="u_location" placeholder="Location" value="<?php echo $location; ?>"/>
									<input type="text" name="u_face_url" placeholder="Facebook URL" value="<?php echo $facebook; ?>"/>
									<input type="text" name="u_twitter_url" placeholder="Twitter URL" value="<?php echo $twitter; ?>"/>
									</div>
									<div class="col_2">
										<p class="head_form_textarea">About Yourself <span>(125 Characters)</span></p>
										<textarea name="u_about" id="u_about" maxlength="125"><?php echo $about; ?></textarea><br />
								        
										<p class="head_form">Wishlist Option</p>
										<div class="radio_option">
											<span>Privacy</span>
											<div>
												<label for="radio_pri">PRIVATE</label><input type="radio" name="u_privacy" value="private" id="radio_pri" class="hidden" 
												<?php if( $privacy  == 'private') echo 'checked="checked"';?>/><label for="radio_pri" class="radio_button"></label>
												<label for="radio_public">PUBLIC</label><input type="radio" name="u_privacy" value="public" id="radio_public" class="hidden" 
												<?php if($privacy  == 'public') echo 'checked="checked"';?>/><label for="radio_public" class="radio_button"></label>
											</div>
										</div>
										<div class="radio_option">
											<span>Background</span>
											<div>
												<?php
													if(!empty($bg_cover)){
													foreach($bg_cover as $bg){
												?>
													<label for="bg_<?php echo $bg['cover_image_id']; ?>"><?php echo wp_get_attachment_image( $bg['cover_image_id'], 'thumbnail'); ?></label><input type="radio" name="u_bg" value="<?php echo $bg['cover_image_id']; ?>" id="bg_<?php echo $bg['cover_image_id']; ?>" class="hidden"  <?php if($background == $bg['cover_image_id']) echo 'checked="checked"';?>/><label for="bg_<?php echo $bg['cover_image_id']; ?>" class="radio_button"></label>
												<?php }
													} ?>
												<!--<label for="bg_1"><img src="<?php echo get_template_directory_uri(); ?>/images/bg_1.jpg" /></label><input type="radio" name="u_bg" value="bg_1" id="bg_1" class="hidden"  <?php if($background == 'bg_1') echo 'checked="checked"';?>/><label for="bg_1" class="radio_button"></label>
												<label for="bg_2"><img src="<?php echo get_template_directory_uri(); ?>/images/bg_2.jpg" /></label><input type="radio" name="u_bg" value="bg_2" id="bg_2" class="hidden" <?php if($background  == 'bg_2') echo 'checked="checked"';?>/><label for="bg_2" class="radio_button"></label>
												<label for="bg_3"><img src="<?php echo get_template_directory_uri(); ?>/images/bg_3.jpg" /></label><input type="radio" name="u_bg" value="bg_3" id="bg_3" class="hidden" <?php if($background  == 'bg_3') echo 'checked="checked"';?>/><label for="bg_3" class="radio_button"></label>
												<label for="bg_4"><img src="<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg" /></label><input type="radio" name="u_bg" value="bg_4" id="bg_4" class="hidden" <?php if($background == 'bg_4') echo 'checked="checked"';?>/><label for="bg_4" class="radio_button"></label>-->
											</div>
										</div>
										<div class="radio_option">
										<span>Currency</span>
										<div>
										<label for="radio_usd">USD</label><input type="radio" name="u_currency" value="usd" id="radio_usd" class="hidden" <?php if($currency  == 'usd') echo 'checked="checked"';?>/><label for="radio_usd" class="radio_button"></label>
										<label for="radio_eur">EUR</label><input type="radio" name="u_currency" value="eur" id="radio_eur" class="hidden" <?php if($currency  == 'eur') echo 'checked="checked"';?>/><label for="radio_eur" class="radio_button"></label>
										<label for="radio_gbp">GBP</label><input type="radio" name="u_currency" value="gbp" id="radio_gbp" class="hidden" <?php if($currency  == 'gbp') echo 'checked="checked"';?>/><label for="radio_gbp" class="radio_button"></label>
										<label for="radio_jpy">JPY</label><input type="radio" name="u_currency" value="jpy" id="radio_jpy" class="hidden" <?php if($currency  == 'jpy') echo 'checked="checked"';?>/><label for="radio_jpy" class="radio_button"></label>
										</div>
										</div>
									</div>
								</div>
								<div class="t_center">
									<input type="hidden" name="action" value="hd_ajax_user_edit_profile" />
									<button type="submit" name="submit" value="submit" class="button btn_green">Save Changes</button>
								</div>
								<div class="message"></div>
							</form>
						</div>
						<div id="password" class="tab">
							<form id ="change_password" action="" method="" class="content_form">	
								<p class="head_form">Change Password</p>
								<div class="row">
									<div class="col_2 user_meta">
										<input id="u_old_pw" type="password" name="u_old_pw" placeholder="Old Password" />
									</div>
									<div class="col_2">
										<input id="u_new_pw" type="password" name="u_new_pw" placeholder="New Password" />
									</div>
								</div>
								<div class="t_center">
									<input type="hidden" name="action" value="hd_ajax_user_update_pw" />
									<button type="submit" id="submit" name="submit" class="button btn_green">Save Changes</button>
								</div>
								<div class="message"></div>
							</form>
						</div>
						<div id="my_feed" class="tab">
							<?php hd_get_template_form_feeds();?>
						</div>
						<div id="delete_account" class="tab">
							<form id ="delete_account" action="" method="" class="content_form t_center">
								<p>We're sadden that you're leaving our community.</br>Are you really sure?</p>
								<div class="t_center">
									<input type="hidden" name="action" value="hd_ajax_user_delete_account" />
									<button type="submit" class="button btn_green">Yes, Delete my Account</button>
									<a href="#" class="button btn_gray">No, I want to Stay</a>
								</div>
								<div class="message"></div>
							</form>
						</div>
					</div>
				</div><!-- .user_settings -->
			</div><!-- .container -->
		</section>
</section>		

<?php get_footer('nocontent'); ?>