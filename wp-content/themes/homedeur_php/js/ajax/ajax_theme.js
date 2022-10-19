$(document).ready(function($){
	$('.box_share .email').click( function(e){
		e.preventDefault();
		var product_id = $(this).data('id');
		$.ajax({
                  type: 'POST',
                  dataType: 'html',
                  url: obj.ajaxurl,
                  data: {
                  	'action'         :     'ajax_hd_get_template_popup_send_email',
                  	'product_id'     :     product_id, 
                  },
                  success: function (data) {
                  	if(data != ''){
                  		$('body').addClass('open_popup');
      				$('body').append(data);
                  	}
                  }
            });
	});

      $(document).delegate('#form_send_email', 'submit', function(e){
            e.preventDefault();
            $(this).find('.message').empty();
            var this_f = $(this);
            var post_data = $(this).serialize();
            $.ajax({
                  type: 'POST',
                  dataType: 'json',
                  url: obj.ajaxurl,
                  data: post_data,
                  success: function (data) {
                        if(data.status == true){
                              this_f.find('.message').append(data.message);
                              setTimeout(function() {
                                  this_f.parents('.popup').remove();
                                  $('body').addClass('open_popup');
                              }, 2000);
                        }else{
                              this_f.find('.message').append(data.message);
                        }
                  }
            });
      });
});