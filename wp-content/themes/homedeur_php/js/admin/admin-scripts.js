jQuery(document).ready(function($){

	var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

	$('.choose_image').click( function(e){
		e.preventDefault();
		
		var send_attachment_bkp = wp.media.editor.send.attachment;
	    var button = $(this);
	    var input = $(this).prev();

	    _custom_media = true;
	    wp.media.editor.send.attachment = function(props, attachment) {

	      	if ( _custom_media ) {
		        $(input).val(attachment.url);
	      	} else {
		        return _orig_send_attachment.apply( this, [props, attachment] );
	      	}

	    }

	    wp.media.editor.open(button);

	    return false;

	});

	$('.add_media').on('click', function() {
	    _custom_media = false;
  	});

  	//tabs script
  	$('.tab_links a').click( function(e){
  		e.preventDefault();
  		var tab_id = $(this).attr('href');
  		var tab_contents = $(this).parents('.tabs').children('.tab_contents');
  		console.log(tab_id);
  		$(this).addClass('active').parent().siblings().children().removeClass('active');
  		$(this).parents('.tabs').find(tab_id).addClass('active').siblings().removeClass('active');
  	});
    
});