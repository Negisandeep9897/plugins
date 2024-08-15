jQuery(document).ready(function($){
	$('#headers_order input[type="submit"]').click(function(e){
        e.preventDefault();
        var ajaxurl = ajax_owneraction_object.ajax_url;
		var order_data = $('#headers_order').serialize();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: order_data+'&action=orders_update_action',
			success: function(message){
				alert(message)
			}
		});
    });
	
	// delete users
	$('.question_portal table tr td a.del').click(function(e){
        e.preventDefault();
		var user_id = $(this).attr('user_id');
        var ajaxurl = ajax_owneraction_object.ajax_url;
		if(confirm("Are you sure you want to delete this?")){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: '&action=questions_users_del&user_id='+ user_id,
				success: function(message){
					alert(message)
					location.reload();
				}
			});
		}
    });
	
});