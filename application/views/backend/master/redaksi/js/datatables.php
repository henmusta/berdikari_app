<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
$(function(){
	'use strict'
	$(document).ready(function(){

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
									$.notify({icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'},{type: 'danger'});
								},
								success : function(response) {
									if ( response.status == "success" ){
										$.notify({icon: 'fa fa-check mr-1', message: response.message},{type: 'success'});
										iTable.ajax.reload( null, false );
									} else {
										$.notify({icon: 'fa fa-exclamation mr-1', message: response.message},{type: 'danger'});
									}
								}
							});
						}
					});
				});
			}

		});
	});
});
</script>
