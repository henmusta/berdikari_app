<div class="container mt-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb text-uppercase font-weight-bold">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title;?></li>
        </ol>
    </nav>
</div>

<section class="detail_kupas_tv container mb-5">
    <div class="row">
        <div class="col-12 col-lg-8 mb-4">
            <div class="row mt-3">
                <?php foreach ($lists as $val) {?>
                    <div class="col-12 col-md-6 mb-3">
                        <figure class="figure w-100">
                            <div class="figure-img">
                                <img src="<?php echo $val['image_medium'] ?>" class=" img-fluid rounded" alt="">
                            </div>
                            <a href="<?php echo $val['url'] ?>"><span class="text-danger font-weight-bold">KUPAS TV</span> : <?php echo $val['title'] ?></a>
                            <figcaption class="figure-caption mt-1 text_14"><?php echo $val['date'] ?></figcaption>
                        </figure>
                    </div>
                <?php } ?>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <?php echo $links;?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan border_left font-weight-bold pl-2">BERITA PILIHAN</h5>
                <a href="#" class="text-decoration-none text-primary">Lihat Lainnya <i
                    class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>

            <div class="box_news mt-4">
                <div class="row">
                    <?php $nomor = 1;
                    foreach ($lists as $val) {?>
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?= $val['image_medium'] ?>" loading="lazy" alt="<?= $val['title'] ?>">
                            </div>
                        </div>
                        <div class="col-8 col-sm col-md ml-n1 pl-md-3 pl-lg-1 col-lg-8 pl-0">
                            <div class="box_title">
                                <a href="<?= $val['url'] ?>"><?= $val['title'] ?></a>
                                <p class="m-0 p-0 d-flex text_14 align-items-center"><img
                                    src="<?= base_url()?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;"
                                    alt="">BerdikariNASIONAL</p>
                                </div>
                            </div>
                        </div>
                        <div class="divider my-4"></div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= isset($this->ads['home_sidebar_1']) ? $this->ads['home_sidebar_1'] : NULL;?>
                        <?= isset($this->ads['home_sidebar_2']) ? $this->ads['home_sidebar_2'] : NULL;?>
                        <?= isset($this->ads['home_sidebar_3']) ? $this->ads['home_sidebar_3'] : NULL;?>
                        <?= isset($this->ads['home_sidebar_4']) ? $this->ads['home_sidebar_4'] : NULL;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
