<script>
	$(document).ready(function(){
		$('#btn-load').click(function(e){
			e.preventDefault();
			var href 	= $(this).attr('href'),
				page 	= $(this).attr('data-page')
				url 	=  href +'/'+ page;
			$.get( url, function( data ) {
				$('#lists-berita').append(data);
		  		$('#btn-load').attr('data-page', (parseInt(page) + 1));
		  		setTimeout(function(){
		  			$('body').getNiceScroll().resize();
		  		}, 500);
			}).fail(function(){
				$('#btn-load').hide('slow');
			});			
		});
	})
</script>