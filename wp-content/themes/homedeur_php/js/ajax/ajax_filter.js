$(document).ready(function($){
	$('.btn_price_filter').click( function(e){
		e.preventDefault();
		$('#items_filter').submit();
	});

	$('#items_filter').change( function(e){
		$(this).trigger('submit');
	});
	//submit form items_filter
	$('#items_filter').submit(function(e){
	});
});