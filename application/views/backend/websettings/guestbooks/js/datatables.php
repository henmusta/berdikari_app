<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
$(function(){
	'use strict'
	$(document).ready(function(){
		$('#modalreset').on('show.bs.modal', function (event) {
		var id = $(event.relatedTarget).data('pk');
		$(this).find('.modal-body').find('input[name="pk"]').val(id);
		});

		$('#modalreset').on('hidden.bs.modal', function (e) {
			$(this).find('.modal-body').find('input[name="pk"]').val('');
		});

		var iTable = $("table#<?php echo $id;?>").DataTable({
			lengthMenu		: [[5, 10, 25, 50, 100, -1], ["5", "10", "25", "50", "100", "All"]],
			displayLength 	: <?php echo (int)$display_length;?>,
			order			: [[ <?php echo (int)$order_column['number'];?>, '<?php echo $order_column['dir'];?>' ]],
			columns 		: [<?php foreach($columns AS $column) : echo $column; endforeach; ?>],
			processing 		: true,
			serverSide 		: true,
			ajax:{
				url 		: "<?php echo $source_url;?>", 
				type 		: "POST"
			},
			initComplete 	: function(settings, json) {
				$('#<?php echo $id;?>_filter input').unbind();
					$('#<?php echo $id;?>_filter input').bind('keyup', function(e) {
					if(e.keyCode == 13) {
						iTable.search( this.value ).ajax.reload();
					}
				}); 
			},
			drawCallback 	: function(){
				$('.btn-delete').click(function(){
					let pk = $(this).data('pk');
					Swal.fire({
						title 	: "Are you sure?",
						text 	: "You will not be able to recover this data!",
						type 	: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, delete it!"
					}).then((result) => {
						if (result.value) {
							$.ajax({
								url: '<?php echo $delete_url;?>',
								type: "POST",
								data: { pk: pk },
								dataType: "json",
								error 	: function(){
									One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'});
								},
								success : function(response) {
									if ( response.status == "success" ){
										One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
										iTable.ajax.reload( null, false );
									} else {
										One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: response.message});
									}
								}
							});
						}
					});
				});
			}

		});

		$( "#form-reset" ).validate({
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