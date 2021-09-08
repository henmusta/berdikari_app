<section class="container detail_news mt-5">
    <div class="row">
        <div class="col-12 col-lg-8 mb-5">
            <div class="title_detail_news">
                <p class="m-0 p-0 d-flex text_14 align-items-center">
                    <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $cat_title; ?></span>
                </p>
                <p class="m-0 text-muted font-weight-normal mt-2 text_14"><?= $date; ?></p>
                <h5><?= $title; ?></h5>
            </div>
            <div class="card bg-light border-0 mb-3 mt-3">
                <div class="card-body text-muted p-3 d-flex justify-content-between">
                    <p class="m-0 text_14">Oleh <span class="text-primary"><?= $author_fullname; ?></span></p>
                    <span class="text-primary"><i class="fas fa-eye mr-1 text-muted"></i><?= isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></span>
                </div>
            </div>
            <figure class="figure w-100">
                <img src="<?= $image_large ?>" class="figure-img img-fluid rounded w-100" alt="Berita">
                <figcaption class="figure-caption"><?= $media_caption; ?></figcaption>
            </figure>
            <article>
                <?= $content; ?>
            </article>
            <div class="row">
                <div class="col-12">
                    <div class="card p-1 shadow border-0 detail_news_yt">
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="rounded" src="https://www.youtube.com/embed/ifLDLFJyiLQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="wrap_title_yt mt-3">
                                <span>Kupas TV</span>
                                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, facilis.</h5>
                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo
                                    vel neque, sequi adipisci ab inventore commodi ipsam accusamus nostrum voluptas
                                    optio minima reiciendis, corporis enim accusantium asperiores et mollitia.
                                    Adipisci.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- share -->
            <div class="row">
                <div class="col-12">
                    <div class="card bg-light border-0 mt-5">
                        <div class="card-body text-muted m-0 p-3 d-flex justify-content-between align-items-center">
                            <p class="m-0 text_14">Editor <span class="text-primary"><?= $editor_fullname; ?></span></p>
                            <ul class="d-flex list-unstyled m-0">
                                <li class="facebook mr-2">
                                    <a href="<?= $facebook_share ?>" class="d-flex justify-content-center text-decoration-none align-items-center" target="_blank" style="color:#fff; background-color:#3b5998; border-radius:100%; height: 30px; width: 30px;">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="twitter mr-1">
                                    <a href="<?= $twitter_share ?>" target="_blank" class="d-flex justify-content-center text-decoration-none align-items-center" target="_blank" style="color:#fff; background-color:#00acee; border-radius:100%; height: 30px; width: 30px;">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="whatsapp">
                                    <a href="<?= $whatsapp_share ?>" class="d-flex justify-content-center text-decoration-none align-items-center" target="_blank" style="color:#fff; background-color:#4FCE5D; border-radius:100%; height: 30px; width: 30px;">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                <?php $nomor = 1;
                foreach ($lainnya as $val) { ?>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?= $val['image_small'] ?>" alt="<?= $val['title']; ?>">
                            </div>
                        </div>
                        <div class="col-8 col-sm col-md ml-n1 pl-md-3 pl-lg-1 col-lg-8 pl-0">
                            <div class="box_title">
                                <a href="<?= $val['url'] ?>"><?= $val['title']; ?></a>
                                <p class="m-0 p-0 d-flex text_14 align-items-center">
                                    <img src="<?= base_url(); ?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;" alt="">berdikari <span class="text-uppercase"><?= $val['cat_title']; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="divider my-4"></div>
                <?php } ?>
                <div class="row mt-5">
                    <!-- <div class="col-12 w-100">
                        <?= isset($this->ads['detail_sidebar_1']) ? $this->ads['detail_sidebar_1'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_2']) ? $this->ads['detail_sidebar_2'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_3']) ? $this->ads['detail_sidebar_3'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_4']) ? $this->ads['detail_sidebar_4'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_5']) ? $this->ads['detail_sidebar_5'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_6']) ? $this->ads['detail_sidebar_6'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_7']) ? $this->ads['detail_sidebar_7'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_8']) ? $this->ads['detail_sidebar_8'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_9']) ? $this->ads['detail_sidebar_9'] : NULL; ?>
                        <?= isset($this->ads['detail_sidebar_10']) ? $this->ads['detail_sidebar_10'] : NULL; ?>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>