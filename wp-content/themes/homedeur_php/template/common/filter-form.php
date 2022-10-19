<?php
	$symbol_currency = hd_get_currency_symbol();
	$start_price = 0;
	$end_price = 999;
	if(isset($_GET['start_price']) && is_numeric($_GET['start_price'])){
		$start_price = $_GET['start_price'];
	}
	if(isset($_GET['end_price']) && is_numeric($_GET['end_price'])){
		$end_price = $_GET['end_price'];
	}

	$arr_sort = array(
					'newest' 		=> 	'Newest Items',
					'oldest'		=>	'Oldest Items',
					'popular'		=>	'Popular Items',
					'price_asc'		=>	'Price: Low to Hight',
					'price_desc'	=>	'Price: Hight to Low'
				);

	$sort_by = '';
	if(isset($_GET['sort_by']) && !empty($_GET['sort_by'])){
		$sort_by = $_GET['sort_by'];
		$sort_by_text = $arr_sort[$sort_by];
	}
	if(!isset($sort_by_text) || empty($sort_by_text)){
		$sort_by_text = 'Sort By';
	}
?>
			<div class="filter">
				<form id="items_filter"">
					<?php
						if(isset($_GET['key'])){
							echo '<input type="hidden" name="key" value="'. $_GET['key'] .'" />';
						}
					?>
					<div class="price_filter">
						<a href="#" class="toggle_price_filter">
							Price Range<span class="wrap_value_price">: <?=$symbol_currency;?><span class="start_price"><?=$start_price;?></span> - <?=$symbol_currency;?><span class="end_price"><?=$end_price;?></span></span>
						</a>
						<div class="price_range">
							<p>Set Price Range</p>
							<div id="slider_range"></div>
							<div class="bottom_price_range">Price: <?=$symbol_currency;?>5 - <?=$symbol_currency;?>10000<a href="#" class="button btn_green btn_price_filter">Filter</a></div>
						</div>
						<input type="hidden" class="input_start_price" name="start_price" value="<?=$start_price;?>" />
						<input type="hidden" class="input_end_price" name="end_price" value="<?=$end_price;?>" />
					</div>
					<div class="sort_by">
						<a href="#" class="select"><?=$sort_by_text;?></a>
						<ul>
							<?php
								foreach ($arr_sort as $key => $value) {
									$checked = '';
									if( $key == $sort_by ){
										$checked = 'checked="checked"';
									}
									echo '<li><label for="' . $key .'">'. $value .'</label><input type="radio" name="sort_by" value="'. $key .'" id="'. $key .'" class="hidden" '. $checked .' /></li>';
								}
							?>							
						</ul>
					</div>
					<div class="view_option">
					<?php
						if(isset($_COOKIE['view_col']) && ($_COOKIE['view_col'] == 'col_2')){
							$col_2_active = 'active';
							$col_4_active = '';
						}else{
							$col_2_active = '';
							$col_4_active = 'active';
						}
					?>
						<a href="#" class="view_2_col <?=$col_2_active;?>" data-col="col_2"></a>
						<a href="#" class="view_4_col <?=$col_4_active;?>" data-col="col_4"></a>
					</div>
				</form>
			</div><!-- .filter -->