jQuery(document).ready(function($){
	$('.main_div').click(function(){
		var ids = $(this).attr('id');
		$('.hideDiv').each(function(){
			$(this).removeClass('ActiveD');
		});
		$('.main_div').each(function(){
			$(this).removeClass('downArr');
		});
		$('.'+ids).toggleClass('ActiveD');
		$('#'+ids).toggleClass('downArr');
	});
	
	const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var d = new Date();
	var m = monthNames[d.getMonth()];;
	var td = d.getDate();
	var y = d.getFullYear();
	var mon = d.getMonth()+1;

	var $checkboxes = $('.checkbox');
	$checkboxes.on('change', function(){
		var cur_check = $(this);
		var post_id = cur_check.attr('post_id');
		var id = cur_check.attr('id');
		var date = m +" "+ td;
		var progress_number = $('.per_com').text();
		var ajaxurl = ajax_owneraction_object.ajax_url;
		if(cur_check.is(':checked')){
			var t_progress = parseFloat(progress_number) + 1;
			$('.progress-bar').css('width', t_progress + '%');
			$('.per_com').text(t_progress);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: {	action: 'dashboard_user_completed',
						post_id : post_id,
						total_progress : 1,
						date : date,
					},
				success: function(message){
					var forlabel = jQuery('.input_col label[for=' + id + ']');
					forlabel.addClass('task_completed_line');
					forlabel.after('<span>'+ message.msg +' '+ date +'</span>')
					var aside = forlabel.closest('aside');
					aside.addClass('success');
					setTimeout(function() {
						aside.removeClass('success');
						window.location.reload();
					}, 2500);
					
				}
			});
		}
	});
	
	//dashboard_user_completed_unchecked
	var $complete_checkbox = $('.complete_checkbox');
	$complete_checkbox.on('change', function(){
		var cur_check = $(this);
		var post_id = cur_check.attr('post_id');
		var id = cur_check.attr('id');
		var date = m +" "+ td;
		var progress_number = $('.per_com').text();
		var ajaxurl = ajax_owneraction_object.ajax_url;
		if(cur_check.is(':checked')){
			var t_progress = parseFloat(progress_number) + 1;
			$('.progress-bar').css('width', t_progress + '%');
			$('.per_com').text(t_progress);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: {	action: 'dashboard_user_completed_unchecked',
						post_id : post_id,
						total_progress : 1,
					},
				success: function(message){
					var forlabel = jQuery('.input_col label[for=' + id + ']');
					forlabel.removeClass('task_completed_line');
					//forlabel.after('<span>'+ message.msg +'</span>')
				}
			});
		}else{
			var t_progress = parseFloat(progress_number) + 1;
			$('.progress-bar').css('width', t_progress + '%');
			$('.per_com').text(t_progress);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: {	action: 'dashboard_user_completed_unchecked',
						post_id : post_id,
						total_progress : 1,
					},
				success: function(message){
					$('.view_details_loading #overlay').hide();
					$('.view_details_submit').show();
					$('.close').trigger('click');
					setTimeout(function(){
						window.location.reload();
					}, 2500);
				}
			});
		}
	});
	
	$('.infor-mation-sec').find('.provider.more-note').each(function(){
		$(this).click(function(event){
			event.preventDefault();
			var id = $(this).find('a').attr('href');
			$(id).show();
		});
	});
	
	$(".close, #edit_notes_form .cancel").click(function(e){
		e.preventDefault();
		$('.footer_nav_popup').hide();
		$('body').removeClass('popup_overflow');
	});
	
	//// hide all times and then show the first 4
	var hideTimes = function() {
		$('.tax-card.dash_cl').each(function () {
			$(this).children('aside.openaside').hide().filter(':lt(4)').show();
		});
	}

	// show all times
	var showTimes = function() {
		$('.tax-card.dash_cl > aside').show();
	}
	
	$('.open-on').on('click', '.show', function (e) {
		e.preventDefault();
		showTimes();
		$(this).html('View all').addClass('hide').removeClass('show');
	});

	$('.open-on').on('click', '.hide', function () {
		hideTimes();
		$(this).html('View all').addClass('show').removeClass('hide');
	});
	hideTimes();
	
	// view_details_popup
	$('.update_slide, .show_completed_task').find('a.view_details_popup, label.label_class_popup').each(function(){
		$(this).click(function(event){
			event.preventDefault();
			var id = $(this).attr('id');
			$('.view_details_popup_show_' + id).show();
			$('body').addClass('popup_overflow');
		});
	});
	
	//view_details_popup_ajax
	var $mark_it_done_check = $('.mark_it_done_check');
	$mark_it_done_check.on('change', function(){
		var cur_check = $(this);
		var post_id = cur_check.attr('post_id');
		var id = cur_check.attr('id');
		var date = m +" "+ td;
		var progress_number = $('.per_com').text();
		var ajaxurl = ajax_owneraction_object.ajax_url;
		if(cur_check.is(':checked')){
			var t_progress = parseFloat(progress_number) + 1;
			$('.progress-bar').css('width', t_progress + '%');
			$('.per_com').text(t_progress);
			$('.view_details_loading #overlay').show();
			//$('.view_details_submit').hide();
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: {	action: 'dashboard_user_completed',
						post_id : post_id,
						total_progress : 1,
						date : date,
					},
				success: function(message){
					$('.view_details_loading #overlay').hide();
					//$('.view_details_submit').show();
					setTimeout(function () {
						$('.close').trigger('click');
						window.location.reload();
						$('html, body').animate({
							scrollTop: $('.update_slide').offset().top
						}, 500);
					}, 3000);
				}
			});
		}
	});
	
	//save button click
	$('.notes_form_popup .view_details_submit input[type="submit"]').click(function(e){
		e.preventDefault();
		var parent_div = $(this).closest('.footer_nav_popup');
		var due_date = parent_div.find('input[type="date"]');
		var post_id_checkbox = parent_div.find('input[type="checkbox"]');
		var overlay = parent_div.find('.view_details_loading #overlay');
		
		var post_id = post_id_checkbox.attr('post_id');
		var date_val = due_date.val();
		if(date_val != ''){
			var ajaxurl = ajax_owneraction_object.ajax_url;
			overlay.show();
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl, 
				data: {	action: 'dashboard_user_due_date_saved_function',
						post_id : post_id,
						total_progress : 1,
						date : date_val,
					},
				success: function(message){
					//$('.close').trigger('click');
					setTimeout(function () {
						$('.close').trigger('click');
						window.location.reload();
						$('html, body').animate({
							scrollTop: $('.update_slide').offset().top
						}, 500);
					}, 3000);
					
				}
			});
		}else{
			due_date.css('border','1px solid red');
		}
	});
	
	
	// notes_popup
	$('.more-note').find('a').each(function(){
		$(this).click(function(event){
			event.preventDefault();
			var id = $(this).attr('id');
			if(id){
				$('.notes_popup_show_' + id).show();
			}else{
				$('.notes_popup_show').show();
			}
		});
	});
	
	var notes_form = $('#notes_form');
    notes_form.validate({
        rules: {
            title: {
                required: true
            },
            description: {
                required: true
            }
        },
        messages: {
            title: {
                required: 'Please Enter title'
            },
            description: {
                required: 'Please Enter description'
            }
        }
    });
	$('#notes_form input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
        if(notes_form.valid()){
            var notes_formdata = notes_form.serialize();
			$('#notes_form .view_details_loading #overlay').show();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajaxurl,
                data: notes_formdata+'&action=notes_add_ajax',
                success: function(message){
					if(message.type == 'succes'){
						$('#notes_form').after(message.msg);
						setTimeout(function () {
							$('.notes_popup .close').trigger('click');
							window.location.reload();
							$('html, body').animate({
								scrollTop: $('.provider.more-note').offset().top
							}, 500);
						}, 3000);
					}else{
						$('#notes_form').after(message.msg);
					}
                }
			});
        }
    });
	var edit_notes_form = $('#edit_notes_form');
	$('#edit_notes_form input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		var edit_notes_formdata = edit_notes_form.serialize();
		$('#edit_notes_form .view_details_loading #overlay').show();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: edit_notes_formdata+'&action=notes_edit_ajax',
			success: function(message){
				if(message.type == 'succes'){
					$('#edit_notes_form').after(message.msg);
					setTimeout(function () {
						$('.notes_popup .close').trigger('click');
						window.location.reload();
						$('html, body').animate({
							scrollTop: $('.provider.more-note').offset().top
						}, 500);
					}, 3000);
				}else{
					$('#edit_notes_form').after(message.msg);
				}
			}
		});
    });
 
	$('#edit_notes_form a.remove_item').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
        var post_id = $('#edit_notes_form #post_id').val();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: {
					action : 'notes_remove_ajax',
					post_id : post_id
				},
			success: function(message){
				if(message.type == 'succes'){
					$('#edit_notes_form').after(message.msg);
					setTimeout(function () {
						$('.notes_popup .close').trigger('click');
						window.location.reload();
						$('html, body').animate({
							scrollTop: $('.provider.more-note').offset().top
						}, 500);
					}, 3000);
				}else{
					$('#edit_notes_form').after(message.msg);
				}
			}
		});
    });
	
	$("#search_items").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".infor-mation-sec .update_slide .your-idea").filter(function(){
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
	
	$('#show_completed_check').on('change', function(){
		var $this = $(this);
		if($this .is(':checked')){
			$('.complete_ids').addClass('complete_ids_line');
		}else{
			$('.complete_ids').removeClass('complete_ids_line');
		}
	});
		
	$(".moreBox").slice(0, 8).show();
	if ($(".blogBox:hidden").length != 0){
		$("#loadMore").show();
	}   
	$("#loadMore").on('click', function (e){
		e.preventDefault();
		$(".moreBox:hidden").slice(0, 40).slideDown();
		if($(".moreBox:hidden").length == 0){
			$("#loadMore").fadeOut('slow');
		}
	});
	
	$('.footer_nav_popup .cancel').click(function(e){
		e.preventDefault();
		$('.close').trigger('click');
	});
	
	var dtToday = new Date();
    var months = dtToday.getMonth() + 1;
    var days = dtToday.getDate();
    var years = dtToday.getFullYear();
    if(months < 10)
        months = '0' + months.toString();
    if(days < 10)
        days = '0' + days.toString();
    var maxDate = years + '-' + months + '-' + days;
    $('.notes_form_popup .due_date .datepicker').attr('min', maxDate);
});