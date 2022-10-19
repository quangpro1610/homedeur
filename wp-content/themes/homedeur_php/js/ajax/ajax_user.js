$(document).ready(function($){
	"use strict";

//Login
	$('#form_login').submit( function(e){
		e.preventDefault();
		$('#form_login .message').empty();
		var data_post = $(this).serialize();
		//console.log(data_post);
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: obj.ajaxurl,
            data: data_post,
            success: function (data) {
				if(data.status == 'success'){
					location.replace(data.redirect);
				}else{
					$('#form_login .message').append('<p>'+data.message+'</p>');
				}
            }
        });
	});


// Sigup
	$('#form_signup').submit( function(e){
		e.preventDefault();
		$('#form_signup .message').empty();
		var data_post = $(this).serialize();
		//console.log(data_post);
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: obj.ajaxurl,
            data: data_post,
            success: function (data) {
            	if(data.status == 'success'){
			  		$('#form_signup .message').append('<p>'+data.message+'</p>');
			  		setTimeout(function() {
					    window.location.replace(data.redirect);
					}, 2000);

			  	}else{
			  		$('#form_signup .message').append('<p>'+data.message+'</p>');
			  	}
      		}
        });
	});
	
//Login - Signup Facebook
	function statusChangeCallback(response, type) {	   
		if (response.status === 'connected') {
		  connect_facebook(type);	
		} else if (response.status === 'not_authorized') {
		  console.log( 'Please log ' + 'into this app.');
		  FB.login(function(response) {
				connect_facebook(type);
			 }, {scope: 'public_profile,email'});
		} else {
		  console.log( 'Please log ' + 'into Facebook.');
		   FB.login(function(response) {
				connect_facebook(type);
			 }, {scope: 'public_profile,email'});
		}
	}
  
	function checkLoginState(type) {
		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response, type);
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '1047868651972015',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.5'
		});
	};

  // Load the SDK asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	function connect_facebook(type) {
		FB.api('/me?fields=first_name, email', function(response) {
			if(response.error){
				//alert( 'please accept us app' );
			}else{
				console.log(response);
				if(!response.email){
					$('#form_login .message').html('<p>Please provide your email (important)!</p>');
				}else{
					if(type == 'login'){
						var data_post = {
							'email': response.email,
							'action': 'hd_ajax_user_login_facebook', 
							'security': obj.ajax_nonce
						};
						console.log(data_post);
						$.ajax({
							type: 'POST',
							dataType: 'json',
							url: obj.ajaxurl,
							data: data_post,
							success: function (data) {
								if(data.status == 'success'){
									$('#form_login .message').append('<p>'+data.message+'</p>');
									setTimeout(function() {
										window.location.replace(data.redirect);
									}, 2000);

								}else{
									$('#form_login .message').append('<p>'+data.message+'</p>');
								}
							}
						});
					}else{
						var data_post = {
							'first_name': response.first_name,
							'email': response.email,
							'action': 'hd_ajax_user_signup_facebook', 
							'security': obj.ajax_nonce
						};
						console.log(data_post);
						$.ajax({
							type: 'POST',
							dataType: 'json',
							url: obj.ajaxurl,
							data: data_post,
							success: function (data) {
								if(data.status == 'success'){
									$('#form_signup .message').append('<p>'+data.message+'</p>');
									setTimeout(function() {
										window.location.replace(data.redirect);
									}, 2000);

								}else{
									$('#form_signup .message').append('<p>'+data.message+'</p>');
								}
							}
						});
					}
				}
			}
		});
	}
	
  $('#login_facebook').click( function(e){
	$('#form_login .message').empty();
	checkLoginState('login');
  });
  
  $('#signup_facebook').click( function(e){
	$('#form_signup .message').empty();
	checkLoginState('signup');
  });

//save item	
	$('body').delegate('.save_item', 'click', function(e){
		if( !$(this).hasClass('link_popup') ){
			e.preventDefault();
			var this_e = $(this);
			var id = $(this).attr("data-id");
			
			var data_post = {
				'product_id': id, 
				'action': 'ajax_save_product_wishlist', 
				'security': obj.ajax_nonce
			};
			console.log(data_post);
			$.ajax({
		        type: 'POST',
		        dataType: 'json',
		        url: obj.ajaxurl,
		        data: data_post,
		        success: function (data) {
		        	if(data.status == 'success'){
		        			$('[data-id=' + id + ']').toggleClass("saved");
		        			if(data.saved == 'set'){
		        				this_e.find('span').html('Saved');
		        			}else{
		        				this_e.find('span').html('Save');
		        			}
				  	}else{

				  	}
		  		}
		    });
		}
	});
//delete alert message
	

// save edit profile

	$('#edit_profile form').submit( function(e){
		e.preventDefault();
		var data_post = $(this).serialize();
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: obj.ajaxurl,
            data: data_post,
            success: function (data) {
				$('#edit_profile .message').empty().append('<p>'+data.message+'</p>');
				setTimeout(function() {
					$('#edit_profile  .message').empty();
				}, 2000);
            },error:function(data){
            	$('#edit_profile .message').empty().append('<p>'+data.message+'</p>');
            }
        });
	});

//change password
	$('#change_password').submit( function(e){
		e.preventDefault();
		$(this).find('.message').empty();
		var this_e = $(this);
		var data_post = $(this).serialize();
		//console.log(data_post);
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: obj.ajaxurl,
            data: data_post,
            success: function (data) {
            	console.log(data);
            	if(data){
            		this_e.find('.message').append('<p>'+data.message+'</p>');
            		setTimeout(function() {
						this_e.find('.message').empty();
					}, 2000);
            	}
 			},
 			error: function(data){
 				console.log(data);
 			}
        });
	});

	//save feed category 
	$('#my_feed form').submit( function(e){
		e.preventDefault();
		var this_e = $(this);
		$(this).find('.message').empty();
		var form = $(this);
		var count = $(this).find('.feed.active').length;
		if(count < 5){
			$(this).find('.message').append('<p>Please choose at least 5 categories.</p>');
		}else{
			//console.log(count);
			var data_post = $(this).serialize();
			//console.log(data_post);
			$.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: obj.ajaxurl,
	            data: data_post,

	            success: function (data) {
	            	console.log(data);
	            	if(data.status){
	            		this_e.find('.message').append('<p>'+data.message+'</p>');
	            		setTimeout(function() {
							this_e.find('.message').empty();
						}, 2000);
	            		if(data.redirect!=''){
	            			window.location.href = data.redirect;
	            		}
	            	}else{
						this_e.find('.message').append('<p>Error! Please try again.</p>');
						setTimeout(function() {
							this_e.find('.message').empty();
						}, 2000);
	            	}
	 			},
	 			error: function(data){
	 				//console.log(data);
	 			}
	        });
		}
	});

	//Delete Account
	$('#delete_account form').submit( function(e){
		e.preventDefault();
		var form = $(this);
		var data_post = $(this).serialize();
		/*console.log(data_post);*/
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: obj.ajaxurl,
            data: data_post,
            success: function (data) {
            	console.log(data);
            	if(data.status){
            		$('.message').append('<p>'+data.message+'</p>');
            		setTimeout(function() {
            			window.location.replace(data.redirect);
					}, 2000);
        		}else{
					/*$('.message').append('<p>'+data.message+'</p>');*/
            	}
 			},
 			error: function(data){
 				//console.log(data);
 			}
        });
	});

})
