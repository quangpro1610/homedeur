<?php /*  Template Name: Search Products template */ ?>
<?php
	get_header();
?>
<?php
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
	
	if(isset($_GET['key'])){
		$key = $_GET['key'];
	}else{
		$key = '';
	}
	$args = array(
		'post_type' 		=> 'hd_product',
		'posts_per_page'	=>	12,
		's' 				=> $key
	);
	//merge filter query
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
	//end merge filter query

	$query = new WP_Query($args);
?>
<section class="main_content">
	<section>
		<div class="container">
			<div class="heading heading_filter">
				<h2 class="title">Search Result for "<?=$key;?>"</h2>
				<?php get_template_part('template/common/filter-form'); ?>
				<div class="clearfix"></div>
			</div>
			
			<div class="items items_load_more">
				<?php
				if(isset($query) ){
					if( $query->have_posts()):
						while( $query->have_posts() ) : 
								$query->the_post();
					
								hd_get_template_product('template/blocks/contents/product-item-share.php','thumb-small', true);
						endwhile;
					else:
						
						echo 'Product not found!';
						
					endif;
				}
				?>
			</div><!-- .items -->
			<?php if($query->found_posts > 12){ ?>
				<div class="t_center pagination"><a href="#" class="button load_more" data-key="<?=$key;?>" data-firstoffset="4" data-startprice="<?=$data_startprice;?>" data-endprice="<?=$data_endprice;?>" data-sortby="<?=$data_sortby;?>" data-view="true" data-paged="2" data-type="product">Load More</a></div>
			<?php } ?>

		</div><!-- .container -->

	</section>
</section>
<?php get_footer();?>