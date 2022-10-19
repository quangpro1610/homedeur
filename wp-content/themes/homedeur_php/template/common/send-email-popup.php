		<div id="send_email" class="popup" style="display:block;">
			<a href="#" class="close_popup"><i class="ion-close-round"></i></a>
			<div class="main_popup">
				<div class="content_popup">
					<a href="#" class="logo">
						<span>HOME</span><span>DEUR</span><span>TM</span>
					</a>
					<form id="form_send_email" class="content_form" action="">
						<p class="head">SEND A MESSAGE</p>
						<div class="message" style="color:red;margin:10px 0;"></div>
						<input type="text" name="email_from" placeholder="From" />
						<input type="text" name="email_to" placeholder='To (Emails separated by ",")' />
						<input type="text" name="product_title" value="<?=$product_title?>" placeholder="Product title" />
						<textarea name="mail_content" placeholder="Message content"></textarea>
						<input type="hidden" name="url_post" value="<?=$product_url;?>" />
						<input type="hidden" name="action" value="ajax_hd_send_message_product_by_email" />
						<div class="submit">
							<a href="#" class="button close_popup">CANCEL</a><button type="submit" name="submit" class="button btn_green">SEND</button>
						</div>
					</form>
				</div>
			</div>
		</div><!-- .popup send-email -->