<div class="container mt-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb text-uppercase font-weight-bold">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
        </ol>
    </nav>
</div>

<section class="hero container">
    <div class="row hero_news">
        <div class="col-12 col-lg-7 col-xl-8">
            <div class="row indeks">
                <?php foreach (array_slice($lists, 0, 1) as $val) { ?>
                    <div class="col-12 mx-0 mb-4">
                        <div class="wrap_top">
                            <div class="wrap_img_top">
                                <img src="<?php echo $val['image_medium'] ?>" alt="<?php echo $val['title']; ?>">
                            </div>
                            <div class="wrap_title_top">
                                <p class="m-0 p-0 d-flex text_14 align-items-center">
                                    <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                                </p>
                                <a href="<?php echo $val['url']; ?>" class="mt-1"><?php echo $val['title']; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php $no = $this->uri->segment('3') + 1;
                foreach (array_slice($lists, 4) as $val) {
                    $no++; ?>
                    <div class="col-12 col-md-6 mb-3">
                        <figure class="figure w-100">
                            <div class="figure-img">
                                <img src="<?php echo $val['image_medium'] ?>" class=" img-fluid rounded" alt="<?php echo $val['title']; ?>">
                            </div>
                            <p class="m-0 p-0 d-flex text_14 align-items-center">
                                <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                            </p>
                            <a href="<?php echo $val['url']; ?>"><?php echo $val['title']; ?></a>
                            <figcaption class="figure-caption mt-1"><?php echo $val['date']; ?></figcaption>
                        </figure>
                    </div>
                <?php } ?>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <?= $links; ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan border_left font-weight-bold pl-2">BERITA PILIHAN</h5>
                <a href="<?= base_url(); ?>berita-pilihan" class="text-decoration-none text-primary">Lihat Lainnya <i class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>
            <div class="box_news mt-4">
                <?php $nomor = 1;
                foreach (array_slice($lists, 6) as $val) { ?>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?php echo $val['image_small'] ?>" alt="<?php echo $val['title']; ?>">
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
                <?php } ?>
                <div class="row mt-5">
                    <div class="col-12">
                        <img src="<?= base_url(); ?>assets/frontend/images/adv/iklan-3.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- <div class="sidebar_banner">
    <ul class="banner">
        <li><?php echo isset($this->ads['home_sidebar_1']) ? $this->ads['home_sidebar_1'] : NULL; ?></li>
        <li><?php echo isset($this->ads['home_sidebar_2']) ? $this->ads['home_sidebar_2'] : NULL; ?></li>
        <li><?php echo isset($this->ads['home_sidebar_3']) ? $this->ads['home_sidebar_3'] : NULL; ?></li>
        <li><?php echo isset($this->ads['home_sidebar_4']) ? $this->ads['home_sidebar_4'] : NULL; ?></li>
    </ul>
</div> -->