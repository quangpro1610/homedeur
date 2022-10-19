<?php
if(is_user_logged_in()){
	$u_id = get_current_user_id();
	$GLOBALS['user_wishlist'] = get_user_meta($u_id, 'user_wishlist', true);
}else{
	$GLOBALS['user_wishlist'] = array();
}

$data_startprice = $data_endprice = $data_sortby = '';
if(isset($_GET['start_price'])){
	$data_startprice = $_GET['start_price'];
}
if(isset($_GET['end_price'])){
	$data_endprice = $_GET['end_price'];
}
if(isset($_GET['sort_by'])){
	$data_sortby = $_GET['sort_by'];
}
get_header(); ?>
<?php
	$options = get_option('theme_option');
	$slider_text = $options['_cmb_slider_text'];
	$slider_images = $options['_cmb_images_group'];
	$args_post_slider = array(
					'post_type' 		=> 	'hd_product',
					'posts_per_page'	=>	-1,
					'meta_key' 			=>	'_cmb_include_to_home_slider',
					'meta_value' 		=>	'true',
				);
	$posts_slider = new WP_Query($args_post_slider);
				
	if( count($slider_images) || ($posts_slider->post_count > 0) ){
		$html_banner = '<ul class="slides">';
		if( count($slider_images) ){
			foreach ($slider_images as $key => $image) {
				$slider_button = '';
				if($key == 0 && is_user_logged_in()){
					continue;
				}elseif($key == 0 && !is_user_logged_in()){
					$slider_button = '<a href="#login" class="button btn_green link_popup">CREATE MY FREE ACCOUNT</a>';
				}
				$slider_url = "'" . $image['slider_url'] . "' , '_self'";
				$html_banner .= '<li>
									<img src="'.$image['slider_image'].'" rel="nofollow" alt="image slider" />
									<div onclick="window.open('. $slider_url .'); return false;" class="content_slider">
										<div>
											<h1>' . $image['slider_text'] . '</h1>
											'. $slider_button.'
										</div>
									</div>
								</li>';
			}
		}
		if( $posts_slider->have_posts()){
			while( $posts_slider->have_posts() ) : 
				$posts_slider->the_post(); 
				$slider_url = "'" . get_permalink() . "' , '_self'";
				$slider_img = get_the_post_thumbnail_url('', 'home-slider-large');
				$html_banner .= '<li>
									<img src="'.$slider_img.'" rel="nofollow" alt="image slider" />
									<div onclick="window.open('. $slider_url .'); return false;" class="content_slider">
										<div>
											<h1>' . get_the_title() . '</h1>
										</div>
									</div>
								</li>';
			endwhile;
		}
		$html_banner .= '</ul>';
	}else{
		$banner_url = get_the_post_thumbnail_url();
		if( !$banner_url ){
			$banner_url = get_template_directory_uri() . '/images/banner.jpg';
		}
		$html_banner = '<ul class="slides">';
		$html_banner .= '<li><img src="'.$banner_url.'" rel="nofollow" alt="image slider" /></li>';
		$html_banner .= '</ul>';
	}
	$featured_item_home = $options['_cmb_featured_items_home'];
	$symbol_currency = hd_get_currency_symbol();

?>	

<section class="main_content">
	<section class="banner slider">
		<div class="container">
			<div class="flexslider">
			  <?php echo $html_banner; ?>
			</div>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="heading heading_filter">
				<?php if( $featured_item_home != 'disable' ){ ?>
					<h2 class="title">Featured Items</h2>
				<?php }else{ ?>
					<h2 class="title">Added Today</h2>
				<?php } ?>
				<?php get_template_part('template/common/filter-form'); ?>
				<div class="clearfix"></div>
			</div><!-- .heading -->
	
			<?php if( $featured_item_home != 'disable' ){ ?>
			<div class="featured_items">
			<?php 
				$args = array(
					'post_type' 		=> 'hd_product',
					'posts_per_page'	=>	4,
					'tax_query' 		=> array(
			                                array(
			                                    'taxonomy' => 'hd_product_cat',
			                                    'field'    => 'id',
			                                    'terms'    => 24,
			                                ),
	                            		),
					'orderby' => 'date',
					'order' => 'ASC'
				);
				$featured = new WP_Query( $args );
				$i = 0;
				if( $featured->have_posts()):
					while( $featured->have_posts() ) : 
						$featured->the_post(); 
						$i++;
						if ($i == 1 ) { 
							$thumb_size = 'thumb-large'; // show featured image	
						} 
						elseif ($i == 4){
							$thumb_size = 'thumb-middle';
						}
						else{
							$thumb_size = 'thumb-small';
						}
						hd_get_template_product('template/blocks/contents/product-item-share.php',$thumb_size);
					endwhile;
				endif;
				?>	
			</div><!-- .featured_items -->
			<?php } ?>
	
			<?php if( empty($featured_item_home) || $featured_item_home == 'enable' ){ ?>
			<div class="heading">
				<h2 class="title">Added Today</h2>
				<div class="clearfix"></div>
			</div><!-- .heading -->
			<?php } ?>
			<div class="items home_items items_load_more">
				<?php
					if(is_user_logged_in()){
						$u_id = get_current_user_id();
						$user_data  = get_userdata($u_id);
						$user_meta  = get_user_meta($u_id);
						$currency   = $user_meta['u_currency'];
					
						if( count($currency) && $currency[0] != '' ){
							$currency   = $currency[0];
						}else{
							$currency   = 'usd';
						}
					}else{
						$currency   = 'usd';
					}
	
				 	$m_key_filter= '_cmb_filter_price_' . $currency;
				 	$args = array(
						'post_type' => 'hd_product',
						'posts_per_page'	=>	11,
						'meta_query' => array(),
					);
	
					if(isset($_GET['start_price']) && is_numeric($_GET['start_price']) ){
						$m_query = array(
										'key' => $m_key_filter,
										'value' => $_GET['start_price'],
										'compare' => '>=',
										'type' => 'numeric'
									);
	
						$range['meta_query'][] = $m_query;
						$args = array_merge($args,$range);
					}
	
					if(isset($_GET['end_price']) && is_numeric($_GET['end_price']) ){
						$m_query_e = array(
										'key' => $m_key_filter,
										'value' => $_GET['end_price'],
										'compare' => '<=',
										'type' => 'numeric'
									);
						$range['meta_query'][] = $m_query_e;
						$args = array_merge($args,$range);
					}
					
					if(isset($_GET['sort_by'])){
						if($_GET['sort_by'] == 'newest'){
							$order = array(
										'orderby'	=>	'date',
									);
						}
						if($_GET['sort_by'] == 'oldest'){
							$order = array(
										'orderby'	=>	'date',
										'order'		=>	'ASC'
									);
						}
						if($_GET['sort_by'] == 'price_asc'){
							$order = array(
										'meta_key'  =>  $m_key_filter,
										'orderby'	=>	'meta_value_num',
										'order'		=>	'ASC',
									);
						}
						if($_GET['sort_by'] == 'price_desc'){
							$order = array(
										'meta_key'  =>  $m_key_filter,
										'orderby'	=>	'meta_value_num',
										'order'		=>	'DESC',
									);
						}
						if($_GET['sort_by'] == 'popular'){
							$order = array(
										'orderby' => 'comment_count'
									);
						}
	
						$args = array_merge($args,$order);
	
					}
					$addnew = new WP_Query( $args );
					if( $addnew->have_posts()) :
						$i = 0;
						while( $addnew->have_posts() ) : $addnew->the_post();
							$inc_class = '';
							$i++;
							if( $i == 11 ){
								$inc_class = 'item_clone';
					        }
							hd_get_template_product('template/blocks/contents/product-item-share.php', 'thumb-small', true, $inc_class);
							
						endwhile;
					endif;
				?>
				<?php hd_get_random_item_category('thumb-middle'); ?>
			</div><!-- .home_items -->
			<div class="t_center pagination"><a href="#" class="button load_more" data-firstoffset="2" data-clone="1" data-startprice="<?=$data_startprice;?>" data-endprice="<?=$data_endprice;?>" data-sortby="<?=$data_sortby;?>" data-view="true" data-paged="2" data-type="product">Load More</a></div>
		</div><!-- .container -->
	</section>
</section>

<?php get_footer(); ?>