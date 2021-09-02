<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
$(function(){
	'use strict'
	$(document).ready(function(){
		$('#<?php echo $select2_parent['id'];?>').select2({
			placeholder:'No Parent',
			allowClear:true,
			ajax : {
				method : 'post',
				url : '<?php echo $select2_parent['url'];?>'
			}
		});
		$('form#<?php echo $id;?>').validate({
			validClass 		: 'is-valid',
			errorClass		: 'is-invalid',
			errorElement	: 'span',
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');
				element.closest('.col-md-8').append(error);
			},
			highlight		: function(element, errorClass, validClass) {
				$(element).removeClass(validClass).addClass(errorClass)
				.closest('.form-group').children('label').removeClass('text-success').addClass('text-danger');
			},
			unhighlight		: function(element, errorClass, validClass) {
				$(element).removeClass(errorClass).addClass(validClass)
				.closest('.form-group').children('label').removeClass('text-danger').addClass('text-success');
			},
			submitHandler	: function(form,eve) {
				eve.preventDefault();
				var btnSubmit 		= $(form).find("[type='submit']"),
					btnSubmitHtml 	= btnSubmit.html();

				$.ajax({
					cache 		: false,
					processData : false,
					contentType : false,
					type 		: 'POST',
					url 		: '<?php echo $action;?>',
					data 		: new FormData(form),
					dataType	: 'JSON',
					beforeSend:function() { 
						btnSubmit.addClass("disabled").html("<i class='fas fa-spinner fa-pulse fa-fw'></i> Loading ... ");
					},
					error 		: function(){
						btnSubmit.removeClass("disabled").html(btnSubmitHtml);
						One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'});
					},
					success 	: function(response) {
						btnSubmit.removeClass("disabled").html(btnSubmitHtml);
						let timeout = 1000;
						if ( response.status == "success" ){
							One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
							setTimeout(function(){
								if(response.redirect == "" || response.redirect == "reload"){
									location.reload();
								} else if (response.redirect == "history.back()") {
									window.history.back();
								} else {
									location.href = response.redirect;
								}
							},timeout);
						} else {
							One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: response.message});
						}
					}
				});
			}
		});

	});
});
</script>