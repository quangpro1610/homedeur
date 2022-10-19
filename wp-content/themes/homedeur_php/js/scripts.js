$(document).ready(function($){
	
	$(window).load(function() {
		$('#slide_bar').css('opacity' , '1');
	});
	
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}
	
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length,c.length);
			}
		}
		return "";
	}

    //SLIDER
    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        /*controlNav: false,*/
        directionNav: false
      });
    });
    //SLIDER
    $(window).load(function() {
        load_product_slider();
    });
    $(window).resize(function(e){
        load_product_slider();
    });
    function load_product_slider(){
        var ww = $(window).width();
        if(ww > 320){
            var w_item = 170;
        }else{
            var w_item = 130;
        }
        $('.product_flexslider').flexslider({
            animation: "slide",
            animationLoop: true,
            itemWidth: w_item,
            itemMargin: 30,
            controlNav: false,
            // directionNav: false
          });
    }
	
	//SEARCH INPUT
	$('#search input').keyup( function(e){
		if( $(this).val() != '' ){
			$(this).addClass('hastext');
		}else{
			$(this).removeClass('hastext');
		}
	});
	
	//single product gallery slider
	$('.product_slider .slides a').click( function(e){
		e.preventDefault();
		var embed = $(this).data('embed');
		$('.product_thumbnail').children().appendTo('.wrap_embed');
		$('.wrap_embed .'+embed).appendTo('.product_thumbnail');
	});
	
    // ADD CLASS active_rating FOR EDITOR'S RATING
    if($('#editor_rating').length > 0){
        var rating = $('#editor_rating').data('rating');
        $('#editor_rating span').each(function( index ){
            if( index < rating ){
                $(this).addClass('active_rating');
            }
        });
    }      

	// POPUP
	$('.link_popup').click( function(e){
		e.preventDefault();
		var id_popup = $(this).attr('href');
		$('.popup'+id_popup).show();
		$('body').addClass('open_popup');
	});

    //BUTTON MORE IN SOCIAL_SHARE_SIDEBAR
    $('.box_sidebar_socials .load_more_share').click( function(e){
        e.preventDefault();
        $(this).next().show();
        $(this).hide();
    });

	$('.close_popup').click( function(e){
		e.preventDefault();
		$(this).parents('.popup').hide();
		$(this).parents('.popup').find('*').removeAttr('style');
		$('body').removeClass('open_popup');
	});

	$('.create_account').click( function(e){
		e.preventDefault();
		$(this).parents('form#form_login').hide();
		$(this).parents('.content_popup').find('form#form_signup').show();
	});

    $('.link_subscribe a').click( function(e){
        e.preventDefault();
        var id_popup = '#subscribe';
        $('.popup'+id_popup).show();
        $('body').addClass('open_popup');
    });

	$('.toogle_menu').click(function(e){
		e.preventDefault();
	  	$('#menu-toggle').toggleClass('open');
	  	$('body').toggleClass('open_menu');
	});

	$('.main_overlay').click( function(e){
		e.preventDefault();
		$('body').removeClass('open_menu');
		$('#menu-toggle').removeClass('open');
	});

	$('.main').on('click', '.share_item', function(e){
		e.preventDefault();
		$(this).next().show();
	});
	$('.main').on('mouseleave', '.main_item', function(e){
		e.preventDefault();
		$(this).find('.box_share').hide();
	});

	// TOGGLE MENU MOBILE BLOG
	$('.menu_blog_mobile').click( function(e){
		$(this).next().toggleClass('open');
	});

	// RANGE PRICE
	$( ".toggle_price_filter" ).click( function(e){
        e.preventDefault();
		$('.price_range').slideToggle('fast');
	});
	$( "#slider_range" ).slider({
      range: true,
      min: 0,
      max: 999,
      step: 5,
      values: [ 0, 999 ],
      slide: function( event, ui ) {
        $( ".start_price" ).text( ui.values[ 0 ] );
        $( ".end_price" ).text( ui.values[ 1 ] );
        $( ".input_start_price" ).val( ui.values[ 0 ] );
        $( ".input_end_price" ).val( ui.values[ 1 ] );
      }
    });

    // ORDER TOGGLE
    $( "#items_filter .sort_by .select" ).click( function(e){
        e.preventDefault();
        $(this).next().slideToggle('fast');
    });

    // E_TOGGLE
    $('.e_toggle a').click( function(e){
    	e.preventDefault();
    	$(this).parent().siblings().children('div').slideUp();
    	$(this).next().slideToggle();
    });

    //view grid
    $('.view_option a').click( function(e){   
		//alert ('a');
        e.preventDefault();
        var data_view = $(this).data('col');
		document.cookie = "view_col=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        if( $(document).find('.home_items').length ){
            if(data_view == 'col_4'){
                $('.home_items .item_clone').insertBefore('.home_items .random_cat_item');
                //$('.pagination .load_more').data('paged', 2);
            }else{
                $('.home_items .item_clone').insertBefore('.home_items .item:nth-child(11)');
                //$('.pagination .load_more').data('paged', 3);
            }
        }
        if(data_view == 'col_4'){
            $('.items .item').removeClass('col_2').addClass(data_view);
			setCookie('view_col','col_4',7);
        }else{
            $('.items .item').addClass(data_view);
			setCookie('view_col','col_2',7);
        }
		$(this).addClass('active').siblings().removeClass('active');
    });


    // TAB USER SETTINGS
    $('.nav_dashboard a').click( function(e){
    	e.preventDefault();
    	var tab_id = $(this).attr('href');
    	$(this).parent().addClass('active').siblings().removeClass('active');
    	$('.tab_contents .tab'+tab_id).addClass('active').siblings().removeClass('active');
    });

    // feeds settings script
    $('.feed label').click( function(e){
    	var feed = $(this).parents('.feed');
    	if( feed.hasClass('active') ){
    		$(this).prev().prop('checked', true);
    		feed.removeClass('active');
    	}else{
    		$(this).prev().prop('checked', false);
    		feed.addClass('active');
    	}

    });

	//LOAD MORE
	$('.pagination').delegate('.load_more', 'click', function(e){
    	e.preventDefault();
        var this_e = $(this);
        var this_parent = $(this).parent();
        var firstoffset = $(this).data('firstoffset');
        var key = $(this).data('key');
        var clone = $(this).data('clone');
        var paged = $(this).data('paged');
        var startprice = $(this).data('startprice');
        var endprice = $(this).data('endprice');
        var sortby = $(this).data('sortby');
    	var view = $(this).data('view');
    	var	term_id = $(this).data('term-id');
    	var data_type = $(this).data('type');
    	var action = 'ajax_hd_load_more';

        $data_post = {
                        'action'        :   action,
                        'firstoffset'   :   firstoffset,
                        'key'   		:   key,
                        'clone'    		:   clone,
                        'startprice'    :   startprice,
                        'endprice'      :   endprice,
                        'sortby'        :   sortby,
                        'view'          :   view,
                        'data_type'     :   data_type,
                        'paged'         :   paged,
                        'term_id'       :   term_id,
                    };
        //console.log(paged);
    	$.ajax({
            type: 'POST',
            dataType: 'html',
            url: obj.ajaxurl,
            data: $data_post,
            success: function (data) {
                var len = $(data).filter(".item").length;
				//console.log(len);
				$('.items_load_more').find('.item_clone').remove();
				if( $('.items_load_more .random_cat_item').length ){
					$(data).insertBefore('.items_load_more .random_cat_item');
					
				}else{
					$(data).appendTo('.items_load_more');
				}
               
                if(len < 8){
                    this_parent.hide();
                }else{
                    this_e.data('paged', paged + 1);
                }
 			},
 			error: function(data){
 				/*console.log('data');*/
 			}
        });

    });

    // TAB SOCIAL SHARE BUTTON

    $(".tab_content").hide();
    $(".tab_content:first").show();
    $("ul.social_share_tabs li").click(function() {
        $("ul.social_share_tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();
        var activeTab = $(this).attr("rel");
        $("#"+activeTab).fadeIn();
    });

    //close popup send email
    $(document).delegate('#send_email .close_popup', 'click', function(e){
        e.preventDefault();
        $(this).parents('#send_email').remove();
        $('body').removeClass('open_popup');
    });

    //hide/appear on the page feeds
    $('.toggle_head_feed').click( function(e){
        e.preventDefault();
        $('.head_feed_content').slideToggle();
        $(this).children('i').toggleClass('hidden');
    });

	//toggle comment
	$('.toggle_comment').click( function(e){
		e.preventDefault();
		$(this).parents('.wrap_comment').find('.main_comment').slideToggle();
        $(this).children('a').toggleClass('hidden');
	});
});