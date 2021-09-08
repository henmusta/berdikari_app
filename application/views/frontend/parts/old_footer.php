<section class="py-4">
    <div class="container">
        <div id="4317fd49a21384c85f6b405cba038e21"></div>
    </div>
</section>
<footer>
    <div class="foot-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 logo">
                    <a href="">
                        <img src="uploads/logo.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-sm-4 address-info">
                    <ul>
                        <li><a href=""><i class="fas fa-map-marker-alt"></i><p>Jalan Turi Raya, No. 101, Tanjung Senang, Kota Bandar Lampung, Lampung.</p></a></li>
                        <li><a href=""><i class="fas fa-phone-square-alt"></i><p>(0721) 773331</p></a></li>
                        <li><a href=""><i class="fas fa-envelope"></i><p>kupastuntas7@gmail.com</p></a></li>
                    </ul>
                </div>
                <div class="col-sm-4 socialmedia-link">
                    <ul>
                        <li><a href="<?php echo $metadata['facebook_url'] ?>"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?php echo $metadata['instagram_url'] ?>"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="<?php echo $metadata['twitter_url'] ?>"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCP1Kev8dPb-rQDxSJhG_zgA"><i class="fab fa-youtube"></i></a></li>
                        <!-- <li><a href="<?php echo $metadata['youtube_url'] ?>"><i class="fab fa-twitter"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 copyright-text">
                    <p>&copy; kupastuntas.co All Right Reserved</p>
                </div>
                <div class="col-sm-8 copyright-sitemap">
                    <ul>
                        <li><a href="<?php echo base_url('/page/tentang-kami')?>">Tentang Kami</a></li>
                        <li><a href="kontak-kami">Kontak Kami</a></li>
                        <li><a href="redaksi">Redaksi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" id="return-to-top"><i class="fas fa-chevron-up"></i></a>
</main>
<script src="<?php echo base_url();?>assets/new_frontend/js/frontend/vendor.js"></script>

<script src="<?php echo base_url();?>assets/new_frontend/js/frontend/plugins.js"></script>

<script src="<?php echo base_url();?>assets/new_frontend/js/frontend/main.js"></script>

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
        $('.list-video').click(function(e){
            e.preventDefault();
            var val = $(this).data('video');
            var title = $(this).data('title');
            var description = $(this).data('description');
            $('#boxview').attr('src', 'https://www.youtube.com/embed/'+val);
            $(this).closest('ul').find('.active').removeClass('active');
            $(this).parent().addClass('active');
            $('.main-video').find('h1').html(title);
            $('.main-video').find('p').html(description);
        });
        
    });
</script>
<?php 
if(isset($javascripts)): 
    foreach($javascripts AS $src) :
    ?><script src="<?php echo $src;?>"></script>
    <?php 
endforeach;
unset($javascripts,$src);
endif;
if( isset($scripts) && is_array($scripts) && count($scripts) > 0 ): 
    foreach($scripts AS $key => $script) :
        echo $script;
    endforeach;
    unset($scripts,$key,$script);
endif;
?>
</body>
</html>