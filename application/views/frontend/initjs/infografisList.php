<script>
	$(document).ready(function(){
		function initInfografis(){
            $('.modal-image').click(function(e){
                e.preventDefault();
                var image = e.currentTarget.href;
                var caption = $(this).data('caption');
                var date = $(this).data('date');
                $('#modalInfografisImage').attr('src',image);
                $('#modalInfografisCaption').html(caption);
                $('#modalInfografisDate').html(date);
                $('#modalInfografis').addClass('d-block');
            });
            $('#modalInfografisClose').click(function(){
                $('#modalInfografis').removeClass('d-block');
            }); 
        }
        initInfografis();
		$('#btn-load').click(function(e){
			e.preventDefault();
			var href 	= $(this).attr('href'),
				page 	= $(this).attr('data-page')
				url 	=  href +'/'+ page;
			$.get( url, function( data ) {
				$('#lists-infografis').append(data);
		  		$('#btn-load').attr('data-page', (parseInt(page) + 1));
	  			initInfografis();
		  		setTimeout(function(){
		  			$('body').getNiceScroll().resize();
		  		}, 500);
			}).fail(function(){
				$('#btn-load').hide('slow');
			});			
		});
	})
</script>