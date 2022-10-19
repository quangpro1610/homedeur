<?php $u_id       = $user_id;?>
<?php $user_meta  = get_user_meta($u_id);
	  $user_data  = get_userdata($u_id);
	  $privacy    = $user_meta['u_privacy'] ;
	  	$bg = $user_meta['u_bg'];
	  	$background = '';
	  if(is_array($bg)){
	  	$background = $bg[0];
	  }
	  if(!empty($background)){
		$bg_img = wp_get_attachment_image( $background, 'full');
	  }else{
		$bg_img = '<img src="'. get_template_directory_uri() .'/images/cover.jpg" alt="cover" />';
	  }
	  

?>
<div class="item cover">
<div class="main_item">
	<?=$bg_img;?>
	<div class="bottom_cover">
		<div>
			<h5><?php echo ($u_name != '') ? $u_name : 'User'; ?>'s Wishlist</h5>
			<p><i class="ion-ios-location-outline"></i> <?php echo ($u_location != '') ? $u_location : 'N/A'; ?></p>
		</div>
		<div class="user_info">
			<?php echo get_avatar($u_id,66)?>
			<div class="social">
				<a href="<?php echo ($u_facebook != '') ? $u_facebook : 'http://www.facebook.com/'; ?>"><i class="ion-social-facebook"></i></a>
				<a href="<?php echo ($u_twitter != '') ? $u_twitter : 'http://www.twitter.com/'; ?>"><i class="ion-social-twitter"></i></a>
			</div>
		</div>
		<div class="user_control">
			<a href="<?php hd_get_page_by_slug('settings', false);?>"><i class="ion-android-settings"></i></a>
			<?php
				$url_wishlist = 'http://homedeur.com/user/?user_name='.$user_data->user_login;
				$onclick = "window.open('https://www.facebook.com/sharer/sharer.php?p[url]=".$url_wishlist."','name','width=600,height=400'); return false;";
				$html = (reset($privacy) == 'public') ? '<a href="#" onclick="'.$onclick.'"><i class="ion-forward"></i></a>' : '';
				echo $html;
			?>
		</div>
	</div>
</div>
<div class="details_item">
	<p><?php echo $u_description?></p>
</div>
</div><!-- .cover -->