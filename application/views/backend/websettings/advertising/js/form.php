<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
$(function(){
	'use strict'
	$(document).ready(function(){
		if( $(".form-image-input").length > 0 ){
			$(".form-image-input").change(function () {
				var thumb = $(this).closest('.form-image-container').find('img');
				if (this.files && this.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						thumb.attr('src', e.target.result);
					}
					reader.readAsDataURL(this.files[0]);
				}
			});
		}

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
					url 		: '<?php echo $action_url ?>',
					data 		: new FormData(form),
					dataType	: 'JSON',
					beforeSend:function() { 
						btnSubmit.addClass("disabled").html("<i class='fas fa-spinner fa-pulse fa-fw'></i> Loading ... ");
					},
					error 		: function(){
						btnSubmit.removeClass("disabled").html(btnSubmitHtml);
						$.notify({icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'},{type: 'danger'});
					},
					success 	: function(response) {
						btnSubmit.removeClass("disabled").html(btnSubmitHtml);
						let timeout = 1000;
						if( response.upload_messages !== '' && response.upload_messages !== null ){
							$.notify({icon: 'fa fa-check mr-1', message: response.upload_messages},{type: 'warning'});
							timeout = 3000;
						}
						if ( response.status == "success" ){
							$.notify({icon: 'fa fa-check mr-1', message: response.message},{type: 'success'});
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
							$.notify({icon: 'fa fa-exclamation mr-1', message: response.message},{type: 'danger'});
						}
					}
				});
			}
		});

		function showHide(){
			let type = $('#type').val();
			if(type == 'script'){
				$('#banner-script').show();
				$('#banner-image').hide();
			} else {
				$('#banner-script').hide();
				$('#banner-image').show();
			}
		}
		showHide();
        $('#type').on('change', function (e) {
			showHide();
        });

	});
});
</script>