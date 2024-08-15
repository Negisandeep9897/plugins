<?php 
	if ( is_user_logged_in()){
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$role = $current_user->roles;

		$user_portal = get_user_meta($user_id, 'business_portal', true);

		if($user_portal != true){
			echo '<script>window.location.href = "/signup";</script>';
		}else{
			$checkfortype = get_user_meta($user_id, 'step_main', true);
			$checkstep2 = get_user_meta($user_id, 'step_1', true);
			$checkstep3 = get_user_meta($user_id, 'step_3', true);
			$selectIDS = array();
			if($checkfortype == 'manage_grow'){
				include_once('portal-steps/step2.php');
			}else if($checkfortype == 'start' && $checkstep2 == 'startup'){
				include_once('portal-steps/step1and5.php');
			}else if($checkfortype == 'start' && $checkstep2 == 'buy'){
				include_once('portal-steps/step1and6.php');
			}else if($checkfortype == 'start' && $checkstep2 == 'franchise'){
				include_once('portal-steps/step1and7.php');
			}else if($checkfortype == 'start' && $checkstep2 == 'undecided'){
				include_once('portal-steps/step1and8.php');
			}else if($checkfortype == 'exit' && $checkstep3 == 'selling_business'){
				include_once('portal-steps/step3and18.php');
			}else if($checkfortype == 'exit' && $checkstep3 == 'closing_business'){
				include_once('portal-steps/step3and20.php');
			}else{
				include_once('portal-steps/step1and5.php');
			}
		}
	}else{
	?>
	<script>
		window.location.href = '<?php echo home_url();?>/login';
	</script>
<?php } ?>
