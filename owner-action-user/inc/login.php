<?php if ( is_user_logged_in()){?>
	<script>
	window.location.href = '<?php echo home_url();?>/portal-checklist';
	</script>
<?php }else{ ?>
	<div class="owner_login" id="owner_login_panel">
		<div class="login-text">
			<h1>Login</h1>					
		</div>
		<div class="owner_login_contain">
			<form id="owner_login">
				<div class="user_form_field">
					<label for="login_email">Username or E-mail Address:</label>
					<input type="text" id="login_email" name="login_email">
				</div>
				<div class="user_form_field">
					<label for="login_password">Password:</label>
					<input type="password" id="login_password" name="login_password">
				</div>
				<div class="user_form_field">
					<input type="checkbox" id="remember" name="remember" value="remember">
					<label for="remember">Remember Me</label>
				</div> 
				<div class="user_form_field">
					<input type="hidden" name="dashboard" value="dashboard">
					<input type="hidden" name="action" value="owner_login_ajax_action">
					<?php wp_nonce_field( 'login_security', 'login_security_action' ); ?>
					<input type="submit" id="login_submit" name="login_submit" value="Log In">
				</div>
				<div id="login_message"></div>
			</form>
		</div>
	</div>
<?php }?>