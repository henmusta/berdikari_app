<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>

//add by pulung
document.tagUrl = '<?= base_url("tags/"); ?>';
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory(require('jquery'));
    } else {
        factory(window.jQuery);
    }
}(function ($) {
	$.extend($.summernote.plugins, {
		'tags':function(context){
			var self = this;
			var ui = $.summernote.ui;
			var $editor = context.layoutInfo.editor;
			var options = context.options;
			var lang = options.langInfo;
			var addListener = function(){
				$('body').on('click','#gt-link-approve',function(e){
					//e.stopPropagation();
					context.invoke('editor.restoreRange');
					var linkTitle = $('#gt-link-title').val();
					var linkKeyword = $('#gt-link-keywords').val();
					var linkStr = '<a href="'+ encodeURI(document.tagUrl+linkKeyword) +'">'+linkTitle+'</a>';
					context.invoke('editor.focus');
					context.invoke('editor.pasteHTML', linkStr);
					$('#gt-link-dialog').modal('hide');
					
				});
			};
			context.memo('button.tags',function(){
				var btn = ui.button({
					contents:'<i class="fa fa-tags"/> Tags',
					tooltip:'Tags',
					click:function(){
						$('#gt-link-title').val('');
						$('#gt-link-keywords').val('');
						context.invoke('editor.saveRange');
						$('#gt-link-dialog').modal('show');
					}
				});
				return btn.render();
			});
			this.events = {
				'summernote.init': function (we, e) {
                    addListener();
                },
                'summernote.keyup': function (we, e) {
                }
			};
			this.initialize = function(){
				this.$panel = $('<div class="modal fade" tabindex="-1" role="dialog" id="gt-link-dialog">'+
						'<div class="modal-dialog" role="document">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									'<h4 class="modal-title">Add Tags Hyperlink</h4>'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								'</div>'+
								'<div class="modal-body">'+
									'<div class="form-group note-form-group"><label class="note-form-label">Text to display</label><input type="text" id="gt-link-title" class="form-control"/></div>'+
									'<div class="form-group note-form-group"><label class="note-form-label">Keyword</label><input type="text" id="gt-link-keywords" class="form-control"/></div>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>'+
									'<button type="button" class="btn btn-sm btn-primary" id="gt-link-approve">Save</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>');
				this.$panel.appendTo('body');
			};
			this.destroy = function(){
				this.$panel.remove();
				this.$panel = null;
			};
			
		}
	})
}));

//end by pulung
	

$(function(){
	'use strict'
	$(document).ready(function(){
		var summernote_options = {
			height:400,
			focus: true,
			disableDragAndDrop:true,
			dialogsFade: true,
			dialogsInBody: true,
			lang: 'id-ID',
			//fontNames: ['Open Sans', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
			fontSizes : ['8','9','10','11','12','13','14','15','16','17','18','20','22','24','26','28','32','36','48','72'],
			toolbar: [
				['fontstyle', ['fontname','style','clear','fontsize' ,'height','color']],
				['paragraph', ['bold', 'italic', 'underline','paragraph','ul', 'ol','strikethrough', 'superscript', 'subscript']],
				['insert',['table','link','picture','video','hr']],
				['misc',['fullscreen','codeview','help','pageBreak','tags']]
			],
			popover: {
				image: [
					['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					['float', ['floatLeft', 'floatRight', 'floatNone']],
					['remove', ['removeMedia']]
				],
				link: [
					['link', ['linkDialogShow', 'unlink']]
				],
				air: [
					['color', ['color']],
					['font', ['bold', 'underline', 'clear']],
					['para', ['ul', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture']]
				]
			},
			buttons: {
				pageBreak: function (context) {
					var ui = $.summernote.ui;
					var button = ui.button({
						contents: '<i class="fa fa-edit"></i> Page Break',
						tooltip: 'Page Break',
						click: function () {
							$('#summernote').summernote('pasteHTML','<hr class="KT_PAGE_BREAK"/>');
						}
					});
					return button.render();
				}
			},
			codeviewFilter: false,
			codeviewIframeFilter: true
		}
		$('#summernote').summernote(summernote_options);
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
		$(".flatpickr").flatpickr({
			enableTime: true,
			time_24hr:true,
			dateFormat: "Y-m-d H:i",
		});
		$('#<?php echo $select2_categories['id']?>').select2({
			multiple:true,
			placeholder:'Please select one',
			ajax : {
				method : 'post',
				url : '<?php echo $select2_categories['url']?>'
			}
		});
		setTimeout(function(){
			console.log($('#<?php echo $select2_categories['id']?>').select2('data'));
		},300);
		$('#<?php echo $select2_authors['id']?>').select2({
			placeholder:'Please select one',
			ajax : {
				method : 'post',
				url : '<?php echo $select2_authors['url']?>'
			}
		});
		$('form#<?php echo $id;?>').validate({
            validClass      : 'is-valid',
            errorClass      : 'is-invalid',
            errorElement    : 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
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
        $('input[name="data[title]"]').rules("add",{
            remote: { 
                url     : "<?php echo $validation['check_title']?>", 
                type    : "POST",
                data 	: { 
					pk_except : $('input[name="pk"]').val()
				}
            },
            messages : { 
                remote: "Title has been used, please change other..",
            }
        });
	});
	$(document).on('pageinit',function(){
		$('form#<?php echo $id;?>').validate({
            validClass      : 'is-valid',
            errorClass      : 'is-invalid',
            errorElement    : 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
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
	});
});
</script>
