<?php
	$args = array(
				'number'		=>	4,
				'meta_query' => array(
						            array(
						                    'key' => 'term_pin_top',
						                    'value' => 'true',
						                )
					        	),
				'hide_empty'	=>	false
			);
	$terms = get_terms( 'hd_product_cat', $args );
	
	if($terms){ ?>

		<div class="featured_items">

		<?php $i = 1;
		foreach ( $terms as $term ) {
			
			$term_id = $term->term_id;
			
			if( $i == 1 ){
				
				hd_get_template_category_item( $term_id, 'hd_product_cat', 'large' );

			}elseif( $i == 4 ){
				
				hd_get_template_category_item( $term_id, 'hd_product_cat', 'middle' );

			}else{
				
				hd_get_template_category_item( $term_id, 'hd_product_cat', 'small' );

			}

			$i++;

		} ?>

		</div><!-- .featured_items -->

	<?php } ?>