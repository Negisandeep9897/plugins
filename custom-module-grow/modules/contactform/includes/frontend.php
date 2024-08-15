<?php
/* Button CSS */
$settings->btn_background_color       = uabb_theme_button_bg_color( $settings->btn_background_color );

$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );

$settings->btn_text_color             = uabb_theme_button_text_color( $settings->btn_text_color );

$settings->btn_text_hover_color       = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );

$id = $module->node;

$settings->btn_border_width = ( isset( $settings->btn_border_width ) && '' !== $settings->btn_border_width ) ? $settings->btn_border_width : '2';

// Border Size & Border Color.

if ( 'transparent' === $settings->btn_style ) {
	$border_size        = $settings->btn_border_width;
	$border_color       = $settings->btn_background_color;
	$border_hover_color = $settings->btn_background_hover_color;
}

// Background Gradient.
if ( 'gradient' === $settings->btn_style ) {
	if ( ! empty( $settings->btn_background_color ) ) {
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'lighten' );
	}

	if ( ! empty( $settings->btn_background_hover_color ) ) {
		$bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_hover_color ), 30, 'lighten' );
	}
}



echo '<style>';
if(!empty($settings->btn_space_top_bottom) || !empty($settings->btn_space_left_right)){
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> button.uabb-contact-form-submit{
		<?php echo 'margin:'.$settings->btn_space_top_bottom.' '.$settings->btn_space_left_right;?>
	}
	<?php
}

if(!empty($settings->btn_font_size)){
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> button.uabb-contact-form-submit{
		<?php echo 'font-size:'.$settings->btn_font_size;?>
	}
	<?php
}

if(!empty($settings->input_space_top_bottom) || !empty($settings->input_space_left_right)){
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb input, .fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb textarea{
		<?php echo 'margin:'.$settings->input_space_top_bottom.' '.$settings->input_space_left_right;?>
	}
	<?php
}

if(!empty($settings->btn_spacing)){
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb input, .fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb textarea, .fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> button.uabb-contact-form-submit{
		<?php echo 'letter-spacing:'.$settings->btn_spacing;?>
	}
	<?php
}

if(!empty($settings->input_font_size)){
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb input, .fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb textarea{
		<?php echo 'font-size:'.$settings->input_font_size;?>
	}
	<?php
}


if ( '' !== $settings->msg_height ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form textarea {
		min-height: <?php echo esc_attr( $settings->msg_height ); ?>px;
	}
<?php
}

if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form .uabb-contact-form-submit i {
		<?php
		echo ( '' !== $settings->btn_icon && 'before' === $settings->btn_icon_position ) ? 'margin-right: 8px;' : '';
		echo ( '' !== $settings->btn_icon && 'after' === $settings->btn_icon_position ) ? 'margin-left: 8px;' : '';
		?>
	}
	<?php
}

if ( 'default' === $settings->btn_style ) {
	$settings->button_border = uabb_theme_border( $settings->button_border );
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-builder-content .fl-node-$id .uabb-contact-form-submit",
			)
		);
	}
	?>

	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit:hover {
		<?php echo ( '' !== $settings->border_hover_color ) ? 'border-color:#' . esc_attr( $settings->border_hover_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_hover_color( '' ) ) . ';'; ?>
	}

<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form .uabb-contact-form-submit i,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form .uabb-contact-form-submit span {
	display: inline-block;
	vertical-align: middle;
}

<?php
if ( 'full' !== $settings->btn_align ) {
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-submit-btn {
	text-align: <?php echo esc_attr( $settings->btn_align ); ?>;
}
<?php } ?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>  .uabb-contact-form-submit .uabb-contact-form-button-text {
	color: <?php echo esc_attr( uabb_theme_text_color( $settings->btn_text_color ) ); ?>;
	<?php 
	if(!empty($settings->btn_weight)){
		echo 'font-weight: '.$settings->btn_weight;
	}
	?>
}

<?php if ( ! empty( $settings->btn_icon_color ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-submit-btn .uabb-contact-form-button .uabb-contact-form-submit .uabb-contact-form-submit-button-icon {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->btn_icon_color ) ); ?>;
	}
<?php endif; ?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>  .uabb-contact-form-submit {
	<?php if ( 'default' !== $settings->btn_style ) { ?>
		border-radius: <?php echo ( '' !== $settings->btn_radius ) ? esc_attr( $settings->btn_radius ) : '4'; ?>px;
	<?php } ?>
	<?php if ( 'flat' === $settings->btn_style || 'default' === $settings->btn_style ) { ?>

		background: <?php echo esc_attr( uabb_theme_base_color( $settings->btn_background_color ) ); ?>;

	<?php } elseif ( 'transparent' === $settings->btn_style ) { ?>

		background-color: rgba(0, 0, 0, 0);

		border-style: solid;

		border-color: <?php echo esc_attr( $border_color ); ?>;

		border-width: <?php echo esc_attr( $settings->btn_border_width ); ?>px;

	<?php } elseif ( 'gradient' === $settings->btn_style ) { ?>

		background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $settings->btn_background_color ); ?> 100%); /* FF3.6+ */

		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->btn_background_color ); ?>)); /* Chrome,Safari4+ */

		background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_color ); ?> 100%); /* Chrome10+,Safari5.1+ */

		background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_color ); ?> 100%); /* Opera 11.10+ */

		background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_color ); ?> 100%); /* IE10+ */

		background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_color ); ?> 100%); /* W3C */

		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->btn_background_color ); ?>',GradientType=0 ); /* IE6-9 */

	<?php } elseif ( '3d' === $settings->btn_style ) { ?>

		position: relative;
		-webkit-transition: none;
		-moz-transition: none;
		transition: none;
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->btn_background_color ) ); ?>;
		<?php $shadow_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'darken' ); ?>
		box-shadow: 0 6px <?php echo esc_attr( $shadow_color ); ?>;
	<?php } ?>

	<?php if ( 'full' === $settings->btn_align ) { ?>

		width:100%;

	<?php } ?>

	<?php

	echo esc_attr( uabb_theme_padding_css_genreated( 'desktop' ) );

	?>

	<?php
	echo ( '' !== $settings->btn_vertical_padding ) ? 'padding-top: ' . esc_attr( $settings->btn_vertical_padding ) . 'px;padding-bottom: ' . esc_attr( $settings->btn_vertical_padding ) . 'px;' : '';

	echo ( '' !== $settings->btn_horizontal_padding ) ? 'padding-left: ' . esc_attr( $settings->btn_horizontal_padding ) . 'px;padding-right: ' . esc_attr( $settings->btn_horizontal_padding ) . 'px;' : '';

	?>

}

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form-submit:hover .uabb-contact-form-button-text {

	<?php if ( '' !== $settings->btn_text_hover_color ) { ?>

		color: <?php echo esc_attr( $settings->btn_text_hover_color ); ?>;

	<?php } ?>

}

	<?php if ( 'full' === $settings->btn_align ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>  .uabb-submit-btn{
		width:100%;
	}

	<?php } ?>

	<?php if ( 'center' === $settings->btn_align ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>  .uabb-submit-btn{
			width:100%;
			text-align: center;
		}
	<?php } ?>

	<?php if ( 'right' === $settings->btn_align ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>  .uabb-submit-btn{
			width:100%;
			text-align: right;
		}
	<?php } ?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form-submit:hover {

	<?php if ( 'flat' === $settings->btn_style || 'default' === $settings->btn_style ) { ?>

		<?php if ( '' !== $settings->btn_background_hover_color ) { ?>

		background: <?php echo esc_attr( $settings->btn_background_hover_color ); ?>;

		<?php } ?>

	<?php } elseif ( 'transparent' === $settings->btn_style ) { ?>
		border-style: solid;
		border-color: <?php echo esc_attr( $border_hover_color ); ?>;
		<?php
		if ( 'border' !== $settings->hover_attribute ) {
			?>
			background:<?php echo esc_attr( $border_hover_color ); ?>;
			<?php
		}
		?>
		border-width: <?php echo esc_attr( $settings->btn_border_width ); ?>px;
	<?php } elseif ( 'gradient' === $settings->btn_style ) { ?>
		background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%, <?php echo esc_attr( $settings->btn_background_hover_color ); ?> 100%); /* FF3.6+ */

		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_hover_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->btn_background_hover_color ); ?>)); /* Chrome,Safari4+ */

		background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_hover_color ); ?> 100%); /* Chrome10+,Safari5.1+ */

		background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_hover_color ); ?> 100%); /* Opera 11.10+ */

		background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_hover_color ); ?> 100%); /* IE10+ */

		background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->btn_background_hover_color ); ?> 100%); /* W3C */

		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_hover_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->btn_background_hover_color ); ?>',GradientType=0 ); /* IE6-9 */

	<?php } elseif ( '3d' === $settings->btn_style ) { ?>

		top: 2px;

		box-shadow: 0 4px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;

	<?php } ?>

}

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form-submit:active {

	<?php if ( '3d' === $settings->btn_style ) { ?>

		top: 6px;

		box-shadow: 0 0px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;

	<?php } ?>
}

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .cntact_form_ubb input[type="email"]{
	<?php if(!empty($settings->email_width)){
		echo 'width: '.$settings->email_width.'%';
	}?>
}

</style>

<?php
$node_id = $module->node;

$parent_class = 'prob_'.$module->parent;

if(!empty($settings->name_placeholder)){
	$name_placeholder = $settings->name_placeholder;
}else{
	$name_placeholder = '';
}


// email
if(!empty($settings->email_placeholder)){
	$email_placeholder = $settings->email_placeholder;
}else{
	$email_placeholder = '';
}

// subject_placeholder
if(!empty($settings->subject_placeholder)){
	$subject_placeholder = $settings->subject_placeholder;
}else{
	$subject_placeholder = '';
}

// phone_placeholder
if(!empty($settings->phone_placeholder)){
	$phone_placeholder = $settings->phone_placeholder;
}else{
	$phone_placeholder = '';
}

// button submit
if(!empty($settings->btn_text)){
	$btn_text = $settings->btn_text;
}else{
	$btn_text = '';
}

// button submit
if(!empty($settings->msg_placeholder)){
	$message_placeholder = $settings->msg_placeholder;
}else{
	$message_placeholder = '';
}

// button mailto_email
if(!empty($settings->mailto_email)){
	$mailto_email = $settings->mailto_email;
}else{
	$mailto_email = '';
}

if($settings->enforce_business_email == 'yes'){
	$enforce_business_email = 'enforce_business_email="true"';
}else{
	$enforce_business_email = 'enforce_business_email="false"';
}
?>

<div class="cntact_form_ubb <?php echo $parent_class;?>" contacclass="<?php echo $parent_class;?>">
	<form class="form_contact_builder">
		<div class="uabb-input-group-wrap">
			<?php 
			if ( 'show' == $settings->name_toggle ) : ?>
				<div class="uabb-input-group uabb-name ">
					<div class="uabb-form-outter">
						<input aria-label="text" type="text" name="name" value="" placeholder="<?php echo $name_placeholder;?>">
					</div>
					<?php if ( 'yes' == $settings->name_required ) : ?>
						<span class="uabb_name" valid_text="<?php echo $settings->name_validation;?>"></span>
					<?php endif;?>
				</div>
			<?php endif;?>

			<?php if ( 'show' == $settings->email_toggle ) : ?>
				<div class="uabb-input-group uabb-email ">
					<div class="uabb-form-outter">
						<input aria-label="email" type="email" name="email" value="" placeholder="<?php echo $email_placeholder;?>">
						<input type="hidden" name="mailto_email" value="<?php echo $mailto_email;?>">
					</div>
					<span class="uabb_email" valid_text="Please enter email"></span>
					<span class="uabb_bussiness_email" valid_text="<?php echo $settings->email_validation;?>"></span>
				</div>
			<?php endif;?>
			
			<?php if ( 'show' == $settings->phone_toggle ) : ?>
				<div class="uabb-input-group fl-phone">
					<div class="uabb-form-outter">
						<input type="tel" name="phone" value="" placeholder="<?php echo $phone_placeholder; ?>" />
					</div>
					<?php if ( 'yes' == $settings->phone_required ) : ?>
						<span class="uabb_phone" valid_text="<?php echo $settings->phone_validation;?>"></span>
					<?php endif;?>
				</div>
			<?php endif; ?>
			<?php if ( 'show' == $settings->subject_toggle ) : ?>
				<div class="uabb-input-group uabb-subject ">
					<div class="uabb-form-outter">
						<input aria-label="text" type="text" name="subject" value="" placeholder="<?php echo $subject_placeholder;?>">
					</div>
				</div>
			<?php endif;?>
			<?php if ( 'show' == $settings->msg_toggle ) : ?>
				<div class="uabb-input-group uabb-message ">
					<div class="uabb-form-outter-textarea">
						<textarea aria-label="uabb-message" name="message" placeholder="<?php echo $message_placeholder;?>"></textarea>
					</div>
				</div>
			<?php endif;?>

			<?php if ( 'redirect' == $settings->success_action ) : ?>
				<input type="hidden" aria-label="<?php echo esc_attr( $contact_form_fields['form_success_url'] ); ?>" name="success_url" value="<?php echo $settings->success_url; ?>" style="display: none;" class="fl-success-url">
			<?php elseif ( 'none' == $settings->success_action ) : ?>
				<span class="fl-success-none" style="display:none;"><?php _e( 'Message Sent!', 'fl-builder' ); ?></span>
			<?php elseif ( 'show_message' == $settings->success_action ) : ?>
				<input type="hidden" name="show_message" value="show_message">
			<?php endif; ?>

			<input type="hidden" name="node_id" value="<?php echo $node_id;?>">
			<input type="hidden" name="post_id" value="<?php echo get_the_ID();?>">
			<div class="uabb-submit-btn">
				<div class="uabb-contact-form-button" data-wait-text="<?php echo $settings->btn_processing_text;?>">
					<button type="submit" class="uabb-contact-form-submit" <?php echo $enforce_business_email; ?>>
						<?php
						if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
							echo ( '' !== $settings->btn_icon && 'before' === $settings->btn_icon_position ) ? '<i class="' . esc_attr( $settings->btn_icon ) . ' uabb-contact-form-submit-button-icon "></i>' : ''; }
						?>
						<span class="uabb-contact-form-button-text"><?php echo $settings->btn_text;?></span>
						<?php
						if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
							echo ( '' !== $settings->btn_icon && 'after' === $settings->btn_icon_position ) ? '<i class="' . esc_attr( $settings->btn_icon ) . ' uabb-contact-form-submit-button-icon"></i>' : ''; }
						?>
					</button>
				</div>
			</div>
		</div>
		<?php if($settings->enforce_business_email == 'yes'):?>
			<script>
				var email_business_error = jQuery('.uabb_bussiness_email').attr('valid_text');
			    jQuery.validator.addMethod('noemail', function (value) {
				    return /^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!hotmail\.com)(?!mail\.ru)(?!yandex\.ru)(?!mail\.com)([\w-]+.)+[\w-]{2,4})?$/.test(value);
				}, email_business_error);
			</script>
		<?php else:?>
				<script>
					var email_business_error = jQuery('.uabb_bussiness_email').attr('valid_text');
				    jQuery.validator.addMethod('noemail', function (value) {
					    return /^([\w-.]+@([\w-]+.)+[\w-]{2,4})?$/.test(value);
					}, email_business_error);
				</script>
		<?php endif;?>

		<script>
		    var ajax_url = "<?php echo admin_url( 'admin-ajax.php' );?>";
		    var parent_class = ".<?php echo $parent_class;?>";

		    jQuery(document).ready(function($){
		        var name_error = $(parent_class + '.uabb_name').attr('valid_text');
		        if(name_error != ''){
		            var name_error_text = name_error;
		        }else{
		            var name_error_text = false;
		        }

		        var email_error = $(parent_class + '.uabb_email').attr('valid_text');
		        if(email_error != ''){
		            var email_error_text = email_error;
		        }else{
		            var email_error_text = 'required';
		        }

		        var email_business_error = $(parent_class + '.uabb_bussiness_email').attr('valid_text');
		        if(email_business_error != ''){
		            var email_error_business = email_business_error;
		        }else{
		            var email_error_business = 'required business email';
		        }

		        var phone_error = $(parent_class + '.uabb_phone').attr('valid_text');
		        if(phone_error != ''){
		            var phone_error_text = phone_error;
		        }else{
		            var phone_error_text = false;
		        }

		         var subject_error = $(parent_class + '.uabb_subject').attr('valid_text');
		        if(subject_error != ''){
		            var subject_error_text = subject_error;
		        }else{
		            var subject_error_text = 'required';
		        }

		        var b_email = $(parent_class + " form button[type='submit']").attr('enforce_business_email');
		        if (b_email == true) {
  					var b_email_check = true;
  				}else{
  					var b_email_check = false;
  				}

		        $(parent_class + " form").validate({
		            rules: {
		                name:{
		                    required: true,
		                },
		                phone:{
		                    required: true,
		                },
		                subject:{
		                    required: true,
		                },
		                email: {
		                    required: true,
		                    noemail: true
		                },
		            },
		            messages: {
		                email: {
		                    required: email_error_business,
		                    noemail: email_error_business
		                },
		                name: {
		                    required: name_error_text,
		                },
		                phone: {
		                    required: phone_error_text,
		                },
		            },
		        });
				
				 $(parent_class + " form button[type='submit']").click(function(e){
					 e.preventDefault();
					 var this_ = $(this);
					 var form_p = this_.parent().parent().parent().parent('form');
					 if($(form_p).valid()){
						var formData = $(form_p).serialize();
						jQuery.ajax({
		                    type: "post",
		                    dataType: "json",
		                    url: ajax_url,
		                    data: formData + "&action=contact_form_action",
		                    success: function(msg){
		                        if(msg.success == true && msg.data.mailsent){
		                            if(msg.data.success_url){
		                                window.location.href = msg.data.success_url;
		                            }else if(msg.data.show_message){
		                                $('.msg_success').show();
		                                $('.form_contact_builder').hide();
		                            }else{
		                                $('.fl-success-none').show();
		                            }
		                        }
		                    }
		                });
					 }
				});
		    });
		</script>
	</form>
	<?php 
	if ( 'show_message' == $settings->success_action ) : ?>
		<div class="msg_success"><?php echo $settings->success_message; ?></div>
	<?php endif;?>
</div>