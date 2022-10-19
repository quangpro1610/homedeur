<?php
	
	$cats = wp_get_post_terms( $p_id, 'hd_product_cat' );
	$categories = '';
	if(count($cats)){
		foreach ($cats as $cat) {
			$categories .= $cat->name;
		}
	}
	$solvia 	= get_post_meta( $p_id, '_cmb_product_sold_name', true); 
	$dimension  = get_post_meta( $p_id, '_cmb_product_dimension', true); 
	$color  	= get_post_meta( $p_id, '_cmb_product_color', true); 
	$material  	= get_post_meta( $p_id, '_cmb_product_material', true); 
	$shipping  	= get_post_meta( $p_id, '_cmb_product_shipping', true); 
	$rating  	= get_post_meta( $p_id, '_cmb_product_editors_rating', true); 
	if( empty($rating) ){
		$rating = 0;
	}

?>
<div class="box_sidebar box_info">
	<div class="heading_sidebar">Product Information</div>
	<table width="100%" cellspacing="20px">
		<?php if( $solvia !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Sold Via</td>
				<td><?php echo $solvia; ?></td>
			</tr>
		<?php } ?>
		<?php if( $categories !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Category</td>
				<td><?php echo $categories; ?></td>
			</tr>
		<?php } ?>
		<?php if( $dimension !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Dimension</td>
				<td><?php echo $dimension; ?></td>
			</tr>
		<?php } ?>
		<?php if( $color !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Colors</td>
				<td><?php echo $color; ?></td>
			</tr>
		<?php } ?>
		<?php if( $material !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Material</td>
				<td><?php echo $material; ?></td>
			</tr>
		<?php } ?>
		<?php if( $shipping !='' ){ ?>
			<tr>
				<td align="right" class="info_right">Shipping</td>
				<td><?php echo $shipping; ?></td>
			</tr>
		<?php } ?>
		
		<tr>
			<td align="right" class="info_right">Editor's Rating</td>
			<td>
				<div id="editor_rating" data-rating="<?= $rating ?>">
					<span class="ion-android-star"></span>
					<span class="ion-android-star"></span>
					<span class="ion-android-star"></span>
					<span class="ion-android-star"></span>
					<span class="ion-android-star"></span>
				</div>
			</td>
		</tr>
	</table>
</div><!-- .box_sidebar -->