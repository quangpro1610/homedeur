<?php
	/*$user_feeds = array();
	if( is_user_logged_in() ){
		$user_id = get_current_user_id();
		$user_feeds = get_user_meta( $user_id, 'user_feeds', true );
		if( !is_array($user_feeds) || !count($user_feeds)){
			$user_feeds = array();
		}
	}

	$args = array(
			'hide_empty'        => false
		);
	$terms = get_terms( 'hd_product_cat', $args );*/

?>
<form action="" method="" class="content_form">

	<p class="head_form">Choose Categories</p>
	<div class="feeds">
		<?php foreach ($terms as $term) {
			$term_id = $term->term_id;
			$active = '';
			$checked = '';
			if( in_array($term_id, $user_feeds) ){
				$active = 'active';
				$checked = 'checked';
			}

			$url_img = get_term_meta( $term_id, 'term_thumbnail');
			$img_id = hd_get_image_id( $url_img );
			$img_attrs = wp_get_attachment_image_src( $img_id, 'thumb-small' );
			if(!empty($img_attrs)){
				$img_src = $img_attrs[0];
			}else{
				$img_src = '';
			}
		?>
			<div class="feed <?php echo $active; ?>">
				<input type="checkbox" class="hidden" id="term[<?php echo $term_id; ?>]" name="feed_id[]" value="<?php echo $term_id; ?>" <?php echo $checked; ?> />
				<label for="term[<?php echo $term_id; ?>]">
					<span></span>
					<div class="overlay"></div>
					<img src="<?php echo $img_src; ?>" alt="<?php echo $term->name; ?>" />
					<div class="content_feed">
						<p><?php echo $term->name; ?></p>
					</div>
				</label>
			</div><!-- .feed -->
		<?php } ?>
	</div><!-- .feeds -->
	<div class="t_center">
		<input type="hidden" name="action" value="hd_ajax_save_user_feeds" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<button type="submit" class="button btn_green">Save Changes</button>
	</div>
	<div class="message"></div>
</form>