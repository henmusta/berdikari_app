<script>
    $(document).ready(function(){
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
    });
</script>