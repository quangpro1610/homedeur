<?php
	$post_url       = get_permalink($p_id);
	$post_title     = get_the_title($p_id);
	$options = get_option('theme_option');
	$facebook_url   = $options['_cmb_social_facebook'];
	$twitter_url    = $options['_cmb_social_twitter'];
	$pinterest_url  = $options['_cmb_social_pinterest'];
	$googleplus_url = $options['_cmb_social_googleplus'];
	$tumblr_url     = $options['_cmb_social_tumblr'];
	$instagram_url  = $options['_cmb_social_instagram'];
	$rss_url        = $options['_cmb_social_rss'];
?>
<div class="box_sidebar box_sidebar_socials">
	<ul class="social_share_tabs">
			<li class="active" rel="tab_1">Share to Friends</li>
			<li rel="tab_2">Follow Homedeur</li>	
	</ul>
	
	<div class="tab_content" id="tab_1">
		<ul class="box_share">
			<li><a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?p[url]=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="facebook" target="popup"><i class="ion-social-facebook"></i></a></li>
			<li><a href="#" onclick="window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?php echo $post_title; ?>&url=<?php echo $post_url; ?>&via=homedeur','name','width=600,height=400'); return false;" class="twitter" target="popup"><i class="ion-social-twitter"></i></a></li>
			<li><a href="#" onclick="window.open('http://bufferapp.com/add?text=<?php echo get_the_title ($p_id); ?>&url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="buffer" target="popup"><i class="ion-social-buffer"></i></a></li>
			<li><a href="#" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="pinterest" target="popup"><i class="ion-social-pinterest"></i></a></li>
			<li><a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="googleplus" target="popup"><i class="ion-social-googleplus"></i></a></li>
			<li><a href="#" onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="tumblr" target="popup"><i class="ion-social-tumblr"></i></a></li>
			<li class="load_more_share"><a href="#more" class="ion-ios-more"></a></li>
			<div class="more_share">
					<li><a href="#" onclick="window.open('http://reddit.com/submit?url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="reddit" target="popup"><i class="ion-social-reddit"></i></a></li>
					<li><a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?url=<?php echo $post_url; ?>','name','width=600,height=400'); return false;" class="linkedin" target="popup"><i class="ion-social-linkedin"></i></a></li>
					<li><a href="#" class="email" data-id="<?=$p_id;?>"><i class="ion-email"></i></a></li>
			<div>
		</ul>
	</div>
	<div class="tab_content tab_follow" id="tab_2">
		<ul>
			<li><a href="<?php echo $facebook_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-facebook"></i></a></li>
			<li><a href="<?php echo $twitter_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-twitter"></i></a></li>
			<li><a href="<?php echo $pinterest_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-pinterest"></i></a></li>
			<li><a href="<?php echo $googleplus_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-googleplus"></i></a></li>
			<li><a href="<?php echo $tumblr_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-tumblr"></i></a></li>
			<li><a href="<?php echo $instagram_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-instagram"></i></a></li>
			<li><a href="<?php echo $rss_url ;?>" rel="nofollow" target="_blank"><i class="ion-social-rss"></i></a></li>
		</ul>
	</div>
</div><!-- .box_sidebar  -->