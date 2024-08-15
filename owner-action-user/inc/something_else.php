<?php
/* if ( is_user_logged_in() ) { 
	$current_user = wp_get_current_user();
	
    $user_id = $current_user->ID;
    $user_data = get_user_meta($user_id); */

?>
	<!--  welcome-sec -->
	<section class="welcome-sec">
	   <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="update-text">
						<h1>Something Else</h1>					
					</div>
					<div class="purchase form-area">
						<div class="form-part">
							<form id="update_somethingelse"> 
								<aside class="full-lenth">
									<label>Your Subject:</label>
									<input type="text" placeholder="" name="your_subject"  value="" required>
								</aside>
								<aside class="full-lenth">
									<label>Your Message:</label>
									<textarea name="your_message" required></textarea>
								</aside>
								<aside class="full-power">
									<input type="submit" value="Submit">
								</aside>
								<div id="own-msg"></div>
							</form>
						</div>
					</div>
					
					</div>
				</div>	
			</div>
		</div>
	</section>