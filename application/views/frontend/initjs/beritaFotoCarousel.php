<script>
    $(document).ready(function(){
        $('.carousel-image-content').click(function(e){
            e.preventDefault();
            $(this).closest('.carousel-image').find('.active').removeClass('active');
            $(this).addClass('active');
            var image = e.currentTarget.href;
            var caption = $(this).data('caption');
            $('#main-image-content').attr('src',image);
            $('#main-image-caption').html(caption);
        });
    });
</script>