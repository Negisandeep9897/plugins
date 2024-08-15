<?php
if ( is_user_logged_in() ) { 
	$current_user = wp_get_current_user();
	
    $user_id = $current_user->ID;
    $user_data = get_user_meta($user_id);
	
	$company_name = get_user_meta( $user_id, 'company_name', true );
	$last_name = get_user_meta( $user_id, 'last_name', true );
	$first_name = get_user_meta( $user_id, 'first_name', true );
	
	$email_address = get_user_meta( $user_id, 'email_address', true );
	
	$expertise = get_user_meta( $user_id, 'expertise', true );
	
	$services = get_user_meta( $user_id, 'services', true );
	$others_services = get_user_meta( $user_id, 'others_services', true );
	
	$firm = get_user_meta( $user_id, 'firm', true );
	$others_firm = get_user_meta( $user_id, 'others_firm', true );

	$firm_two = get_user_meta( $user_id, 'firm_two', true );
	$others_firm_two = get_user_meta( $user_id, 'others_firm_two', true );
	
	$consulting = get_user_meta( $user_id, 'consulting', true );
	$others_consulting = get_user_meta( $user_id, 'others_consulting', true );

	$marketing = get_user_meta( $user_id, 'marketing', true );
	$others_marketing = get_user_meta( $user_id, 'others_marketing', true );

	$web_devlopement = get_user_meta( $user_id, 'web_devlopement', true );
	$others_web_devlopement = get_user_meta( $user_id, 'others_web_devlopement', true );
	
	$national = get_user_meta( $user_id, 'national', true );
	$msa_states = get_user_meta( $user_id, 'msa_states', true );

?>
	<!--  welcome-sec -->
	<section class="welcome-sec">
	   <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="update-text">
						<a class="retuen_portal_btn" href="<?php echo get_the_permalink(3382);?>">Return to the portal</a>
						<h1>Update my information</h1>					
					</div>
					<div class="purchase form-area">
						<div class="form-part">
							<form id="update_register"> 
							
								<aside class="full-lenth">
									<label for="fname">First Name:</label>
									<input type="text" id="fname" name="first_name"  value="<?php if(!empty($first_name)){echo $first_name;}?>" required>
								</aside>
								<aside class="full-lenth">
									<label for="lname">Last Name:</label>
									<input type="text" id="lname" name="last_name"  value="<?php if(!empty($last_name)){echo $last_name;}?>">
								</aside>
								<aside class="full-lenth">
									<label for="email">Email Address:</label>
									<input id="email" type="text"  name="email_address" value="<?php if(!empty($email_address)){echo $email_address;}?>" required>
								</aside>
								<aside class="full-lenth">
									<label for="cname">Company Name:</label>
									<input type="text" id="cname" name="company_name"  value="<?php if(!empty($company_name)){echo $company_name;}?>" required>
								</aside>
								
								<aside class="full-power">
									<input type="hidden" name="user_id" value="<?php if(!empty($user_id)){echo $user_id;}?>" >
									<input type="submit" value="Update Information">
									<a href="#" class="update_password">Update my password</a>
								</aside>
								<div id="own-msg"></div>
							</form>
						</div>
					</div>
					<div class="updatepassword form-area">
						<form id="update_password"> 
							<aside class="full-lenth">
								<label>Password:</label>
								<input type="password" placeholder="" id="password" name="password">
							</aside>
							<aside class="full-lenth">
								<label>Confirm Password:</label>
								<input type="password" placeholder="" id="confirm_password" name="confirm_password">
							</aside>
							<aside class="full-lenth">
								<input type="submit" value="Update Password">
							</aside>
						</form>
						<div id="own-msg"></div>
					</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
	
	<!--  welcome-sec -->
	<section class="welcome-sec">
	   <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="purchase">
						<ul>
						   <li><a href="#" class="do_not_action_update"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update my email preferences</a>
						   <span class="checkbox_update_email">
								<label for="would_like_actions"><input type="checkbox" checked name="" id="would_like_actions">I would like to receive Owner Actions' newsletters with free tools, small business news, and updates</label>
								<label for="would_like_motivational"><input type="checkbox" checked name="" id="would_like_motivational">I would like to receive tips, how-to's, and motivational emails from Owner Actions</label>
						   </span>
						   </li>
						   <li><a href="#" class="delete_my_account"><i class="fa fa-trash" aria-hidden="true"></i> Delete my account</a></li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</section>
<?php }else {
	?>
	<script>
	var  home_url = '<?php echo home_url();?>';
	window.location.href = home_url;
	</script>
	<?php
} ?>