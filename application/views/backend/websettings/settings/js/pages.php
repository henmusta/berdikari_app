<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
$(function(){
	'use strict'
	$(document).ready(function(){
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control form-control-lg';
		$(".editable").editable({
			ajaxOptions: {
				type: "POST",
				dataType: "json"
			},
			success: function(response) {
				if ( response.status == "success" ){
					One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});

				} else {
					One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: response.message});
				}
			}
		});

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

		if( $(".form-favicon-input").length > 0 ){
			$(".form-favicon-input").change(function () {
				var thumb = $(this).closest('.form-favicon-container').find('img');
				if (this.files && this.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						thumb.attr('src', e.target.result);
					}
					reader.readAsDataURL(this.files[0]);
				}
			});
		}

		$( "#form-image-favicon" ).validate({
			submitHandler: function(form,eve) {
				eve.preventDefault();
				var myform = $(form);
				var btnSubmit = myform.find("[type='submit']");
				var btnSubmitHtml = btnSubmit.html();
				var url = myform.attr("action");
				var data = new FormData(form);
				$.ajax({
					beforeSend:function() { 
						btnSubmit.addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ... ").prop("disabled","disabled");
					},
					cache: false,
					processData: false,
					contentType: false,
					type: "POST",
					url : url,
					data : data,
					dataType:'JSON',
					success:function(response) {
						btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
						let timeout = 1000;
						if( response.upload_messages !== '' && response.upload_messages !== null ){
							One.helpers('notify', {type: 'warning', icon: 'fa fa-check mr-1', message: response.upload_messages});
							timeout = 3000;
						}
						if ( response.status == "success" ){
							One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
							setTimeout(function(){
								location.reload();
							},timeout);
						} else {
							One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: response.message});
						}
					}
				});
			}
		});
		
		$( "#form-image-logo" ).validate({
			submitHandler: function(form,eve) {
				eve.preventDefault();
				var myform = $(form);
				var btnSubmit = myform.find("[type='submit']");
				var btnSubmitHtml = btnSubmit.html();
				var url = myform.attr("action");
				var data = new FormData(form);
				$.ajax({
					beforeSend:function() { 
						btnSubmit.addClass("disabled").html("<i class='fa fa-spinner fa-pulse fa-fw'></i> Loading ... ").prop("disabled","disabled");
					},
					cache: false,
					processData: false,
					contentType: false,
					type: "POST",
					url : url,
					data : data,
					dataType:'JSON',
					success:function(response) {
						btnSubmit.removeClass("disabled").html(btnSubmitHtml);
						let timeout = 1000;
						if( response.upload_messages !== '' && response.upload_messages !== null ){
							One.helpers('notify', {type: 'warning', icon: 'fa fa-check mr-1', message: response.upload_messages});
							timeout = 3000;
						}
						if ( response.status == "success" ){
							One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
							setTimeout(function(){
								location.reload();
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