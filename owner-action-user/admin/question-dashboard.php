<h2>Question Portal</h2>
<div class="question_portal">
	<table class="wp-list-table widefat fixed striped table-view-list users">
		<thead>
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Business Type</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody id="the-list" data-wp-lists="list:user">
			<?php 
			$args = array(
				'role'       => 'subscriber',
				'orderby'    => 'ID',
				'order'      => 'DESC',
			);
			$get_users = get_users( $args );
				if(!empty($get_users)){ 
					foreach($get_users as $users){
						if($users->roles[0] == 'subscriber'){
							$users_id = $users->ID;
							$your_name = get_user_meta($users_id, 'your_name', true);
							$email = get_user_meta($users_id, 'username', true);
							$business_portal = get_user_meta($users_id, 'business_portal', true);
							
							$step_main = get_user_meta($users_id, 'step_main', true);
							$step_3 = get_user_meta($users_id, 'step_3', true);
							
							if($step_main == 'start'){
								$step_main_name = 'Start my business';
								if($business_portal == 'startup'){
									$business_portal_name = 'I am planning to start a business';
								}else if($business_portal == 'buy'){
									$business_portal_name = 'I am planning to buy a business or an existing franchise operation';
								}else if($business_portal == 'franchise'){
									$business_portal_name = 'I am planning to open a franchise unit';
								}else if($business_portal == 'undecided'){
									$business_portal_name = 'I would like to become a business owner, but I haven’t decided on my path yet';
								}else{
									$business_portal_name = '';
								}
							}else if($step_main == 'manage_grow'){
								$step_main_name = 'Manage and grow my business';
								$business_portal_name = 'Manage';
							}else if($step_main == 'exit'){
								$step_main_name = 'Exit my business';
								if($business_portal == 'selling_business'){
									$business_portal_name = 'I am planning to sell my business';
								}else if($business_portal == 'closing_business'){
									$business_portal_name = 'I need to close my business';
								}else{
									$business_portal_name = '';
								}
							}else{
								$step_main_name = '';
							}
							?>
							<?php if(!empty($your_name)):?>
								<tr id="user-<?php echo $users_id;?>">
									<td><?php if(!empty($your_name)){ echo $your_name;}?></td>
									<td><?php if(!empty($email)){ echo $email;}?></td>
									<td><?php echo '<strong>'.$step_main_name .'</strong> - '. $business_portal_name; ?></td>
									<td><a href="admin.php?page=view-edit-questions&user_id=<?php echo $users_id;?>">View</a>  |   <a href="#" class="del" user_id="<?php echo $users_id;?>">Delete</a></td>
								</tr>
							<?php endif;?>
				<?php	}
					}
				} ?>
		</tbody>
	</table>
</div>