<?php 
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

$user_data = get_user_meta($user_id);
$user_portal = get_user_meta($user_id, 'business_portal', true);
if(!empty($user_portal)){
	echo '<script>window.location.href = "/portal-checklist";</script>';
}else{
	//echo 'user not question.';
}

?>
<style>h1.elementor-heading-title.elementor-size-default{display:none}</style>
<form role="form" id="slider_portal_form">
	<div id="loadingDiv">
		<img class="loader" src="<?php echo home_url();?>/wp-content/plugins/owner-action-user/assets/images/loading_img.gif">
	</div>
	<div class="slider_portal">	
		<section class="welcome-sec get-started-sec" id="welcome_portal_1">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="oppnity-text portal-text">
							<h1>Welcome to your owner’s portal.</h1>
							<p>Here, you'll find a customized checklist of the actions you need to take to help your new or existing business thrive.</p>
							<p style="color:#000">Already have an account? <a href="<?php echo home_url();?>/customer-login/">Login here.</a> </p>							
						</div>
						<div class="purchase about-two your-new">
							<h6>Let’s get started.</h6>
							<p>This should only take about two minutes.</p>
							<label>What is your name?</label>
							<div class="hlf-area">
								<div class="first_hlf">
									<label for="first_name">First name </label>
									<input type="text" name="your_name" required id="first_name">
								</div>
								<div class="first_hlf">
									<label for="last_name">Last name </label>
									<input type="text" name="your_name_last" id="last_name">
								</div>
							</div>
							<button class="thanks-next-lets" type="button" thanksval="">Next</button>
						</div>
					</div>	
				</div>
			</div> 
		</section>
		<?php
		// main step
		include_once('questions/step-main.php');
		
		// step 1
		include_once('questions/step-one.php');
		include_once('questions/start.php');
		include_once('questions/buy.php');
		include_once('questions/franchise.php');
		include_once('questions/undecided.php');
		
		// step 2
		include_once('questions/manage.php');
		
		// step 3
		include_once('questions/step-three.php');
		include_once('questions/sell.php');
		include_once('questions/close.php');
		
		// if check step
		include_once('questions/retail-next-screen.php');
		//include_once('questions/sourced-business-sell.php');
		
		// subnmit step
		include_once('questions/email-pass-setup.php');
		?>
	</div>
</form>