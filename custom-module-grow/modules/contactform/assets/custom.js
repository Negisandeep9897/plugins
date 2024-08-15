/*var $ = 'jQuery';
jQuery(document).ready(function($){
    $.validator.addMethod('noemail', function (value) {
        return /^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!hotmail\.com)(?!mail\.ru)(?!yandex\.ru)(?!mail\.com)([\w-]+.)+[\w-]{2,4})?$/.test(value);
    }, 'Free email addresses are not allowed.');
   
    $("#email_form_action").validate({
        rules: {
        	uabb_name:{
				required: true,
        	},
            uabb_email: {
                required: true,
                noemail: true
            },
        },
        messages: {
            uabb_email: {
                required: "Please enter email",
                noemail: "Please enter a business email address"
            },
            uabb_name: {
                required: "Please enter name",
            },
        },
        submitHandler: function(form) {
            console.log('emailok');
            var formData = $("#email_form_action").serialize();
         	jQuery.ajax({
			    type: "post",
			    dataType: "json",
			    url: my_ajax_object.ajax_url,
			    data: formData + "&action=contact_form_action",
			    success: function(msg){
			    	if(msg.msg_type == 'success'){
			    		 $('#msg').html('mail success.');
			    	}else{
			    		$('#msg').html('mail failed.');
			    	}
			        console.log(msg);
			       
			    }
			});
        }
    });
});*/