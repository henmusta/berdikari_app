<section class="hero container mt-5">
    <div class="row hero_news">
        <div class="col-12 col-lg-7 col-xl-8 mb-4">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i = 0;
                    foreach ($latest_news as $val) {
                        $i++ ?>
                        <div class="carousel-item active">
                            <div class="row">
                                <?php $no = 0;
                                foreach ($latest_news as $val) {
                                    $no++ ?>
                                    <?php if ($no == 1) : ?>
                                        <div class="col-12 mx-0">
                                            <div class="wrap_top">
                                                <div class="wrap_img_top">
                                                    <img src="<?php echo $val['image_large'] ?>" alt="Berita">
                                                </div>
                                                <div class="wrap_title_top">
                                                    <p class="m-0 p-0 d-flex text_14 align-items-center">
                                                        <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                                                    </p>
                                                    <a href="<?php echo $val['url'] ?>" class="mt-1"><?php echo $val['title']; ?></a>
                                                </div>
                                            </div>
                                            <div class="arrow mb-5">
                                                <div class="d-flex align-self-center">
                                                    <a class="carousel-control-prev ml-4" href="#carouselExampleFade" role="button" data-slide="prev">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                    <a class="carousel-control-next mr-4" href="#carouselExampleFade" role="button" data-slide="next">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>

                                <?php $no = 0;
                                foreach ($latest_news as $val) {
                                    $no++ ?>
                                    <?php if ($no > 1) : ?>
                                        <div class="col-12 mt-4 col-sm-6">
                                            <div class="wrap_top">
                                                <div class="wrap_img">
                                                    <img src="<?php echo $val['image_medium'] ?>" alt="Berita">
                                                </div>
                                                <div class="wrap_title">
                                                    <p class="m-0 p-0 d-flex text_14 align-items-center">
                                                        <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                                                    </p>
                                                    <a href="<?php echo $val['url'] ?>" class="mt-1"><?php echo $val['title']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan border_left font-weight-bold pl-2">BERITA PILIHAN</h5>
                <a href="<?= base_url() ?>berita-pilihan" class="text-decoration-none text-primary">Lihat Lainnya <i class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>
            <div class="box_news mt-4">
                <?php foreach ($option_news as $val) : ?>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?php echo $val['image_small'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-8 col-sm col-md ml-n1 pl-md-3 pl-lg-1 col-lg-8 pl-0">
                            <div class="box_title">
                                <a href="<?php echo $val['url'] ?>"><?php echo $val['title']; ?></a>
                                <p class="m-0 p-0 d-flex text_14 align-items-center">
                                    <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="divider my-4"></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="populer container mt-5">
    <div class="d-flex justify-content-between">
        <h5 class="title_pilihan border_left pl-2 font-weight-bold text-uppercase">Terpopuler</h5>
        <a href="<?= base_url() ?>populer" class="text-decoration-none text-primary">Lihat Lainnya <i class="fas fa-chevron-right text-muted ml-3"></i>
        </a>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <figure class="figure w-100">
                <div class="figure-img">
                    <img src="./assets/img/content/11.jpg" class="img-fluid rounded" alt="">
                </div>
                <p class="m-0 p-0 d-flex text_14 align-items-center">
                    <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                </p>
                <a href="#">Begini Kondisinya Ryan Jombang Usai Diduga Dianiaya Habib Bahar di LP Gunung Sindar</a>
                <figcaption class="figure-caption mt-1">Kamis / 21 Januari 2021</figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="epaper container mt-5">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-8">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan font-weight-bold border_left pl-2 text-uppercase">E-PAPER</h5>
                <a href="<?= base_url(); ?>e_paper" class="text-decoration-none text-primary">Lihat Lainnya <i class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>
            <div class="row">
                <?php $no = 0;
                foreach ($e_paper as $val) {
                    $no++ ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <a href="<?php echo $val['url'] ?>" class="text-decoration-none">
                            <img src="<?php echo $val['image_medium'] ?>" class="img-fluid" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="kupas_tv mt-5 py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h5 class="title_pilihan font-weight-bold border_left pl-2 text-uppercase">KUPAS TV</h5>
        </div>
        <div class="mt-3 row detail_news_yt">

            <?php $no = 0;
            foreach ($kupas_tv as $val) {
                $no++ ?>
                <?php if ($no == 1) : ?>
                    <div class="col-12 mb-3 mb-md-0 col-lg-8">
                        <div class="card border-0 rounded">
                            <div class="card-body box_video">
                                <div class="embed-responsive rounded embed-responsive-16by9">
                                    <iframe id="playVid" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $val['youtube_id']; ?>" allowfullscreen></iframe>
                                </div>
                                <div class="wrap_title_yt mt-3">
                                    <span>Kupas TV</span>
                                    <h5><?php echo $val['title']; ?></h5>
                                    <p class="text-muted"><?php echo $val['synopsis']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php } ?>

            <div class="col-12 col-lg-4 kupas_tv">
                <?php $no = 0;
                foreach ($kupas_tv as $val) {
                    $no++ ?>
                    <?php if ($no > 1) : ?>
                        <div class="card_tv_select mb-4">
                            <a href="<?php echo $val['url']; ?>" class="text-decoration-none" data-video="<?php echo $val['youtube_id']; ?>" data-title="<?php echo $val['title']; ?>" data-desc="<?php echo $val['synopsis']; ?>">
                                <div class="d-flex">
                                    <div class="wrap_thumb">
                                        <img src="<?php echo $val['image_medium']; ?>" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <h5 class="title_kupas_tv">KUPAS TV</h5>
                                        <h6><?php echo $val['title']; ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>