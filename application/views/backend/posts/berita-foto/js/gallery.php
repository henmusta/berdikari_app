<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
Dropzone.autoDiscover = false;
$(function(){
	'use strict'
	$(document).ready(function(){
		var iTable = $("table#<?php echo $datatable['id'];?>").DataTable({
			lengthMenu		: [[5, 10, 25, 50, 100, -1], ["5", "10", "25", "50", "100", "All"]],
			displayLength 	: <?php echo (int)$datatable['display_length'];?>,
			order			: [[ <?php echo (int)$datatable['order_column']['number'];?>, '<?php echo $datatable['order_column']['dir'];?>' ]],
			columns 		: [<?php foreach($datatable['columns'] AS $column) : echo $column; endforeach; ?>],
			processing 		: true,
			serverSide 		: true,
			ajax:{
				url 		: "<?php echo $datatable['source_url'];?>", 
				type 		: "POST",
				data 		: function(d){
					d.post_id = <?php echo $data['post_id']?>;
					return d;
				}
			},
			initComplete 	: function(settings, json) {
				$('#<?php echo $datatable['id'];?>_filter input').unbind();
					$('#<?php echo $datatable['id'];?>_filter input').bind('keyup', function(e) {
					if(e.keyCode == 13) {
						iTable.search( this.value ).ajax.reload();
					}
				}); 
			},
			drawCallback 	: function(){
				$(iTable.table().node()).find('.x-editable').editable({
					success: function(response, newValue) {
						iTable.ajax.reload( null, false );
						One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response});
					},
					error: function(errors) {
						One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: errors.responseText});
					}
				});
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
								url: "<?php echo $datatable['delete_url'];?>",
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
		$('#<?php echo $dropzone['id'];?>').dropzone({
			success : function(file,response){
				let dz = this;
				setTimeout(function(){
					dz.removeFile(file);
				},1000);
			},
			queuecomplete : function(){
				let dz = this;
				setTimeout(function(){
					iTable.ajax.reload();
				},1000);				
			}
		});
	});
});
</script>