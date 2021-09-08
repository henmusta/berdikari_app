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
			}

		});
	});
});
</script>