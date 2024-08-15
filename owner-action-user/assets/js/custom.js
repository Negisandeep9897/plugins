jQuery(document).ready(function($){
	$('#loadingDiv .loader').hide();
    // login validation
    $("#owner_login").validate({
        rules: {
            login_email: {
                required: true
            },
            login_password: {
                required: true
            }
        },
        messages: {
            login_email: {
                required: 'Please Enter Your Username or email'
            },
            login_password: {
                required: 'Please Enter Your Password'
            }
        }
    });
    $('#owner_login #login_submit').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
        if($("#owner_login").valid()){
            var loginformdata = $('#owner_login').serialize();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajaxurl,
                data: loginformdata,
                success: function(message){
					if(!message.loggedin == false && message.dashboard == ''){
						jQuery('#login_message').html(message.message);
						window.location.href = ajax_owneraction_object.home_url +'/signup/';
					}else if(message.dashboard && message.loggedin == true){  
						jQuery('#login_message').html(message.message);
						window.location.href = ajax_owneraction_object.home_url +'/portal-checklist/';
					}else{
						jQuery('#login_message').html(message.message);
					}
                }
          });
        }
    });
	
	 // register validation
    $("#owner_register, #update_password").validate({
        rules: {
            password: {
				required: true,
                minlength : 5
            },
            confirm_password: {
				required: true,
                minlength : 5,
				equalTo : "#password"
            }
        },
        messages: {
            password: {
                required: 'Please Enter Your Password'
            },
            confirm_password: {
                required: 'Please Enter Your Confirm Password'
            }
        }
    });
	
    $('#owner_register #submit').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		if($("#owner_register").valid()){
			var formData = $('#owner_register').serialize();
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: formData,
				success: function(msg){
					console.log(msg);
					jQuery('#own-msg').html(msg.msg);
					window.location.href = ajax_owneraction_object.home_url +'/portal-checklist/';
				}
			});
		}
    });
	
	//update_password
	$('a.update_password').click(function(e){
		e.preventDefault();
		$('.updatepassword').toggle();
	});
	
	//update_password ajax
	$('#update_password input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		if($("#update_password").valid()){
			var formData = $('#update_password').serialize();
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: formData+'&action=update_password_ajax',
				success: function(msg){
					if(msg.loggedin == true){
						jQuery('.updatepassword #own-msg').html(msg);
						setTimeout(function () {
							location.reload()
						}, 800);
					}else{
						jQuery('.updatepassword #own-msg').html(msg);
					}
					
				}
			});
		}
    });
	
	//update_somethingelse ajax
	$('#update_somethingelse input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		var formData = $('#update_somethingelse').serialize();
		var _check_form = true
		$( '#update_somethingelse input, textarea' ).each( function(){
			let _this  = $( this )
			if( _this.val() == '' ){
				_this.css( 'border', '1px solid red' )
				_check_form = false
			}else{
				$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: formData+'&action=update_somethingelse_ajax',
				success: function(msg){
					jQuery('#update_somethingelse #own-msg').html(msg.succes);
					window.location.href = ajax_owneraction_object.home_url +'/portal-checklist/';
				}
			});
			}
		} )
		if( !_check_form ){
			return false;
		}
    });
	

	/* $('select#select-expertise').on('change', function(){
	  var _thisval = $(this).val();
		if(_thisval == 'other'){
			$('#others_expertise').show();
			$('ul.own_slider button.slick-next.slick-arrow').css('display', 'none');
			$('ul.own_slider button.slick-next.slick-arrow').after('<a class="next_btn" href="#">Next</a>')
		}else{
			$('#others_expertise').hide();
			$('ul.own_slider button.slick-next.slick-arrow').css('display', 'block');
			$('#owner_register .next_btn').css('display', 'none');
			$(".own_slider").slick('slickGoTo', _thisval);
		}
	});
	
	if($('#owner_register .next_btn').length < 1){
		$('#owner_register .next_btn').on('click', function(e){
			e.preventDefault();
			$(".own_slider").slick('slickGoTo', 8);
		});
	} */
	
	/* $('#third_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others_services').show();
			$('input[type="checkbox"].services').prop('checked',false);
		}else{
			$('#others_services').hide();
			$('#service-others').prop('checked',false);
		}
	}); */
	
	/* 
	$('#fourth_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others_firm').show();
			$('input[type="checkbox"].firms').prop('checked',false);
		}else{
			$('#others_firm').hide();
			$('#firm-other').prop('checked',false);
		}
	});
	
	$('#five_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others_firm_two').show();
			$('input[type="checkbox"].firm_two').prop('checked',false);
		}else{
			$('#others_firm_two').hide();
			$('#firm-two-other').prop('checked',false);
		}
	});
	$('#six_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others_consulting').show();
			$('input[type="checkbox"].consulting').prop('checked',false);
		}else{
			$('#others_consulting').hide();
			$('#consulting-other').prop('checked',false);
		}
	});
	$('#seven_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others-marketing').show();
			$('input[type="checkbox"].marketing').prop('checked',false);
		}else{
			$('#others-marketing').hide();
			$('#marketing-other').prop('checked',false);
		}
	});
	$('#eight_section_step input[type="checkbox"]').change(function(){
		var _this = $(this);
		if(_this.val() == 'Other' && $(this).is(':checked')){
			$('#others-web_devlopement').show();
			$('input[type="checkbox"].web_devlopement').prop('checked',false);
		}else{
			$('#others-web_devlopement').hide();
			$('#marketing-other').prop('checked',false);
		}
	});
	$('#nine_section_step input[type=radio]').change(function(){
		if (this.value == 'selectedpage'){
			$('#msa_states').show();
		}else{
			$('#msa_states').hide();
		}
	}); */
	
   
   // update user data
	$('#update_register input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		var formData = $('#update_register').serialize();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: formData + '&action=update_user_question_data',
			success: function(msg){
				if(msg.msg){
					jQuery('#own-msg').html(msg.msg);
					jQuery('#own-msg').css('width','100%');
					setTimeout(function () {
						location.reload()
					}, 800);
				}else{
					jQuery('#own-msg').html(msg.error);
				}
			}
		});
    });
	
	//do_not_action_update
/* 	$('a.do_not_action_update').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: 'action=do_not_action_update',
			success: function(msg){
				if(msg.msg){
					alert(msg.msg);
				}
			}
		});
    }); */
	
	//do_not_send_leads
	$('a.do_not_send_leads').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: 'action=do_not_send_leads',
			success: function(msg){
				if(msg.msg){
					alert(msg);
				}
			}
		});
    });
	
	//delete_my_account
	$('a.delete_my_account').click(function(e){
        e.preventDefault();
		if(confirm("Are you sure you want to delete this?")){
			var ajaxurl = ajax_owneraction_object.ajax_url;
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: 'action=delete_my_account',
				success: function(msg){
					if(msg){
						window.location.href = ajax_owneraction_object.home_url;
					}
				}
			});
		}else{
			return false;
		}
    });
	
	
	// slider_portal slide
	if($('body').hasClass('firstscreen_last_scrren')){
		var intslide = 1;
	}else{
		var intslide = 0;
	}
	jQuery('.slider_portal').slick({
        infinite: false,
        speed: 500,
        slidesToShow: 1,
        arrows: true,
        slidesToScroll: 1,
        initialSlide: intslide,
        adaptiveHeight: true,
        verticalSwiping: false,
        draggable: false,
        fnCanGoPrev: function(instance, currentSlide){
            switch ( currentSlide ) {
                case 0:
					break;
                default:
                  break;
            }
            return true;
        },
        fnCanGoNext: function(instance, currentSlide){
            switch ( currentSlide ) {
                case 0:
                	if ($('body').hasClass('firstscreen_last_scrren')){
                		alert('dd');
                		//$(".slider_portal").slick('slickGoTo', 1);
                	}else{
                		var _check_form = true
	                    $( '#welcome_portal_1 input' ).each( function(){
	                        let _this  = $( this )
	                        if( _this.val() == '' ){
	                            _this.css( 'border', '1px solid red' )
	                            _check_form = false
	                        }else{
	                            _this.css( 'border', '1px solid #ccc' )
								var your_name = $(this).val();
								$('#your_name_text').html(your_name);
	                        }
	                    } )
	                    if( !_check_form ){
	                        return false;
	                    }
                	}
					
                    break;
					case 2:
						$('.slick-list.slick_height').addClass('height_start');
					break;
					case 5:
						$('.slick-list').addClass('height_auto');
                    break;
                default:
                    break;
            }
            return true;
        }
    });
	
	
	// back btn click
	$('.back_btn_question').click(function(){
		var back_screen = $(this).attr('back_screen');
		$(".slider_portal").slick('slickGoTo', back_screen);
	});

	
	// start validation
	$('.slider_portal #start_number a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		radiovalidation();
	});
	
	function radiovalidation(){
		var determined = $("input[name='determined']:checked").val();
		var physical_product = $("input[name='physical_product']:checked").val();
		var fee_based = $("input[name='fee_based']:checked").val();
		var distribute_products = $("input[name='distribute_products']:checked").val();
		var selling_food = $("input[name='selling_food']:checked").val();
		var medical_services = $("input[name='medical_services']:checked").val();
		var physical_site = $("input[name='physical_site']:checked").val();
		var specialized_equipment = $("input[name='specialized_equipment']:checked").val();
		var vehicles = $("input[name='vehicles']:checked").val();
		var outside_investors = $("input[name='outside_investors']:checked").val();
		var hired_employees = $("input[name='hired_employees']:checked").val();
		var employees_soon = $("input[name='employees_soon']:checked").val();
		if(determined && physical_product && fee_based && distribute_products && selling_food && medical_services && physical_site && specialized_equipment && vehicles && outside_investors && hired_employees && employees_soon){
			
			if($('body').hasClass('firstscreen_last_scrren')){
				userajax();
			}else{
				var body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() {
				});
				$(".slider_portal").slick('slickGoTo', 12);
			}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	// franchise validation
	$('.slider_portal #welcome_portal_franchise a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		franchisevalidation();
	}); 
	
	function franchisevalidation(){
		var entity = $("input[name='entity']:checked").val();
		var franchise_partner = $("input[name='franchise_partner']:checked").val();
		var physical_site = $("input[name='physical_site']:checked").val();
		var physical_product = $("input[name='physical_product']:checked").val();
	
		if(entity && franchise_partner && physical_site && physical_product ){
			if($('body').hasClass('firstscreen_last_scrren')){
				userajax();
			}else{
				var body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() {
				});
				$(".slider_portal").slick('slickGoTo', 12);
			}
		}else{
			$('.error_button').show();
		}
	}
	
	// manage validation
	$('.slider_portal #owner_mange a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		owner_mangevalidation();
	});
	
	function owner_mangevalidation(){
		var choose_business = $("input[name='choose_business']:checked").val();
		var is_franchies = $("input[name='is_franchies']:checked").val();
		var hired_employees = $("input[name='hired_employees']:checked").val();
		var hired_employees_soon = $("input[name='hired_employees_soon']:checked").val();
		var specialized_equipment = $("input[name='specialized_equipment']:checked").val();
		var others_produce = $("input[name='others_produce']:checked").val();
		var outside_investors = $("input[name='outside_investors']:checked").val();
	
		if(choose_business && is_franchies && hired_employees && hired_employees_soon && specialized_equipment && others_produce && outside_investors){
				if($('body').hasClass('firstscreen_last_scrren')){
					userajax();
				}else{
					var body = $("html, body");
					body.stop().animate({scrollTop:0}, 500, 'swing', function() {
					});
					$(".slider_portal").slick('slickGoTo', 12);
				}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	// portal_sell validation
	$('.slider_portal #portal_sell a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		sell_mangevalidation();
	});
	
	function sell_mangevalidation(){
		var choose_business = $("input[name='choose_business']:checked").val();
		var any_employees = $("input[name='any_employees']:checked").val();
		var physical_location = $("input[name='physical_location']:checked").val();
		var business_brokers = $("input[name='business_brokers']:checked").val();
		if(choose_business && any_employees && physical_location && business_brokers ){
				if($('body').hasClass('firstscreen_last_scrren')){
					userajax();
				}else{
					var body = $("html, body");
					body.stop().animate({scrollTop:0}, 500, 'swing', function() {
					});
					$(".slider_portal").slick('slickGoTo', 12);
				}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	// buy validation
	$('.slider_portal #welcome_portal_buy a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		buyvalidation();
	});
	
	function buyvalidation(){
		var buy_business = $("#welcome_portal_buy input[name='buy_business']:checked").val();
		var entity = $("#welcome_portal_buy input[name='entity']:checked").val();
		var fee_based = $("#welcome_portal_buy input[name='fee_based']:checked").val();
		var distribute_products = $("#welcome_portal_buy input[name='distribute_products']:checked").val();
		var selling_food = $("#welcome_portal_buy input[name='selling_food']:checked").val();
		var medical_services = $("#welcome_portal_buy input[name='medical_services']:checked").val();
		var physical_site = $("#welcome_portal_buy input[name='physical_site']:checked").val();
		var specialized_equipment = $("#welcome_portal_buy input[name='specialized_equipment']:checked").val();
		var vehicles = $("#welcome_portal_buy input[name='vehicles']:checked").val();
		var outside_investors = $("#welcome_portal_buy input[name='outside_investors']:checked").val();
		if(buy_business && entity && fee_based && distribute_products && selling_food && medical_services && physical_site && specialized_equipment && vehicles && outside_investors){
				if($('body').hasClass('firstscreen_last_scrren')){
					userajax();
				}else{
					var body = $("html, body");
					body.stop().animate({scrollTop:0}, 500, 'swing', function() {
					});
					$(".slider_portal").slick('slickGoTo', 12);
				}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	// sourced validation
	$('.slider_portal #sourced_sell_screen a.submit-sell').click(function(e){
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		e.preventDefault();
		sourcevalidation();
	});
	
	function sourcevalidation(){
		var sell_any_employees = $("input[name='sell_any_employees']:checked").val();
		var sell_employees_soon = $("input[name='sell_employees_soon']:checked").val();
		var sell_physical_product = $("input[name='sell_physical_product']:checked").val();
		var fee_based_service = $("input[name='fee_based_service']:checked").val();
		var drinks_to_customers = $("input[name='drinks_to_customers']:checked").val();
		var medical_advice = $("input[name='medical_advice']:checked").val();
		var sell_retail_site = $("input[name='sell_retail_site']:checked").val();
		var office_space = $("input[name='office_space']:checked").val();
		var industrial_site = $("input[name='industrial_site']:checked").val();
		var outside_investors = $("input[name='outside_investors']:checked").val();
		var operate_business = $("input[name='operate_business']:checked").val();
		var sell_specialized_equipment = $("input[name='sell_specialized_equipment']:checked").val();
		if(sell_any_employees && sell_employees_soon && sell_physical_product && fee_based_service && drinks_to_customers && medical_advice && sell_retail_site && office_space && industrial_site && outside_investors && operate_business && sell_specialized_equipment){
			if($('body').hasClass('firstscreen_last_scrren')){
				userajax();
			}else{
				var body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() {
				});
				$(".slider_portal").slick('slickGoTo', 12);
			}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	// close validation
	$('.slider_portal #welcome_portal_close a.close-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		$('#account_set_up').find($('.back_undecided').attr('back_screen', screen_id));
		closevalidation();
	});
	
	function closevalidation(){
		var close_choose_business = $("input[name='close_choose_business']:checked").val();
		var close_any_employees = $("input[name='close_any_employees']:checked").val();
		var close_physical_location = $("input[name='close_physical_location']:checked").val();

		if(close_choose_business && close_any_employees && close_physical_location){
			if($('body').hasClass('firstscreen_last_scrren')){
				userajax();
			}else{
				var body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() {
				});
				$(".slider_portal").slick('slickGoTo', 12);
			}
			$('.error_button').hide();
		}else{
			$('.error_button').show();
		}
	}
	
	$('.slider_portal button.thanks-next-lets').click(function(){
		var your_name = $('#welcome_portal_1 input[name="your_name"]').val();
		var your_name_last = $('#welcome_portal_1 input[name="your_name_last"]').val();
		
		if(your_name != '' &&  your_name_last !=''){
			$('#welcome_portal_1 input[name="your_name"]').css( 'border', '1px solid #ccc' );
			$('#welcome_portal_1 input[name="your_name_last"]').css( 'border', '1px solid #ccc' );
			var your_name = $('#first_name').val();
			$('#your_name_text').html(your_name);
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, 500, 'swing', function() {
			});
			$(".slider_portal").slick('slickGoTo', 1);
		}else{
			$('#welcome_portal_1 input[name="your_name"]').css( 'border', '1px solid red' );
			$('#welcome_portal_1 input[name="your_name_last"]').css( 'border', '1px solid red' );
		}
		
	});
	
	// login validation
    $('#slider_portal_form').validate({
        rules: {
            username: {
                required: true,
				email: true
            },
			user_pass: {
                required: true
            }
        },
        messages: {
            username: {
                required: 'Please enter email'
            },
            user_pass: {
                 required: 'Please enter password'
            }
        }
    });
	
	$('#account_submit').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		if($("#slider_portal_form").valid()){
            var slider_portal_start_form = $('#slider_portal_form').serialize();
			var business_portal_val = $('#account_set_up input[name="business_portal"]').val();
			$('.owner_loading #overlay').show();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajaxurl,
                data: slider_portal_start_form +'&action=slider_portal_start_form_action&business_portal='+ business_portal_val,
                success: function(message){
					$('.owner_loading #overlay').hide();
					if(message.type == 'success'){
						jQuery('#slider_portal_form #mssg').html(message.msg);
						window.location.href = ajax_owneraction_object.home_url +'/portal-checklist';
					}else{
						jQuery('#slider_portal_form #mssg').html(message.msg);
					}
                }
			});
		}
    });

	function userajax(){
        var ajaxurl = ajax_owneraction_object.ajax_url;
        var slider_portal_start_form = $('#slider_portal_form').serialize();
		var business_portal_val = $('#account_set_up input[name="business_portal"]').val();
		$('.owner_loading #overlay').show();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: slider_portal_start_form +'&action=slider_portal_start_form_action&business_portal='+ business_portal_val,
            success: function(message){
				$('.owner_loading #overlay').hide();
				if(message.type == 'success'){
					jQuery('#slider_portal_form #mssg').html(message.msg);
					window.location.href = ajax_owneraction_object.home_url +'/portal-checklist';
				}else{
					jQuery('#slider_portal_form #mssg').html(message.msg);
				}
            }
		});

	}
	
	function IsEmail(emailAddress) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(emailAddress)) {
			return false;
		}else {
			return true;
		}
	}
	$('.error_undecided').hide();
	//undecided_portal register
	$('#undecided_submit').click(function(e){
        e.preventDefault();
		var emailAddress = $('#undecided_portal input[name="username_undecided"]').val();
		var user_pass_undecided = $('#undecided_portal input[name="user_pass_undecided"]').val();
		if (user_pass_undecided == '') {
			$('#user_pass_undecided').next().show();
			return false;
		}
		if (emailAddress == '') {
			$('#username_undecided').next().show();
			return false;
		}
		if (IsEmail(emailAddress) == false) {
			$('#invalid_email').show();
			return false;
		}
        var ajaxurl = ajax_owneraction_object.ajax_url;
		var slider_portal_start_form = $('#slider_portal_form').serialize();
		var business_portal_val = $('#undecided_portal input[name="business_portal"]').val();
		$('.owner_loading #overlay').show();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: slider_portal_start_form +'&action=slider_portal_undecided_form_action&business_portal='+ business_portal_val,
			success: function(message){
				$('.owner_loading #overlay').hide();
				if(message.type == 'success'){
					jQuery('#slider_portal_form #mssg').html(message.msg);
					window.location.href = ajax_owneraction_object.home_url +'/portal-checklist';
				}else{
					jQuery('#slider_portal_form #mssg').html(message.msg);
				}
			}
		});
    });
	
	$('.source input[type=radio][name=is_franchies]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.manage_franchise_name').show());
		}else{
			$('.manage_franchise_name').hide();
		}
	});
	
	
	$('.source input[type=radio][name=have_you]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		console.log('47777');
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.start_check').show());
			$('.slider_portal .slick-list.slick_height').addClass('have_you_height');
		}else{
			$('.start_check').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('have_you_height');
		} 
	});
	
	$('.source input[type=radio][name=buy_have_you]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.start_check').show());
			$('.slider_portal .slick-list.slick_height').addClass('buy_have_you_height');
		}else{
			$('.start_check').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('buy_have_you_height');
		}
	});
	
	$('.source input[type=radio][name=determined]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.start_structure').show());
			if($('.source input[type=radio][name=have_you]:checked').val() == 'Yes'){
				$('.slider_portal .slick-list.slick_height').addClass('have_determined_height');
			}else{
				$('.slider_portal .slick-list.slick_height').addClass('determined_height');
			}
		}else{
			$('.start_structure').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('determined_height'); 
			$('.slider_portal .slick-list.slick_height').removeClass('have_determined_height'); 
		}
	});
	
	$('.source input[type=radio][name=entity]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.entity_check').show());
			if($('.source input[type=radio][name=buy_have_you]:checked').val() == 'Yes'){
				console.log('buttt');
				$('.slider_portal .slick-list.slick_height').addClass('have_determined_height');
			}else{
				$('.slider_portal .slick-list.slick_height').addClass('entity_height');
			}
		}else{
			$('.entity_check').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('entity_height');
			$('.slider_portal .slick-list.slick_height').removeClass('have_determined_height'); 
		}
	});
	
	///franchise
	$('#welcome_portal_franchise .source input[type=radio][name=have_you]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.start_check').show());
			$('.slider_portal .slick-list.auto_height').addClass('have_you_height');
		}else{
			$('.start_check').hide();
			$('.slider_portal .slick-list.auto_height').removeClass('have_you_height');
		} 
	});
	
	$('#welcome_portal_franchise .source input[type=radio][name=entity]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.entity_check').show());
			if($('#welcome_portal_franchise .source input[type=radio][name=have_you]:checked').val() == 'Yes'){
				console.log('ff');
				$('.slider_portal .slick-list.auto_height').addClass('have_determined_height');
			}else{
				$('.slider_portal .slick-list.auto_height').addClass('entity_height');
			}
		}else{
			$('.entity_check').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('entity_height');
			$('.slider_portal .slick-list.slick_height').removeClass('have_determined_height'); 
		}
	});
	
	$('.sourced input[type=radio][name=franchise_unit]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.physical_site').show());
		}else{
			$('.physical_site').hide();
		}
	});
	
	// physical_site
	$('.sourced input[type=radio][name=physical_site]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.physical_site').show());
			$('.next-main .close-next').hide();
			$('.submit_aluser').hide();
			$('.next-main .if-next').show();
			$('.slider_portal .slick-list.slick_height').addClass('physical_height');
		}else{
			$('.physical_site').hide();
			$('.next-main .if-next').hide();
			$('.next-main .close-next').show();
			$('.submit_aluser').show();
			$('.slider_portal .slick-list.slick_height').removeClass('physical_height');
		}
	});
	
	$('#welcome_portal_franchise .sourced input[type=radio][name=physical_site]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.physical_site').show());
			$('.next-main .close-next').hide();
			$('.submit_aluser').hide();
			$('.next-main .if-next').show();
			$('.slider_portal .slick-list.auto_height').addClass('physical_height_franchise');
		}else{
			$('.physical_site').hide();
			$('.next-main .if-next').hide();
			$('.next-main .close-next').show();
			$('.submit_aluser').show();
			$('.slider_portal .slick-list.auto_height').removeClass('physical_height_franchise');
		}
	});
	
	// physical_site manage
	$('#owner_mange .source input[type=radio][name=physical_site]').change(function(){
		var source_close = $(this).closest();
		var _value = $(this).val();
		if(_value == 'Yes'){
			source_close.parents('.founded').find($('.physical_site').show());
			$('.slider_portal .slick-list.slick_height').addClass('physical_height');
		}else{
			$('.physical_site').hide();
			$('.slider_portal .slick-list.slick_height').removeClass('physical_height');
		}
	});
	
	// sell_if
/* 	$('.sell_if input[type=radio][name=business_brokers]').change(function(){
		var _value = $(this).val();
		if(_value == 'Yes'){
			$('.sell .next-main .close-next').hide();
			$('.sell .next-main .if-sell').show();
		}else{
			$('.sell .next-main .if-sell').hide();
			$('.sell .next-main .close-next').show();
		}
	}); */
	
	// undecided back
	$('a.if-next').click(function(e){
		e.preventDefault();
		$('.submit_aluser').show();
		var _check_form = true
		var checkedNum = $('input[name="physical_site_apply[]"]:checked').length;
		if (!checkedNum){
			alert('Please choose all the apply.');
			_check_form = false
		}else{
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, 500, 'swing', function() {
			});
			var screen_id = $(this).attr('screen_id');
			$('#retails_screen').find($('.back_btn').attr('back_screen', screen_id));
			$(".slider_portal").slick('slickGoTo', 11);
			
			$('.slick-list.slick_height').removeClass('have_you_height');
			$('.slick-list.slick_height').removeClass('have_determined_height');
			$('.slick-list.slick_height').removeClass('physical_height');
			
			$('.slick-list.slick_height').removeClass('buy_have_you_height');
		}
		if( !_check_form ){ 
			return false;
		}
	});
	
	/* $('a.if-sell').click(function(e){
		e.preventDefault();
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 500, 'swing', function() {
		});
		var screen_id = $(this).attr('screen_id');
		$('#sourced_sell_screen').find($('.back_btn').attr('back_screen', screen_id));
		$(".slider_portal").slick('slickGoTo', 12);
	}); */
	
	$('a.submit-next').click(function(e){
		e.preventDefault();
		var screen_id = $(this).attr('screen_id');
		var length_num = $("#retails_screen .physical_site_check .source-area.pro-duce input[type='checkbox']:checked").length;
		if(length_num < 0){
			alert('Please check minimum one.');
		}else{
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, 500, 'swing', function() {
			});
			$('#account_set_up .back_undecided').attr('back_screen', screen_id);
			$(".slider_portal").slick('slickGoTo', 12);
		}
	});
	
	jQuery('.slider_portal').on('afterChange', function(event, slick, currentSlide, nextSlide){
		if(currentSlide == 2 || currentSlide == 3 || currentSlide == 4 || currentSlide == 6){
			jQuery('.slider_portal .slick-list').addClass('slick_height');
		}else{
			jQuery('.slider_portal .slick-list').removeClass('slick_height');
		}
	});
	
	var inputQuantity = [];
	$(".question_year").each(function(i) {
		inputQuantity[i]=this.defaultValue;
		$(this).data("idx",i); // save this field's index to access later
	});
	  
    $(".question_year").on("keyup", function (e) {
		var $field = $(this),
		val=this.value,
		$thisIndex=parseInt($field.data("idx"),10); // retrieve the index
        if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
            this.value = inputQuantity[$thisIndex];
            return;
        }
        if (val.length > Number($field.attr("maxlength"))) {
          val=val.slice(0, 4);
          $field.val(val);
        }
        inputQuantity[$thisIndex]=val;
	});
	
	
/* 4-3-2022 start new screen changes */
	var slider_class = $(".slider_portal");
	var display_error = $('#step_main .thanks_portal_error').html('Pleae choose any one.');
	var display_error_step_1 = $('#start_step_1 .thanks_portal_error').html('Pleae choose any one.');
	
	// main step
	$('.thanks_portal input[type=radio][name=step_main]').change(function(){
		var step_one_val = $(this).val();
		var business_portal = $(this).attr('business_portal');
		$('#account_set_up input[name="business_portal"]').val(business_portal);

		$('.business_portal input[name="business_portal"]').val(business_portal);

		$('#undecided_portal input[name="business_portal"]').val(business_portal);
		display_error.hide();
		if(step_one_val == 'start'){
			slider_class.slick('slickGoTo', 2);
		}else if(step_one_val == 'manage_grow'){
			slider_class.slick('slickGoTo', 7);
		}else if(step_one_val == 'exit'){
			slider_class.slick('slickGoTo', 8);
		}else{
			if(display_error != ''){
				display_error.show();
			}else{
				display_error.hide();
			}
		}
	});
	
	// next button main screen
		$('#step_main .thanks-next').on('click', function(e){
			e.preventDefault();
			var next_btn_val = $('.thanks_portal input[type=radio][name=step_main]:checked').val();
			if(next_btn_val == 'start'){
				slider_class.slick('slickGoTo', 2);
			}else if(next_btn_val == 'manage_grow'){
				slider_class.slick('slickGoTo', 7);
			}else if(next_btn_val == 'exit'){
				slider_class.slick('slickGoTo', 8);
			}else{
				if(display_error != ''){
					display_error.show();
				}else{
					display_error.hide();
				}
			}
		});
	
	
	// step_1 5,6,7,8 change
		$('.thanks_portal input[type=radio][name=step_1]').change(function(){
			var step_one_val = $(this).val();
			var business_portal = $(this).attr('business_portal');
			$('#account_set_up input[name="business_portal"]').val(business_portal);
			$('.business_portal input[name="business_portal"]').val(business_portal);
			$('#undecided_portal input[name="business_portal"]').val(business_portal);
			if(step_one_val == 'startup'){
				$('.thanks_portal_error').hide();
				slider_class.slick('slickGoTo', 3);
			}else if(step_one_val == 'buy'){
				$('.thanks_portal_error').hide();
				slider_class.slick('slickGoTo', 4);
			}else if(step_one_val == 'franchise'){
				$('.thanks_portal_error').hide();
				slider_class.slick('slickGoTo', 5);
			}else if(step_one_val == 'undecided'){
				$('.thanks_portal_error').hide();
				slider_class.slick('slickGoTo', 6);
			}else{
				if(display_error_step_1 != ''){
					display_error_step_1.show();
				}else{
					display_error_step_1.hide();
				}
			}
		});
		
	// step_1 next button click
		$('#start_step_1 .thanks-next').on('click', function(e){
			e.preventDefault();
			var step_1_val = $('.thanks_portal input[type=radio][name=step_1]:checked').val();
			if(step_1_val == 'startup'){
				slider_class.slick('slickGoTo', 3);
			}else if(step_1_val == 'buy'){
				slider_class.slick('slickGoTo', 4);
			}else if(step_1_val == 'franchise'){
				slider_class.slick('slickGoTo', 5);
			}else if(step_1_val == 'undecided'){
				slider_class.slick('slickGoTo', 6);
			}else{
				if(display_error_step_1 != ''){
					display_error_step_1.show();
				}else{
					display_error_step_1.hide();
				}
			}
		});
	
	// back button main step
	$('#step_main .thanks-previous').on('click', function(e){
		e.preventDefault();
		slider_class.slick('slickGoTo', 0);
	});
	
	// back button start_step_1
	$('#start_step_1 .thanks-previous, #owner_mange .back_btn, #start_step_3 .thanks-previous').on('click', function(e){
		e.preventDefault();
		slider_class.slick('slickGoTo', 1);
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 500, 'swing', function() {
		});
	});
	
	// back back_btn_id_two click
	$('#start_number .back_btn, #welcome_portal_buy .back_btn, #welcome_portal_franchise .back_btn, #undecided_portal .back_undecided, #owner_mange .back_undecided').click(function(e){
		e.preventDefault();
		slider_class.slick('slickGoTo', 2);
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 500, 'swing', function() {
		});
		$('.slick-list.slick_height').removeClass('have_you_height');
		$('.slick-list.slick_height').removeClass('have_determined_height');
		$('.slick-list.slick_height').removeClass('physical_height');
		
		$('.slick-list.slick_height').removeClass('buy_have_you_height');
		$('.slick-list').removeClass('physical_height_franchise');
		
	});
	
	// step_3 18,20 change next
	$('#start_step_3 input[type=radio][name=step_3]').change(function(){
		var step_one_val = $(this).val();
		var business_portal = $(this).attr('business_portal');
		$('#account_set_up input[name="business_portal"]').val(business_portal);
		$('.thanks_portal_error').hide();
		if(step_one_val == 'selling_business'){
			slider_class.slick('slickGoTo', 9);
		}else if(step_one_val == 'closing_business'){
			slider_class.slick('slickGoTo', 10);
		}else{
			console('please select one.');
		}
	});
	
	// step_3 18,20 click next
	$('#start_step_3 .thanks-next').on('click', function(e){
		e.preventDefault();
		var step_3_check_val = $('#start_step_3 input[type=radio][name=step_3]:checked').val();
		if(step_3_check_val == 'selling_business'){
			slider_class.slick('slickGoTo', 9);
		}else if(step_3_check_val == 'closing_business'){
			slider_class.slick('slickGoTo', 10);
		}else{
			$('#start_step_3 .thanks_portal_error').show();
		}
	});
		
	// back button sell
	$('#portal_sell .back_btn, #welcome_portal_close .back_btn').on('click', function(e){
		e.preventDefault();
		slider_class.slick('slickGoTo', 8);
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 500, 'swing', function() {
		});
	});

	// back btn if retail screen

	if($('body').hasClass('firstscreen_last_scrren')){

		//$('.slick-slide').each(function(index){

			$('#retails_screen .back_btn').on('click', function(e){
				e.preventDefault();
				var back_screen = $(this).attr('back_screen');
				slider_class.slick('slickGoTo', back_screen);

				if($('#start_number .sourced input[type=radio][name=physical_site]:checked').val() == 'Yes'){
					$('.submit_aluser').hide();
				}else if($('#welcome_portal_buy .sourced input[type=radio][name=physical_site]:checked').val() == 'Yes'){
					$('.submit_aluser').hide();
				}else if($('#welcome_portal_franchise .sourced input[type=radio][name=physical_site]:checked').val() == 'Yes'){
					$('.submit_aluser').hide();
				}else{
					$('.submit_aluser').show();
				}
				
			});
		//});
	}else{
		$('.slider_portal #account_set_up a.back_undecided, #retails_screen .back_btn').on('click', function(e){
			e.preventDefault();
			var back_screen = $(this).attr('back_screen');
			slider_class.slick('slickGoTo', back_screen);

		});
	}

	
	$('.slider_portal').on('afterChange', function(event, slick, currentSlide, nextSlide){
		if(currentSlide == 5 || currentSlide == 7 || currentSlide == 12){
			$('.slick-list').addClass('auto_height');
		}else{
			$('.slick-list').removeClass('auto_height');
		}
		if(currentSlide == 12){
			$('.slick-list').addClass('auto_height_last');
		}else{
			$('.slick-list').removeClass('auto_height_last');
		}
	});
	
	$('a.do_not_action_update').on('click', function(e){
		e.preventDefault();
		$('.checkbox_update_email').toggle();
	});


	// already user questioner
	$('a.submit_aluser.next-screen').click(function(e){
		e.preventDefault();
		radiovalidation();
	});


});
