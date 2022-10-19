<?php get_header();
	
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
	
	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id;
	$term_name = $queried_object->name;
	$term_desc = $queried_object->description;
	$term_count = $queried_object->count;
	$thumb_url = get_term_meta($term_id, 'term_thumbnail', true);
	if( $thumb_url==''){
		$thumb_url = get_template_directory_uri() . '/images/banner.jpg';
	}

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
			'post_type' 	=>'hd_product',
			'post_status'	=>'publish',
			'posts_per_page'=> 12,
			'tax_query' 	=> array(
								array(
									'taxonomy' => 'hd_product_cat',
									'field'    => 'id',
									'terms'    => $term_id,
								),
							),
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

	$product = new WP_query($args);
?>	
		
		<section class="main_content">
			<section class="banner banner_cat">
				<div class="container">
					<img src="<?php echo $thumb_url; ?>" alt="banner" />
					<div class="content_banner">
						<div class="main_content_banner">
							<h1><?=$term_name;?></h1>
							<p><?=$term_desc;?></p>
						</div>
					</div>
				</div>
			</section>
			<section>
				<div class="container">
					<div class="heading heading_filter">
						<a href="<?php hd_get_page_by_slug('all-categories',false);?>" class="button"><span>Vew all categories</span>&nbsp;<i class="ion-ios-arrow-right"></i></a>
						<div class="filter">
							<?php get_template_part('template/common/filter-form'); ?>
						</div><!-- .filter -->
						<div class="clearfix"></div>
					</div><!-- .heading -->
			
					<div class="items items_load_more">
					<?php 
						if ( $product->have_posts() ) : 
							while ( $product->have_posts() ) : $product->the_post();
			
								hd_get_template_product('template/blocks/contents/product-item-share.php', 'thumb-small', true);	
										
							endwhile;
							
						else:
						
							echo 'Product not found!';
							
						endif;?>
						
					</div><!-- .items -->
					<?php if($term_count > 12){ ?>
						<div class="t_center pagination"><a href="#" data-firstoffset="4" data-startprice="<?=$data_startprice;?>" data-endprice="<?=$data_endprice;?>" data-sortby="<?=$data_sortby;?>" data-view="true" data-paged="2" data-term-id="<?php echo $term_id;?>" data-type="product" class="button load_more">Load More</a></div>
					<?php } ?>
				</div><!-- .container -->
			
			</section>
		</section>

	
<?php get_footer();?>