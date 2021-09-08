<div class=" p-0 m-0 bg_dark_c">
    <div class="container">
        <div class="row pb-3 pt-5">
            <div class="col-12 col-md-4 mb-3">
                <ul class="pl-0">
                    <li class="list-unstyled">
                        <a href="https://kupastuntas.co/">
                            <img src="<?= base_url() ?>assets/frontend/images/logo/logo footer 1.png" width="200" alt="Kupas Tuntas">
                        </a>
                    </li>
                    <li class="mt-3 list-unstyled">
                        <a href="https://berdikari.co/">
                            <img src="<?= base_url() ?>assets/frontend/images/logo/logo-footer-2.png" width="200" alt="Berdikari">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4 text_14 mb-3 address">
                <ul class="pl-0">
                    <li class="list-unstyled">
                        <a href="" class="text-decoration-none d-flex">
                            <i class="text-primary fas fa-map-marker-alt mr-2"></i> Jalan Turi Raya, No. 101, Tanjung
                            Senang, Kota Bandar Lampung, Lampung. </a>
                    </li>
                    <li class="list-unstyled mt-2">
                        <a href="" class="text-decoration-none d-flex align-items-center">
                            <i class="text-primary fas fa-phone-square-alt mr-2"></i> (0721) 773331 </a>
                    </li>
                    <li class="list-unstyled mt-2">
                        <a href="" class="text-decoration-none d-flex align-items-center">
                            <i class="text-primary fas fa-envelope mr-2"></i> kupastuntas7@gmail.com </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center">
                <div class="align-self-center icon">
                    <a href="#" class="h5 mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="h5 mr-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="h5"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="bg_grey_c">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-white mb-md-0 text-center text-md-left">
                <p class="my-3 text_14">&copy; berdikari.co All Right Reserved</p>
            </div>
            <div class="divider w-50 mx-auto d-md-none"></div>
            <div class="col-12 col-md-6">
                <ul class="d-flex justify-content-center p-0 justify-content-md-end my-3">
                    <li class="list-unstyled mr-3">
                        <a class="text-white text-decoration-none text-primary text_14" href="about.html">Tentang
                            Kami</a>
                    </li>
                    <li class="list-unstyled mr-3">
                        <a class="text-white text-decoration-none text_14" href="kontak-kami">Kontak Kami</a>
                    </li>
                    <li class="list-unstyled">
                        <a class="text-white text-decoration-none text_14" href="redaksi.html">Redaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
</main>
<script src="assets/frontend/js/jquery.min.js"></script>
<script src="assets/frontend/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.card_tv_select a').click(function(e) {
            $('.card_tv_select').removeClass('active');
            e.preventDefault();
            var video = $(this).data('video');
            var desc = $(this).data('desc');
            var title = $(this).data('title');

            var x = $('#playVid').attr('src', 'https://www.youtube.com/embed/' + video);
            $('.wrap_title_yt').find('h5').html(title);
            $('.wrap_title_yt').find('p').html(desc);
            $(this).closest('.card_tv_select').addClass('active');
        });

        $('.navbar-toggler').on('click', function() {
            $('#navbarNavAltMarkup').addClass('show');
            $('.ic').removeClass('d-none');
        });

        $('#close').click(function() {
            $('.show').removeClass('show').addClass('collapse navbar-collapse');
            $('#navbarNavAltMarkup').addClass('collapse navbar-collapse');
            $('.ic').addClass('d-none');
        });

    });
</script>
<?php
if (isset($javascripts)) :
    foreach ($javascripts as $src) :
?>
        <script src="<?php echo $src; ?>"></script>
<?php
    endforeach;
    unset($javascripts, $src);
endif;
if (isset($scripts) && is_array($scripts) && count($scripts) > 0) :
    foreach ($scripts as $key => $script) :
        echo $script;
    endforeach;
    unset($scripts, $key, $script);
endif;
?>
</body>

</html>