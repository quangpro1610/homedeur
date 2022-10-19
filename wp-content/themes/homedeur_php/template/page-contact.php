<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
		<section class="main_content">
			<section class="banner">
				<div class="container">
					<img src="<?php echo get_template_directory_uri(); ?>/images/banner-contact.jpg" alt="banner">
				</div>
			</section>
			
			<section class="normal_page">
				<div class="container">
							
					<div class="content_normal_page">
						
						<div class="row">
							<div class="col_2">
								<div class="head_content_page">
									<h4>Need Help?</h4>
									<p>Some pointers to support your inquiry.</p>
								</div>
								<div class="e_toggle">
									<div class="e_toggle_faq">
										<a href="#"><i class="ion-chevron-down"></i>What is Homedeur?</a>
										<div class="toggle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, officiis!</div>
									</div>
									<div class="e_toggle_faq">
										<a href="#"><i class="ion-chevron-down"></i>How to use the Platform?</a>
										<div class="toggle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, officiis!</div>
									</div>
									<div class="e_toggle_faq">
										<a href="#"><i class="ion-chevron-down"></i>How can we advertise?</a>
										<div class="toggle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, officiis!</div>
									</div>
									<div class="e_toggle_faq">
										<a href="#"><i class="ion-chevron-down"></i>Is homedeur open for press release?</a>
										<div class="toggle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, officiis!</div>
									</div>
									<div class="e_toggle_faq">
										<a href="#"><i class="ion-chevron-down"></i>How to report a broken page?</a>
										<div class="toggle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, officiis!</div>
									</div>
								</div>
							</div>
							<div class="col_2">
								<div class="head_content_page">
									<h4>Contact Us</h4>
									<p>Send Us a Message</p>
								</div>
								<?php echo do_shortcode('[contact-form-7 id="163" title="Contact form 1"]'); ?>
								<!-- <form id="contact_form" class="content_form">
									<input type="text" name="u_name" placeholder="Name" />
									<input type="text" name="u_email" placeholder="Email" />
									<select name="inquiry_type">
										<option value="">Select Inquiry</option>
									</select>
									<textarea name="message" placeholder="Add message here"></textarea>
									<div class="t_center"><button type="submit" class="button" name="submit">Send</button></div>
								</form> -->
							</div>
						</div>
						
					</div>	
			
				</div><!-- .container -->
			
			</section>
		</section>
<?php get_footer(); ?>