<?php
/**
	 * Plugin Name:	 Owner Action User Register
	 * Plugin URI:      
	 * Description:	 Owner Actions is your complete resource for every stage of your business.
	 * Version:   1.0.0
	 * Author:   Owner Action
	 * Author URI:        
	 * License: GPL-1.0+
	 * License URI:       
	 * Text Domain: owner-action-user
	 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define( 'ownther_path', plugin_dir_path( dirname( __FILE__ ) ) );

if (!class_exists('OwnerActionUser')) {
	class OwnerActionUser{
		const OwnerActionUser = '1.0.0';
		private static $notices = array();
		private static $instance;

		public static function get_instance() {
			if( null == self::$instance ) {
				self::$instance = new OwnerActionUser();
				} 
			return self::$instance;
		}

		private function __construct () {
			add_action( 'admin_notices', array( $this, 'owneraction_admin_notices' ) );
			add_action( 'wp_enqueue_scripts', array($this, 'owneraction_load_css_js'));
			add_action( 'admin_enqueue_scripts', array($this, 'owneraction_admin_load_css'));
			
			add_shortcode('UPDATEPAGE', array($this, 'owner_update_page_shortcode'));
			add_shortcode('WELCOMEPORTAL', array($this, 'owner_welcomepage_shortcode'));
			add_shortcode('SOMETHINGELSE', array($this, 'owner_something_else_shortcode'));
			add_shortcode('ownerlogin', array($this, 'owner_login_shortcode'));
			add_shortcode('dashboard', array($this, 'owner_login_dashboard_shortcode'));
			
			add_action('wp_ajax_owner_login_ajax_action', array($this,'owner_login_ajax_action'));
			add_action('wp_ajax_nopriv_owner_login_ajax_action', array($this,'owner_login_ajax_action'));
			
/* 			add_action('wp_ajax_email_check_ajax_action', array($this,'email_check_ajax_action'));
			add_action('wp_ajax_nopriv_email_check_ajax_action', array($this,'email_check_ajax_action')); */
			
			add_action('wp_ajax_update_user_question_data', array($this,'update_user_question_data'));
			add_action('wp_ajax_nopriv_update_user_question_data', array($this,'update_user_question_data'));
			
			add_action('wp_ajax_do_not_action_update', array($this,'do_not_action_update'));
			add_action('wp_ajax_nopriv_do_not_action_update', array($this,'do_not_action_update'));
			
			add_action('wp_ajax_do_not_send_leads', array($this,'do_not_send_leads'));
			add_action('wp_ajax_nopriv_do_not_send_leads', array($this,'do_not_send_leads'));
			
			add_action('wp_ajax_do_not_send_leads', array($this,'do_not_send_leads'));
			add_action('wp_ajax_nopriv_do_not_send_leads', array($this,'do_not_send_leads'));
			
			add_action('wp_ajax_delete_my_account', array($this,'delete_my_account'));
			add_action('wp_ajax_nopriv_delete_my_account', array($this,'delete_my_account'));
			
			add_action('wp_ajax_update_password_ajax', array($this,'update_password_ajax'));
			add_action('wp_ajax_nopriv_update_password_ajax', array($this,'update_password_ajax'));
			
			add_action('wp_ajax_slider_portal_undecided_form_action', array($this,'slider_portal_undecided_form_action'));
			add_action('wp_ajax_nopriv_slider_portal_undecided_form_action', array($this,'slider_portal_undecided_form_action'));
			
			add_action('wp_ajax_slider_portal_start_form_action', array($this,'slider_portal_start_form_action'));
			add_action('wp_ajax_nopriv_slider_portal_start_form_action', array($this,'slider_portal_start_form_action'));
			
			add_action('wp_ajax_update_somethingelse_ajax', array($this,'update_somethingelse_ajax_action'));
			add_action('wp_ajax_nopriv_update_somethingelse_ajax', array($this,'update_somethingelse_ajax_action'));
			
			add_action('wp_ajax_dashboard_user_completed', array($this,'dashboard_user_completed_function'));
			add_action('wp_ajax_nopriv_dashboard_user_completed', array($this,'dashboard_user_completed_function'));
			
			add_action('wp_ajax_dashboard_user_due_date_saved_function', array($this,'dashboard_user_due_date_saved_function'));
			add_action('wp_ajax_nopriv_dashboard_user_due_date_saved_function', array($this,'dashboard_user_due_date_saved_function'));
			
			add_action('wp_ajax_dashboard_user_completed_unchecked', array($this,'dashboard_user_completed_unchecked_function'));
			add_action('wp_ajax_nopriv_dashboard_user_completed_unchecked', array($this,'dashboard_user_completed_unchecked_function'));

			add_action('wp_ajax_notes_add_ajax', array($this,'notes_add_ajax_function'));
			add_action('wp_ajax_nopriv_notes_add_ajax', array($this,'notes_add_ajax_function'));
			
			add_action('wp_ajax_notes_edit_ajax', array($this,'notes_edit_ajax_function'));
			add_action('wp_ajax_nopriv_notes_edit_ajax', array($this,'notes_edit_ajax_function'));
			
			add_action('wp_ajax_notes_remove_ajax', array($this,'notes_remove_ajax_function'));
			add_action('wp_ajax_nopriv_notes_remove_ajax', array($this,'notes_remove_ajax_function'));
			
			add_action('wp_ajax_orders_update_action', array($this,'orders_update_action_function'));
			add_action('wp_ajax_nopriv_orders_update_action', array($this,'orders_update_action_function'));
			
			add_action('wp_ajax_questions_users_del', array($this,'questions_users_del_funct'));
			add_action('wp_ajax_nopriv_questions_users_del', array($this,'questions_users_del_funct'));
			
			add_action('admin_menu', array($this,'question_custom_menu_page'));
			add_action( 'init', array($this,'create_question_post_type')); 
			
			add_action( 'wp_head', array($this,'after_body_open_tag_loading'));
			add_action('admin_menu', array($this,'add_order_cpt_submenu'));
			
			add_action('add_meta_boxes', array($this,'question_article_menu_func'));
			add_action('save_post', array($this,'save_articls_custom_meta_box'));
			
			add_action( 'template_redirect', array($this, 'question_post_type_remove'));
			
			//add_action('after_setup_theme', array($this, 'remove_admin_bar_subscriber'));
			
			add_filter('wp_headers', array($this, 'just_add_cors_http_header'));
		}
		
		function remove_admin_bar_subscriber(){
			if (!current_user_can('administrator') && !is_admin()) {
				  show_admin_bar(false);
			}
		}
		
		public function owneraction_admin_notices() {
			if ( !empty( self::$notices ) ) {
				foreach ( self::$notices as $notice ) {
					echo $notice;
				} 
			}
		} 
		
		function owneraction_load_css_js(){
			if(is_page('login') || is_page('dashboard') ||  is_page('portal-checklist') ||  is_page('signup') ||  is_page('purchased-leads') ||  is_page('update') ||  is_page('something-else')){
				wp_enqueue_style( 'owneraction-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
				wp_enqueue_style( 'owneraction-slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
				wp_enqueue_style( 'owneraction-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
				wp_enqueue_style( 'owneraction-jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
				wp_enqueue_style( 'owneraction-owner-portal', plugins_url( 'assets/css/owner_portal.css?no='. microtime(), __FILE__ ), array());
				wp_enqueue_style( 'owneraction-main-style', plugins_url( 'assets/css/main.css?no='. microtime(), __FILE__ ), array());
				
				wp_enqueue_style( 'owneraction-style', plugins_url( 'assets/css/style.css?no='. microtime(), __FILE__ ), array());
				wp_enqueue_style( 'owneraction-responsive', plugins_url( 'assets/css/responsive.css?no='. microtime(), __FILE__ ), array());	

				wp_enqueue_script( 'owneraction-jquery-ajax-js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); 
				wp_enqueue_script( 'owneraction-jquery-validate-js', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js');
				wp_enqueue_script( 'owneraction-jquery-slick-js', plugins_url( 'assets/js/slick.js', __FILE__ ), array());
				wp_enqueue_script( 'owneraction-custom-js', plugins_url( 'assets/js/custom.js?nocache='.microtime(), __FILE__ ), array());
				wp_localize_script( 'owneraction-custom-js', 'ajax_owneraction_object', array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'home_url' => home_url()) );
				wp_localize_script( 'owneraction-dashboard-js', 'ajax_owneraction_object', array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'home_url' => home_url()) );
				wp_dequeue_style( 'twentytwenty-style-css' );
			}
			if(is_page('portal-checklist')){
				wp_enqueue_script( 'owneraction-dashboard-js', plugins_url( 'assets/js/dashboard.js?nocache='.microtime(), __FILE__ ), array());
			}
		}
		function owneraction_admin_load_css(){
			wp_enqueue_style( 'owneraction-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
			wp_enqueue_style( 'owneraction-admin-style', plugins_url( 'assets/css/admin-style.css?no='. microtime(), __FILE__ ), array());
			
			wp_enqueue_script( 'owneraction-admin_orders-js', plugins_url( 'assets/js/admin_orders.js?nocache='.microtime(), __FILE__ ), array());
			wp_localize_script( 'owneraction-admin_orders-js', 'ajax_owneraction_object', array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'home_url' => home_url()) );
		}
		// admin dashboard
		function question_custom_menu_page() {
			add_menu_page('Questions menu title', 'Questions Menu', 'add_users', 'view-questions', array($this, '_question_menu_page'), null, 8);
			add_submenu_page('view-questions', 'Questions Add Menu', 'Questions Menu', 'add_users', 'view-edit-questions', array($this, '_question_sub_menu_page'), null, 8);
		}
		function _question_menu_page(){ 
		   include_once('admin/question-dashboard.php');
		}
		function _question_sub_menu_page(){ 
		   include_once('admin/edit-user.php');
		}
		function create_question_post_type(){
			register_post_type( 'questions',
				array(
					'labels' => array(
						'name' => __( 'Action' ),
						'singular_name' => __( 'Action' )
					),
					'public' => false,
					'publicly_queryable' => true, 
					'show_ui' => true,
					'exclude_from_search' => true,
					'show_in_nav_menus' => false,
					'has_archive' => false,
					'rewrite' => false,
					'menu_icon'  => 'dashicons-list-view',
				)
			);
			register_taxonomy(
				'headers', 
				'questions',
				array(
					'hierarchical' => true,
					'label' => 'Headers',
					'query_var' => true,
					'rewrite' => array(
						'slug' => 'headers',
						'with_front' => false
					)
				)
			);
			register_taxonomy(
				'question', 
				'questions',
				array(
					'hierarchical' => true,
					'label' => 'Question',
					'query_var' => true,
					'rewrite' => array(
						'slug' => 'question',
						'with_front' => false
					)
				)
			);
			register_taxonomy(
				'selection', 
				'questions',
				array(
					'hierarchical' => true,
					'label' => 'Selection',
					'query_var' => true,
					'rewrite' => array(
						'slug' => 'selection',
						'with_front' => false
					)
				)
			);
			register_post_type( 'task_helper',
				array(
					'labels' => array(
						'name' => __( 'Task Helper' ),
						'singular_name' => __( 'Task Helper' )
					),
					'public' => false,
					'publicly_queryable' => true, 
					'show_ui' => true,
					'exclude_from_search' => true,
					'show_in_nav_menus' => false,
					'rewrite' => false,
					'has_archive' => false,
					'supports' => array('title', 'editor', 'thumbnail'),
					'menu_icon'  => 'dashicons-editor-help',
				)
			);
			register_post_type( 'notes',
				array(
					'labels' => array(
						'name' => __( 'Notes' ),
						'singular_name' => __( 'Note' )
					),
					'public' => true,
					'has_archive' => true,
					'rewrite' => array('slug' => 'notes'),
					'show_in_rest' => false,
					'menu_icon'  => 'dashicons-welcome-write-blog',
				)
			);
			
		}
		
		// owner_login_shortcode
		function owner_login_shortcode(){
			include_once('inc/login.php');
		}
		
		// owner_login_dashboard_shortcode
		function owner_login_dashboard_shortcode(){
			include_once('inc/dashboard.php');
		}
		
		function email_check_ajax_action(){
			if(!empty($_POST['email'])){
				if(email_exists($_POST['email'])){
					$result['error'] ='Email account already exist!';
				}else{
					$result['ok'] ='Go ahead.';
				}
			}
			echo json_encode($result);
			wp_die();
		}

		// owner_login_ajax_action
		function owner_login_ajax_action(){
			if(empty($_POST) || wp_verify_nonce($_POST['login_security_action'],'login_security') === false ) {
				echo json_encode('Not Found');
				exit;
			}else{
				$info = array();
				$info['user_login'] = sanitize_user($_POST['login_email']);
				$info['user_password'] = esc_attr($_POST['login_password']);
				$info['remember'] = true;
				if(!empty($_POST['dashboard'])){
					$dashboard = $_POST['dashboard'];
				}else{
					$dashboard = '';
				}

				$user_signon = wp_signon( $info, false );
				if ( is_wp_error($user_signon) ){
					echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
				} else {
					echo json_encode(array('loggedin'=>true, 'dashboard'=> $dashboard, 'message'=>__('Login successful, redirecting...')));
				}
				wp_die();
			} 
		}
		
		// owner_update_page_shortcode
		function owner_update_page_shortcode(){
			include_once('inc/update.php');
		}
		
		// owner_welcome_portal_shortcode
		function owner_welcomepage_shortcode(){
			include_once('inc/welcome_portal.php');
		}
		// owner_welcome_portal_shortcode
		function owner_something_else_shortcode(){
			include_once('inc/something_else.php');
		}
		
		//update_user_question_data
		function update_user_question_data(){
			$data = $_POST;
			$result= array();
			foreach($data as $key => $val){
				if(!empty($val)){
					$update_data = update_user_meta( $data['user_id'], $key, $val);
					if($update_data){
						$result['msg'] ='User data updated!';
					}
				}
			}
			echo json_encode($result);
			wp_die();
		}
		
		//do_not_action_update
		function do_not_action_update(){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$do_not_update = update_user_meta($user_id, 'do_not_update', 'yes');
			$to = 'unsubscribe@owneractions.com';
			$subject = 'Unsubscribe request from OwnerAction User '.$user_id;
			$body = $user_id.'  Requested to unsubscribe';
			$headers = array('Content-Type: text/html; charset=UTF-8');
 			wp_mail( $to, $subject, $body, $headers );
			$result= array();
			$result['msg'] ='User data updated!';
			echo json_encode($result);
			wp_die();
		}
		
		//do_not_action_update_leads
		function do_not_send_leads(){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$do_not_send_leads = update_user_meta($user_id, 'do_not_send_leads', true);
			if($do_not_send_leads){
				echo 'do_not_send_leads';
			}
		}
		
		//delete_my_account
		function delete_my_account(){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$delete_my_account = wp_delete_user($user_id);
			if($delete_my_account){
				echo json_encode('Account deleted');
			}
			wp_die();
		}
		
		//update_password_ajax
		function update_password_ajax(){
			$current_user = wp_get_current_user();
			$user_login = $current_user->user_login;
			$user_id = $current_user->ID;
			$wp_set_password = wp_set_password($_POST['password'], $user_id);
			if(!is_wp_error($wp_set_password)){
				wp_signon(array('user_login' => $user_login, 'user_password' => $_POST['password']));
				echo json_encode(array('loggedin'=>true, 'message'=>__('Password changed.')));
			}else{
				echo json_encode(array('loggedin'=>false, 'message'=>__('Password not changed.')));
			}
			wp_die();
		}
		
		//update_something else_ajax_action
		function update_somethingelse_ajax_action(){
			$current_user = wp_get_current_user();
			$user_login = $current_user->user_login;
			$user_id = $current_user->ID;
			$some_data = $_POST;
			if(!empty($some_data)){
				foreach($some_data as $key => $somval ){
					update_user_meta( $user_id, $key, $somval);
					$result['succes'] = 'Updated !';
				}
			}
			echo json_encode($result);
			wp_die();
		}
		
		// new user register
		function slider_portal_start_form_action(){
			$data = $_POST;
			$result = array();

			if(is_user_logged_in()){
				$current_user = wp_get_current_user();
				$user_roles = $current_user->roles;
				$userid = $current_user->ID;
				$wp_user_object = new WP_User($current_user->ID);
				if($user_roles[0] === 'customer'){
					$wp_user_object->set_role('subscriber');
				}
				foreach($data as $key=>$val){
					if(!empty($val)):
						update_user_meta( $userid, $key, $val);
					endif;
				}
				$result['type'] ='success';
				$result['msg'] ='Account Created Successfully';
			}else{
				$email = stripcslashes($data['username']);
				$pass = $data['user_pass'];
				$user_data = array(
				  'user_login' => $email,
				  'user_email' => $email,
				  'user_pass' => $pass,
				);
				$user_id = wp_insert_user($user_data);
				if(!is_wp_error($user_id)){
					foreach($data as $key=>$val){
						if(!empty($val)):
							update_user_meta( $user_id, $key, $val);
						endif;
					}
					$result['type'] ='success';
					$result['msg'] ='Account Created Successfully';
					wp_set_current_user ( $user_id ); 
					wp_set_auth_cookie  ( $user_id );
				}else {
					if (isset($user_id->errors['empty_user_login'])) {
						$result['type'] ='error';
						$result['msg'] ='Username/Email never Empty?';
					} elseif (isset($user_id->errors['existing_user_login'])) {
						$result['type'] ='error';
						$result['msg'] ='This email is already used, Please use some other email.';
					} else {
						$result['type'] ='error';
						$result['msg'] ='Error Occured please fill up the sign up form carefully.';
					}
				}
			}
			
			// wp remote post
			//$endpoint = 'https://flow.zoho.com/757271889/flow/webhook/incoming?zapikey=1001.b7d57e0aa485dfcec946162ae1a9a893.d845020ee6a3286c45f5628de8511a71&isdebug=false';
			$endpoint = 'https://flow.zoho.com/757271889/flow/webhook/incoming?zapikey=1001.6851ae57822a38120e51b157734e6814.f581a4b3c9fcb4636356ec14bba7a3f2&isdebug=false';
			$body = wp_json_encode( $data );

			$options = [
				'body'        => $body,
				'headers'     => [
					'Content-Type' => 'application/json',
				],
				'timeout'     => 60,
				'redirection' => 5,
				'blocking'    => true,
				'httpversion' => '1.0',
				'sslverify'   => false,
				'data_format' => 'body',
			];

			wp_remote_post( $endpoint, $options );			
			// end wp remote post
			echo json_encode($result);
			wp_die();
		}
		
		// new user undecided register
		function slider_portal_undecided_form_action(){
			$data = $_POST;
			$email = stripcslashes($data['username_undecided']);
			$pass = $data['user_pass_undecided'];
			$user_data = array(
			  'user_login' => $email,
			  'user_email' => $email,
			  'user_pass' => $pass,
			);
			$user_id = wp_insert_user($user_data);
			if(!is_wp_error($user_id)){
				foreach($data as $key=>$val){
					if(!empty($val)):
						update_user_meta( $user_id, $key, $val);
					endif;
				}
				$result['type'] ='success';
				$result['msg'] ='Account Created Successfully';
				wp_set_current_user ( $user_id ); 
				wp_set_auth_cookie  ( $user_id );
			}else {
				if (isset($user_id->errors['empty_user_login'])) {
					$result['type'] ='error';
					$result['msg'] ='Username/Email never Empty?';
				} elseif (isset($user_id->errors['existing_user_login'])) {
					$result['type'] ='error';
					$result['msg'] ='This email is already used, Please use some other email.';
				} else {
					$result['type'] ='error';
					$result['msg'] ='Error Occured please fill up the sign up form carefully.';
				}
			}
			
			// wp remote post
			//$endpoint = 'https://flow.zoho.com/757271889/flow/webhook/incoming?zapikey=1001.b7d57e0aa485dfcec946162ae1a9a893.d845020ee6a3286c45f5628de8511a71&isdebug=false';
			$endpoint = 'https://flow.zoho.com/757271889/flow/webhook/incoming?zapikey=1001.6851ae57822a38120e51b157734e6814.f581a4b3c9fcb4636356ec14bba7a3f2&isdebug=false';
			$body = wp_json_encode( $data );

			$options = [
				'body'        => $body,
				'headers'     => [
					'Content-Type' => 'application/json',
				],
				'timeout'     => 60,
				'redirection' => 5,
				'blocking'    => true,
				'httpversion' => '1.0',
				'sslverify'   => false,
				'data_format' => 'body',
			];

			wp_remote_post( $endpoint, $options );			
			// end wp remote post
			echo json_encode($result);
			wp_die();
		}
		
		//dashboard_user_completed_function
		function dashboard_user_completed_function(){
			$post_id = $_POST['post_id'];
			$date = date('m-d-Y');
			$renewale_date = date('m-d-Y',strtotime(date("m-d-Y") . " + 365 day"));
			$total_progress = $_POST['total_progress'];
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			 if(!empty($post_id)){
				add_user_meta($user_id, 'completed_id_'.$post_id, $post_id);
				$get_total_progress = get_user_meta($user_id, 'total_progress', true);
				$total_progress_equal = $get_total_progress + $total_progress;
				update_user_meta($user_id, 'total_progress', $total_progress_equal);
				
				update_user_meta($user_id, $post_id.'_completed_date', $date);
				$_renewale_date = get_user_meta($user_id, $post_id.'_renewale_date', $renewale_date);
				if($_renewale_date == ''){
					update_user_meta($user_id, $post_id.'_renewale_date', $renewale_date);
				}
				$result['msg'] ='Completed';
			}else{
				$result['msg'] ='error';
			}
			echo json_encode($result);
			wp_die();
		}
		
		//dashboard_user_completed_function
		function dashboard_user_due_date_saved_function(){
			$post_id = $_POST['post_id'];
			$renewale_date = $_POST['date'];
			$newDate = date("m-d-Y", strtotime($renewale_date));
			$date = date('m-d-Y');
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			 if(!empty($post_id)){
				update_user_meta($user_id, $post_id.'_completed_date', $date);
				update_user_meta($user_id, $post_id.'_renewale_date', $newDate);
				$result['msg'] ='Date Completed';
			}else{
				$result['msg'] ='error';
			}
			echo json_encode($result);
			wp_die();
		}
		
		//dashboard_user_completed_unchecked_function
		function dashboard_user_completed_unchecked_function(){
			$post_id = $_POST['post_id'];
			$total_progress = $_POST['total_progress'];
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			if(!empty($post_id)){
				$completed_id = get_user_meta($user_id, 'completed_id_'.$post_id);
				if(in_array($post_id, $completed_id)){
					update_user_meta($user_id, 'completed_id_'.$post_id, ' ');
				}
				$get_total_progress = get_user_meta($user_id, 'total_progress', true);
				$total_progress_equal = $get_total_progress - 1;
				update_user_meta($user_id, 'total_progress', $total_progress_equal);
				$result['msg'] ='unchecked';
			}else{
				$result['msg'] ='error';
			}
			echo json_encode($result);
			wp_die();
		}
		
		//after_body_open_tag_loading
		function after_body_open_tag_loading(){
			echo '<div class="owner_loading"><div id="overlay"><div class="cv-spinner"><span class="spinner"></span></div></div></div>';
		}
		
		//notes_add_ajax
		function notes_add_ajax_function(){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			$args = array(
				'post_title' => $_POST['title'],
				'post_content' => $_POST['description'],
				'post_type' => 'notes',
				'post_status' => 'publish',
				'post_author' => $user_id,
			);
			$post_id = wp_insert_post($args);
			if(!empty($post_id)){
				$result['type'] = 'succes';
				$result['msg'] = 'Notes saved!';
			}else{
				$result['type'] = 'error';
				$result['msg'] ='Notes saved failed';
			}
			echo json_encode($result);
			wp_die();
		}
		
		//notes_edit_ajax
		function notes_edit_ajax_function(){
			$post_args = array(
				'ID' => esc_sql($_POST['post_id']),
				'post_content' => wp_kses_post($_POST['description']),
				'post_title' => wp_strip_all_tags($_POST['title'])
			);
			$post_update = wp_update_post($post_args);
			if(!empty($post_update)){
				$result['type'] = 'succes';
				$result['msg'] = 'Notes updated!';
			}else{
				$result['type'] = 'error';
				$result['msg'] ='Notes saved failed';
			}
			echo json_encode($result);
			wp_die();
		}
		
		//notes_remove_ajax
		function notes_remove_ajax_function(){
			$post_id = $_POST['post_id'];
			if($post_id){
				$post_update = wp_delete_post($post_id);
				if($post_update){
					$result['type'] = 'succes';
					$result['msg'] = 'Notes deleted!';
				}else{
					$result['type'] = 'error';
					$result['msg'] ='Notes delete failed';
				}
			}
			echo json_encode($result);
			wp_die();
		}
		
		function add_order_cpt_submenu(){
			add_submenu_page(
				 'edit.php?post_type=questions',
				 'Orders',
				 'Orders',
				 'manage_options',
				 'orders',
				 array($this, 'order_subpage_render_page')
			);
		}

		//add_submenu_page callback function
		function order_subpage_render_page() {
			include_once('admin/orders.php');
		}

		//orders_update_action_function
		function orders_update_action_function(){
			$order_data = $_POST;
			if(!empty($order_data)){
				foreach($order_data as $key => $data){
					$new_key = substr($key, strpos($key, "_") + 1); 
					$id = explode('_', $key);
					if(update_term_meta($id[0], $new_key, $data)){
						$result = 'Order Updated';
					}
				}
			}
			echo json_encode($result);
			wp_die();
		}

		//questions_users_del_funct
		function questions_users_del_funct(){
			$user_id = $_POST['user_id'];
			if(!empty($user_id)){
				$delete_my_account = wp_delete_user($user_id);
				if($delete_my_account){
					$result = 'User deleted successfully.';
				}
			}
			echo json_encode($result);
			wp_die();
		}
		
		function question_article_menu_func(){
		   add_meta_box(
			   'custom_meta_box-2',
			   'Select Articles', 
			   array($this, 'show_custom_meta_box_articles'),
			   'questions',
			   'side',
			   'high' 
		   );
		}
		function show_custom_meta_box_articles(){
			$post_args = array( 
			  'post_type' => 'post', 
			  'posts_per_page' => -1,
			);
			$post_questions = get_posts($post_args);
			$question_selelected_id = get_post_meta(get_the_ID(), 'question_articles');
			$id_s = array();
			foreach($question_selelected_id as $select_id){
				foreach($select_id as $ppost_id_s){
					$id_s[] = $ppost_id_s;
				}
			}
			?>
			<div class="question_articles_col">
				<?php 
				foreach($post_questions as $post_article){
					if(in_array($post_article->ID, $id_s)){?>
						<div class="full_question checked">
							<input type="checkbox" id="articles_<?php echo $post_article->ID;?>" name="question_articles[]" value="<?php echo $post_article->ID; ?>" checked>
							<label for="articles_<?php echo $post_article->ID;?>"><?php echo get_the_title($post_article->ID);?></label>
						</div>
					<?php }else{ ?> 
						<div class="full_question">
							<input type="checkbox" id="articles_<?php echo $post_article->ID;?>" name="question_articles[]" value="<?php echo $post_article->ID;?>">
							<label for="articles_<?php echo $post_article->ID;?>"><?php echo get_the_title($post_article->ID);?></label>
						</div>
					<?php }
				}
				?>
			</div>
			<?php  
		}
		function save_articls_custom_meta_box($post_id){
			global $post; 
			$question_articles = $_POST['question_articles'];
			if(!empty($question_articles)){  
				update_post_meta($post_id, 'question_articles',  $question_articles);
			}
		}
		
		function question_post_type_remove(){
			if ( is_singular( 'questions' ) ) {
				wp_redirect( home_url(), 301 );
				exit;
			}
		}

		function just_add_cors_http_header($headers){
			$headers['Access-Control-Allow-Origin'] = '*';
			return $headers;
		}
	}
}
add_action( 'plugins_loaded', array( 'OwnerActionUser', 'get_instance' ) );

function get_posts_negi($nid){
	$testing = array (
		'post_type' => 'questions',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy'  => 'headers',
				'field'     => 'term_id',
				'terms'     => $nid,
			)
		),
	);
	$postArray= array();
	$questions_c = new WP_Query($testing);	
	if($questions_c->have_posts()):
		while ( $questions_c->have_posts() ) : $questions_c->the_post();
			$pid = get_the_ID();
			$postArray[] = $pid;
		endwhile;	
	endif;
return $postArray;
}

function remove_admin_bar( $value ) {
return ( current_user_can( 'administrator' ) ) ? $value : false;
}
add_filter( 'show_admin_bar' , 'remove_admin_bar');

add_action('wp-head','hide_top_bar_owner');
function hide_top_bar_owner(){
	?>
	<style>#wpadminbar{display:none}</style>
	<?php
}
add_filter( 'logout_redirect', function() {
    return esc_url( home_url() );
} ); 

add_filter( 'body_class', function( $classes ) {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_portal = get_user_meta($user_id, 'business_portal', true);
	
	if(is_user_logged_in()){
    
		if ( in_array( 'customer', (array) $current_user->roles ) ||  in_array( 'subscriber', (array) $current_user->roles )) {
			if($user_portal != true){
				return array_merge( $classes, array( 'firstscreen_last_scrren' ) );
			}
		}
	}
	
} );
