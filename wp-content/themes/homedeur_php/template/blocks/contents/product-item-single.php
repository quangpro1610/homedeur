<?php global $user_wishlist;

$solvia 			= get_post_meta( $post_id, '_cmb_product_sold_name', true);
$link 				= get_post_meta( $post_id, '_cmb_product_sold_link', true);
$product_slider 	= get_post_meta( $post_id, '_cmb_product_slider', true);
/*echo '<pre>';
print_r($product_slider);
echo '</pre>';exit;*/
/*foreach($product_slider as $slider){
	$type = get_post_mime_type($slider['file_id']);
	if( $type == 'video/mp4' || $type == 'video/mpeg' || $type == 'video/quicktime' ){
		echo get_the_post_thumbnail($slider['file_id']);
	}	
}
exit;*/
 ?>
<div class="main_product">
	<div class="product_thumbnail">
		<div>
			<?php the_post_thumbnail('thumb-product-post'); ?>
		</div>
		
	</div>
	<div class="wrap_embed" style="display:none;">
		<?php if(is_array($product_slider) && count($product_slider)){
			foreach($product_slider as $key => $slider){
				if(!isset($slider['file_id']) || empty($slider['file_id'])){
					$embed_code = wp_oembed_get( $slider['file'] ,  array( 'width' => 770 ));
					echo '<div class="product_embed embed_'. $key .'">'. $embed_code .'</div>';
				}else{
					$type = get_post_mime_type($slider['file_id']);
					if( $type == 'video/mp4' || $type == 'video/mpeg' || $type == 'video/quicktime' ){
						$embed_code = do_shortcode('[video src="'. wp_get_attachment_url( $slider['file_id'] ) . '" width="770"]');
						echo '<div class="product_embed embed_'. $key .'">'. $embed_code .'</div>';
					}else{
						echo '<div class="product_embed embed_'. $key .'">'. wp_get_attachment_image( $slider['file_id'], 'thumb-product-post') .'</div>';
					}
				}
			}
		} ?>
	</div>
	<div class="product_slider">
		<?php if(is_array($product_slider) && count($product_slider)){
			echo '<div class="product_flexslider">';
				echo '<ul class="slides">';
				foreach($product_slider as $key => $slider){
					if(!isset($slider['file_id']) || empty($slider['file_id'])){
						$img = '<img src="'. get_template_directory_uri() . '/images/thumbnail-post-slider.jpg" alt="" />';
						echo '<li><a href="#" data-embed="embed_'. $key .'"><div class="overlay"><i class="ion-ios-play-outline"></i></div>' . $img . '</a></li>';
					}else{
						$type = get_post_mime_type($slider['file_id']);
						if( $type == 'video/mp4' || $type == 'video/mpeg' || $type == 'video/quicktime' ){
							echo '<li><a href="' . wp_get_attachment_url( $slider['file_id'] ) . '" data-embed="embed_'. $key .'"><div class="overlay"><i class="ion-ios-play-outline"></i></div>' . get_the_post_thumbnail($slider['file_id'], 'thumb-slider-small') . '</a></li>';
						}else{
							echo '<li><a href="' . wp_get_attachment_url( $slider['file_id'] ) . '" data-embed="embed_'. $key .'">' . wp_get_attachment_image( $slider['file_id'], 'thumb-slider-small') . '</a></li>';
						}
					}
				}
				echo '</ul>';
			echo '</div>';
		} ?>
	</div>
	<div class="product_title">
		<?php the_title(); ?>
		<?php 
		$html = '';
		if(!empty($sale)){
			$html ='<span class="price">' . $sale .' '. $currency .' </span>';
			$html_320 ='<span class="price price_320"> - ' . $sale . '</span>';
			echo $html;
		} 
		else{
			if(!empty($price) && ($price != 0)){
				$html = '<span class="price">' . $price .' '. $currency[0] .' </span>';
				$html_320 = '<span class="price price_320"> - ' . $price .' </span>';
				echo $html;
			}
			else{
				$html = '<span class="price">' . $price . ' </span>';
				$html_320 = '<span class="price price_320"> - ' . $price . ' </span>';
				echo $html;
			}
			
		}?>
	</div>
	<div class="product_content"><?php the_content(); ?></div>
	<div class="product_control">
		<button href="#" class="button btn_green single_buynow">
			<i class="ion-android-cart"></i>Buy Now <span class="price price_320"><?= $html_320?></span>
			<?php if(!empty($solvia)){ ?>
				<a href="<?php echo $link; ?>" rel="nofollow" class="button btn_green">Via <?php echo $solvia; ?> <i class="ion-android-arrow-forward"></i></a>
			<?php } ?>
		</button>

		<?php if( is_user_logged_in() ){ ?>
			<a href="#" rel="nofollow" data-id="<?php echo $post_id; ?>" class="button save_item <?php echo (in_array($post_id, $user_wishlist)) ? 'saved' : ''; ?>"><i class="ion-heart"></i><span><?php echo (in_array($post_id, $user_wishlist)) ? 'Saved' : 'Save'; ?></span></a>	
		<?php }else{ ?>
			<a href="#login" rel="nofollow" data-id="<?php echo $post_id; ?>" class="button save_item link_popup"><i class="ion-heart"></i><span>Save</span></a>
		<?php } ?>
	</div>
</div>