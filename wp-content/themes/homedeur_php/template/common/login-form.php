		<div id="login" class="popup">
			<a href="#" class="close_popup"><i class="ion-close-round"></i></a>
			<div class="main_popup">
				<div class="content_popup">
					<a href="#" class="logo">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" />
					</a>

					<form id="form_login" method ="" class="content_form" action="">
						<p class="head">Login</p>
						<div class="message"></div>
						<input type="text" name="email" id="email" placeholder="Email" />
						<input type="password" name="password" id="password" placeholder="Password" />
						<input type="hidden" name="action" value="hd_ajax_user_login" />
						<div class="submit">
							<button type="submit" name="submit" value="submit" class="button btn_green">LOG IN</button><span>Or</span><a href="#" class="button btn_blue" id="login_facebook">Login with Facebook</a>
						</div>
						<a href="#" class="t_left">Forgot Password?</a>
						<div class="bottom_login">
							<p>Don't Have Account Yet?</p>
							<a href="#" class="create_account">Create Account Now</a>
						</div>
					</form>
					<form id="form_signup" method="post" class="content_form" action="">
						<p class="head">Create Account</p>
						<div class="message"></div>
						<input type="text" id="firtsname" name="firstname" placeholder="First Name" required/>
						<input type="text" id="email" name="email"  placeholder="Email" required/>
						<input type="password" id="password"  name="password" placeholder="Password" required minlength="6"/>
						<input type="hidden" name="action" value="hd_ajax_user_signup" />
						<div class="submit">
							<button type="submit" name="submit" value="submit" class="button btn_green">REGISTER NOW</button><span>Or</span><a href="#" class="button btn_blue" id="signup_facebook">Signup with Facebook</a>
						</div>
						<div class="bottom_login">
							<p>By clicking Register Now, you agree to our <a href="#">Terms of Use</a></p>
						</div>
					</form>
				</div>
			</div>
		</div><!-- .popup register-login -->