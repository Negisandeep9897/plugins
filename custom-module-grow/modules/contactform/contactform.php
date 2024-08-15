<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class SignatureServicesModule
 */
class ContactFormModule extends FLBuilderModule {
	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Custom Contact Form', 'fl-builder' ),
			'description'     => __( 'A custom module can be use anywhere.', 'fl-builder' ),
			'category'        => __( 'Custom Module', 'fl-builder' ),
			'dir'             => __DIR__,
			'partial_refresh' => true,
			'url'             => plugins_url( '', __FILE__ ),
		));

		add_action( 'wp_ajax_nopriv_contact_form_action', array( $this, 'bb_custom_contact_form_ajax_function' ) );
		add_action( 'wp_ajax_contact_form_action', array( $this, 'bb_custom_contact_form_ajax_function' ) );

	}

	public function enqueue_scripts() {	

		wp_enqueue_style( 'johnnygrow-contact-custom-css', plugins_url( '', __FILE__ ) . '/assets/custom.css?cache='.microtime());
		wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		
	}

	//public function bb_custom_contact_form_ajax_function(){
	public static function bb_custom_contact_form_ajax_function( $params = array() ) {

		if(isset($_POST['email']) && !empty($_POST['email'])){

			$msg = array();
			$node_id          = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
			$template_id      = isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
			$template_node_id = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
			$admin_email      = get_option( 'admin_email' );
			$site_name        = get_option( 'blogname' );

			if ( $node_id ) {
				// Get the module settings.
				if ( $template_id ) {
					$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
					$data     = FLBuilderModel::get_layout_data( 'published', $post_id );
					$settings = $data[ $template_node_id ]->settings;
				} else {
					$module   = FLBuilderModel::get_module( $node_id );
					$settings = $module->settings;
				}

				if ( isset( $settings->mailto_email ) && ! empty( $settings->mailto_email ) ) {
					$mailto = $settings->mailto_email;
				}
			}

			if(isset($_POST['success_url']) && !empty($_POST['success_url'])){
				$msg['success_url'] = $_POST['success_url'];
			}

			if(isset($_POST['show_message']) && !empty($_POST['show_message'])){
				$msg['show_message'] = $_POST['show_message'];
			}

			$subject = $settings->email_subject;
			if ( '' !== $subject ) {

				if ( isset( $_POST['name'] ) ) {
					$subject = str_replace( '[NAME]', $_POST['name'], $subject );
				}
				if ( isset( $_POST['subject'] ) ) {
					$subject = str_replace( '[SUBJECT]', $_POST['subject'], $subject );
				}
				if ( isset( $_POST['email'] ) ) {
					$subject = str_replace( '[EMAIL]', $_POST['email'], $subject );
				}
				if ( isset( $_POST['phone'] ) ) {
					$subject = str_replace( '[PHONE]', $_POST['phone'], $subject );
				}
				if ( isset( $_POST['message'] ) ) {
					$subject = str_replace( '[MESSAGE]', $_POST['message'], $subject );
				}
			} else {
				$subject = __( 'Contact Form Submission', 'uabb' );
			}

			$uabb_contact_from_email = ( isset( $_POST['email'] ) ? $_POST['email'] : null );
			$uabb_contact_from_name  = ( isset( $_POST['name'] ) ? $_POST['name'] : null );

			$headers = array(
				'From: ' . $site_name . ' <' . $admin_email . '>',
				'Reply-To:' . $uabb_contact_from_name . ' <' . $uabb_contact_from_email . '>',
				'Content-Type: text/html; charset=UTF-8',
			);

			$template = $settings->email_template;
			if ( isset( $_POST['name'] ) ) {
				$template = str_replace( '[NAME]', $_POST['name'], $template );
			}
			if ( isset( $_POST['subject'] ) ) {
				$template = str_replace( '[SUBJECT]', $_POST['subject'], $template );
			}
			if ( isset( $_POST['email'] ) ) {
				$template = str_replace( '[EMAIL]', $_POST['email'], $template );
			}
			if ( isset( $_POST['phone'] ) ) {
				$template = str_replace( '[PHONE]', $_POST['phone'], $template );
			}
			if ( isset( $_POST['message'] ) ) {
				$template = str_replace( '[MESSAGE]', $_POST['message'], $template );
			}

			$template = wpautop( $template );
			$mail = wp_mail( $mailto, stripslashes( $subject ), do_shortcode( stripslashes( $template ) ), $headers );
			if($mail) {
				$msg['mailsent'] = 'mailsent';
			}
			wp_send_json_success( $msg );
		}
	    wp_die();
	}

}


/**
 * Register the module and its form settings.
 * We are using a very simple form here with only two options, photo_one and photo_two.
 */
FLBuilder::register_module( 'ContactFormModule', array(
	'general'   => array(
		'title'    => __( 'General', 'fl-builder' ),
		'sections' => array(
			'name_section'    => array(
				'title'  => __( 'Name Field', 'uabb' ),
				'fields' => array(
					'name_toggle'      => array(
						'type'    => 'select',
						'label'   => __( 'Name', 'uabb' ),
						'default' => 'show',
						'options' => array(
							'show' => __( 'Show', 'uabb' ),
							'hide' => __( 'Hide', 'uabb' ),
						),
						'toggle'  => array(
							'show' => array(
								'fields' => array( 'name_width', 'name_label', 'name_placeholder', 'name_required' ),
							),
						),
					),
					'name_placeholder' => array(
						'type'    => 'text',
						'label'   => __( 'Placeholder', 'uabb' ),
						'default' => __( 'Your Name', 'uabb' ),
						'preview' => array(
							'type'      => 'none',
							'important' => true,
						),
					),
					'name_required'    => array(
						'type'    => 'select',
						'label'   => __( 'Required', 'uabb' ),
						'help'    => __( 'Enable to make name field compulsary.', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => 'Yes',
							'no'  => 'No',
						),
					),
				),
			),
			'email_section'   => array(
				'title'  => __( 'Email Field', 'uabb' ),
				'fields' => array(
					'email_toggle'      => array(
						'type'    => 'select',
						'label'   => __( 'Email', 'uabb' ),
						'default' => 'show',
						'options' => array(
							'show' => __( 'Show', 'uabb' ),
							'hide' => __( 'Hide', 'uabb' ),
						),
						'toggle'  => array(
							'show' => array(
								'fields' => array( 'email_width', 'email_label', 'email_placeholder', 'email_required' ),
							),
						),
					),
					'enforce_business_email'      => array(
						'type'    => 'select',
						'label'   => __( 'Enforce Business Email', 'uabb' ),
						'default' => 'yes',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no' => __( 'No', 'uabb' ),
						),
					),
					'email_validation'      => array(
						'type'    => 'text',
						'label'   => __( 'Enforce email valid text', 'uabb' ),
						'default' => 'Please enter a valid Business Email',
					),
					'email_width'       => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'uabb' ),
						'default' => '100',
						'options' => array(
							'100' => __( '100%', 'uabb' ),
							'50'  => __( '50%', 'uabb' ),
						),
					),
					'email_placeholder' => array(
						'type'    => 'text',
						'label'   => __( 'Placeholder', 'uabb' ),
						'default' => __( 'Your Email', 'uabb' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'email_required'    => array(
						'type'    => 'select',
						'label'   => __( 'Required', 'uabb' ),
						'help'    => __( 'Enable to make email field compulsary.', 'uabb' ),
						'default' => 'yes',
						'options' => array(
							'yes' => 'Yes',
							'no'  => 'No',
						),
					),
				),
			),
			'subject_section' => array(
				'title'  => __( 'Subject Field', 'uabb' ),
				'fields' => array(
					'subject_toggle'      => array(
						'type'    => 'select',
						'label'   => __( 'Subject', 'uabb' ),
						'default' => 'show',
						'options' => array(
							'show' => __( 'Show', 'uabb' ),
							'hide' => __( 'Hide', 'uabb' ),
						),
						'toggle'  => array(
							'show' => array(
								'fields' => array( 'subject_width', 'subject_label', 'subject_placeholder', 'subject_required' ),
							),
						),
					),
					'subject_placeholder' => array(
						'type'    => 'text',
						'label'   => __( 'Placeholder', 'uabb' ),
						'default' => __( 'Subject', 'uabb' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
			'phone_section'   => array(
				'title'  => __( 'Phone Field', 'uabb' ),
				'fields' => array(
					'phone_toggle'      => array(
						'type'    => 'select',
						'label'   => __( 'Phone', 'uabb' ),
						'default' => 'hide',
						'options' => array(
							'show' => __( 'Show', 'uabb' ),
							'hide' => __( 'Hide', 'uabb' ),
						),
						'toggle'  => array(
							'show' => array(
								'fields' => array( 'phone_width', 'phone_label', 'phone_placeholder', 'phone_required' ),
							),
						),
					),
					'phone_placeholder' => array(
						'type'    => 'text',
						'label'   => __( 'Placeholder', 'uabb' ),
						'default' => __( 'Phone', 'uabb' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'phone_required'    => array(
						'type'    => 'select',
						'label'   => __( 'Required', 'uabb' ),
						'help'    => __( 'Enable to make phone field compulsary.', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => 'Yes',
							'no'  => 'No',
						),
					),
				),
			),
			'msg_section'     => array(
				'title'  => __( 'Message Field', 'uabb' ),
				'fields' => array(
					'msg_toggle'      => array(
						'type'    => 'select',
						'label'   => __( 'Message', 'uabb' ),
						'default' => 'show',
						'options' => array(
							'show' => __( 'Show', 'uabb' ),
							'hide' => __( 'Hide', 'uabb' ),
						),
						'toggle'  => array(
							'show' => array(
								'fields' => array( 'msg_width', 'msg_height', 'msg_label', 'msg_placeholder', 'msg_required', 'textarea_top_margin', 'textarea_bottom_margin' ),
							),
						),
					),
					'msg_placeholder' => array(
						'type'    => 'text',
						'label'   => __( 'Placeholder', 'uabb' ),
						'default' => __( 'Your Message', 'uabb' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
			'success' => array(
				'title'  => __( 'Success', 'fl-builder' ),
				'fields' => array(
					'success_action'  => array(
						'type'    => 'select',
						'label'   => __( 'Success Action', 'fl-builder' ),
						'options' => array(
							'none'         => __( 'None', 'fl-builder' ),
							'show_message' => __( 'Show Message', 'fl-builder' ),
							'redirect'     => __( 'Redirect', 'fl-builder' ),
						),
						'toggle'  => array(
							'show_message' => array(
								'fields' => array( 'success_message' ),
							),
							'redirect'     => array(
								'fields' => array( 'success_url' ),
							),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'success_message' => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for your message! We’ll be in touch soon.', 'fl-builder' ),
						'preview'       => array(
							'type' => 'none',
						),
						'connections'   => array( 'string' ),
					),
					'success_url'     => array(
						'type'        => 'link',
						'label'       => __( 'Success URL', 'fl-builder' ),
						'preview'     => array(
							'type' => 'none',
						),
						'connections' => array( 'url' ),
					),
				),
			),
		),
	),
	

	'button'     => array(
		'title'    => __( 'Button', 'uabb' ),
		'sections' => array(
			'button-style'  => array(
				'title'  => __( 'Submit Button', 'uabb' ),
				'fields' => array(
					'btn_text'            => array(
						'type'    => 'text',
						'label'   => __( 'Text', 'uabb' ),
						'default' => 'SEND YOUR MESSAGE',
						'preview' => array(
							'type'      => 'text',
							'selector'  => '.uabb-contact-form-submit span',
							'important' => true,
						),
					),

					'btn_icon'            => array(
						'type'        => 'icon',
						'label'       => __( 'Icon', 'uabb' ),
						'show_remove' => true,
					),

					'btn_icon_color'      => array(
						'type'        => 'color',
						'label'       => __( 'Icon Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'connections' => array( 'color' ),
						'show_alpha'  => true,
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.uabb-contact-form-button .uabb-contact-form-submit .uabb-contact-form-submit-button-icon',
							'property' => 'color',
						),
					),

					'btn_icon_position'   => array(
						'type'    => 'select',
						'label'   => __( 'Icon Position', 'uabb' ),
						'default' => 'before',
						'options' => array(
							'before' => __( 'Before Text', 'uabb' ),
							'after'  => __( 'After Text', 'uabb' ),
						),
					),
					'btn_processing_text' => array(
						'type'    => 'text',
						'label'   => __( 'Processing Text', 'uabb' ),
						'default' => 'Please Wait...',
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),

			'btn-style'     => array(
				'title'  => __( 'Button Style', 'uabb' ),
				'fields' => array(
					'btn_style'        => array(
						'type'    => 'select',
						'label'   => __( 'Style', 'uabb' ),
						'default' => 'default',
						'options' => array(
							'default'     => __( 'Default', 'uabb' ),
							'flat'        => __( 'Flat', 'uabb' ),
							'transparent' => __( 'Transparent', 'uabb' ),
							'gradient'    => __( 'Gradient', 'uabb' ),
							'3d'          => __( '3D', 'uabb' ),
						),

						'toggle'  => array(
							'transparent' => array(
								'fields' => array( 'btn_border_width', 'hover_attribute', 'btn_radius' ),
							),
							'flat'        => array(
								'fields' => array( 'btn_radius' ),
							),
							'3d'          => array(
								'fields' => array( 'btn_radius' ),
							),
							'gradient'    => array(
								'fields' => array( 'btn_radius' ),
							),
							'default'     => array(
								'fields' => array( 'button_border', 'border_hover_color' ),
							),
						),
					),

					'btn_border_width' => array(
						'type'   => 'unit',
						'label'  => __( 'Border Width', 'uabb' ),
						'slider' => true,
						'units'  => array( 'px' ),
					),
				),
			),

			'btn-colors'    => array(
				'title'  => __( 'Button Colors', 'uabb' ),
				'fields' => array(
					'btn_text_color'             => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.uabb-contact-form .uabb-contact-form-submit .uabb-contact-form-button-text',
							'property'  => 'color',
							'important' => true,
						),
					),

					'btn_text_hover_color'       => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Hover Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),

					'btn_background_color'       => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
							'property'  => 'background',
							'important' => true,
						),
					),

					'btn_background_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Hover Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),

					'hover_attribute'            => array(
						'type'    => 'select',
						'label'   => __( 'Apply Hover Color To', 'uabb' ),
						'default' => 'bg',
						'options' => array(
							'border' => __( 'Border', 'uabb' ),
							'bg'     => __( 'Background', 'uabb' ),
						),
						'width'   => '75px',
					),
				),
			),

			'btn-structure' => array(
				'title'  => __( 'Button Structure', 'uabb' ),
				'fields' => array(
					'btn_align'              => array(
						'type'    => 'select',
						'label'   => __( 'Button Width/Alignment', 'uabb' ),
						'default' => 'left',
						'options' => array(
							'full'   => __( 'Full', 'uabb' ),
							'left'   => __( 'Left', 'uabb' ),
							'center' => __( 'Center', 'uabb' ),
							'right'  => __( 'Right', 'uabb' ),
						),
					),

					'btn_radius'             => array(
						'type'    => 'unit',
						'label'   => __( 'Border Radius', 'uabb' ),
						'default' => '',
						'slider'  => true,
						'units'   => array( 'px' ),
						'preview' => array(
							'type'      => 'css',
							'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
							'property'  => 'border-radius',
							'unit'      => 'px',
							'important' => true,
						),
					),

					'button_border'          => array(
						'type'    => 'border',
						'label'   => __( 'Border', 'uabb' ),
						'slider'  => true,
						'units'   => array( 'px' ),
						'preview' => array(
							'type'      => 'css',
							'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
							'property'  => 'border',
							'unit'      => 'px',
							'important' => true,
						),
					),

					'border_hover_color'     => array(
						'type'        => 'color',
						'label'       => __( 'Border Hover Color', 'uabb' ),
						'default'     => '',
						'show_reset'  => true,
						'connections' => array( 'color' ),
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),

					'btn_vertical_padding'   => array(
						'type'    => 'unit',
						'label'   => __( 'Vertical Padding', 'uabb' ),
						'default' => '',
						'slider'  => true,
						'units'   => array( 'px' ),
						'preview' => array(
							'type'  => 'css',
							'rules' => array(
								array(
									'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
									'property'  => 'padding-top',
									'unit'      => 'px',
									'important' => true,
								),
								array(
									'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
									'property'  => 'padding-bottom',
									'unit'      => 'px',
									'important' => true,
								),
							),
						),
					),
					'btn_horizontal_padding' => array(
						'type'    => 'unit',
						'label'   => __( 'Horizontal Padding', 'uabb' ),
						'default' => '',
						'slider'  => true,
						'units'   => array( 'px' ),
						'preview' => array(
							'type'  => 'css',
							'rules' => array(
								array(
									'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
									'property'  => 'padding-left',
									'unit'      => 'px',
									'important' => true,
								),
								array(
									'selector'  => '.uabb-contact-form .uabb-contact-form-submit',
									'property'  => 'padding-right',
									'unit'      => 'px',
									'important' => true,
								),
							),
						),
					),
				),
			),
			'btn-typography' => array(
				'title'  => __( 'Button Typography', 'uabb' ),
				'fields' => array(
					'btn_font_size'              => array(
						'type'    => 'text',
						'label'   => __( 'Button Font Size for exa:10px', 'uabb' ),
						'default' => '14px',
					),
					'btn_space_top_bottom'              => array(
						'type'    => 'text',
						'label'   => __( 'Top Bottom Space', 'uabb' ),
						'default' => '14px',
					),
					'btn_space_left_right'              => array(
						'type'    => 'text',
						'label'   => __( 'Right left Space', 'uabb' ),
						'default' => '5px',
					),
					'btn_spacing'              => array(
						'type'    => 'text',
						'label'   => __( 'Letter Spacing', 'uabb' ),
					),
					'btn_weight'              => array(
						'type'    => 'select',
						'label'   => __( 'Button Weight', 'uabb' ),
						'default' => 'normal',
						'options' => array(
							'100'   => __( '100', 'uabb' ),
							'200'   => __( '200', 'uabb' ),
							'300'   => __( '300', 'uabb' ),
							'400'   => __( '400', 'uabb' ),
							'500'   => __( '500', 'uabb' ),
							'600'   => __( '600', 'uabb' ),
							'700'   => __( '700', 'uabb' ),
							'800'   => __( '800', 'uabb' ),
							'900'   => __( '900', 'uabb' ),
							'bold'   => __( 'Bold', 'uabb' ),
						),
					),

				),
			),
			'input-typography' => array(
				'title'  => __( 'Input Typography', 'uabb' ),
				'fields' => array(
					'input_font_size'              => array(
						'type'    => 'text',
						'label'   => __( 'Input Font Size for exa:10px', 'uabb' ),
						'default' => '14px',
					),
					'input_space_top_bottom'              => array(
						'type'    => 'text',
						'label'   => __( 'Top Bottom Space', 'uabb' ),
						'default' => '5px',
					),
					'input_space_left_right'              => array(
						'type'    => 'text',
						'label'   => __( 'Right left Space', 'uabb' ),
						'default' => '5px',
					),
					'input_spacing'              => array(
						'type'    => 'text',
						'label'   => __( 'Letter Spacing', 'uabb' ),
					),

				),
			),
		),
	),
	'template'   => array(
		'title'    => __( 'Email', 'uabb' ),
		'sections' => array(
			'email-subject'  => array(
				'title'  => __( 'Email & Subject', 'uabb' ),
				'fields' => array(
					'email_template_info' => array(
						'type'     => 'uabb-msgbox',
						'label'    => '',
						'msg_type' => 'info',
						'content'  => __( 'In the following subject & email template fields, you can use these mail-tags:<br/><br/><span class="uabb_cf_mail_tags"></span>', 'uabb' ),
					),
					'mailto_email'        => array(
						'type'        => 'text',
						'label'       => __( 'Send To Email', 'uabb' ),
						'default'     => $admin_email,
						'placeholder' => $admin_email,
						'help'        => __( 'The contact form will send to this e-mail. Defaults to the admin email.', 'uabb' ),
						'preview'     => array(
							'type' => 'none',
						),
						'connections' => array( 'html' ),
					),
					'email_subject'       => array(
						'type'    => 'text',
						'label'   => __( 'Email Subject', 'uabb' ),
						'default' => '[SUBJECT]',
						'help'    => __( 'The subject of email received, by default if you have enabled subject it would be shown by shortcode or you can manually add yourself', 'uabb' ),
					),
				),
			),
			'email-template' => array(
				'title'  => __( 'Email Template', 'uabb' ),
				'fields' => array(
					'email_template' => array(
						'type'        => 'textarea',
						'label'       => '',
						'rows'        => '10',
						'default'     => '<strong>From:</strong> [NAME]
<strong>Email:</strong> [EMAIL]
<strong>Phone:</strong> [PHONE]
<strong>Subject:</strong> [SUBJECT]
<strong>User IP Address : </strong>[IPAddress]
<strong>Message Body:</strong>
[MESSAGE]

----
You have received a new submission from Johnny Grow',
						'description' => __( 'Here you can design the email you receive', 'uabb' ),
					),
					'email_sccess'   => array(
						'type'    => 'text',
						'label'   => __( 'Success Message', 'uabb' ),
						'default' => __( 'Message Sent!', 'uabb' ),
					),
					'email_error'    => array(
						'type'    => 'text',
						'label'   => __( 'Error Message', 'uabb' ),
						'default' => __( 'Message failed. Please try again.', 'uabb' ),
					),
				),
			),
		),
	),
));

$host = 'localhost';
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$host = $_SERVER['HTTP_HOST'];
}

$current_url = 'http://' . $host . strtok( $_SERVER['REQUEST_URI'], '?' );

$default_template = sprintf(
	/* translators: %1$s: search term, translators: %2$s: search term */    __(
'<strong>From:</strong> [NAME]
<strong>Email:</strong> [EMAIL]
<strong>Phone:</strong> [PHONE]
<strong>Subject:</strong> [SUBJECT]

<strong>Message Body:</strong>
[MESSAGE]

----
You have received a new submission from %1$s
(%2$s)',
		'uabb'
	),
	get_bloginfo( 'name' ),
	$current_url
);

$admin_email = get_option( 'admin_email' );