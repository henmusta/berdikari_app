<section class="container detail_paper my-5">
    <div class="row">
        <div class="col-12 col-lg-7 col-xl-8">
            <div class="title_epaper">
                <p>e-paper</p>
                <h5><?= $title; ?></h5>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body text-muted p-3 d-flex justify-content-between">
                            <p class="m-0"><?php echo $date; ?></p>
                            <span class="text-primary"><i class="fas fa-eye mr-1 text-muted"></i><?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></span>
                        </div>
                    </div>
                    <?php echo $content;?>
                    <iframe src="./assets/file/ex.pdf" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan border_left font-weight-bold pl-2">BERITA PILIHAN</h5>
                <a href="#" class="text-decoration-none text-primary">Lihat Lainnya <i
                    class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>
            <?php foreach ($lainnya as $val) :?>
                <li class="col-sm-3">
                    <a href="<?php echo $val['url'] ?>" class="img-link"><img src="<?php echo $val['image_medium'] ?>" alt=""></a>
                    <div class="date"><?php echo $val['date']; ?></div>
                    <a href="<?php echo $val['url'] ?>" class="title"><h1><?php echo $val['title']; ?></h1></a>
                </li>
            <?php endforeach ?>
            <div class="box_news mt-4">
                <?php foreach ($lainnya as $val) :?>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?php echo $val['image_medium'] ?>" loading="lazy" alt="<?php echo $val['title'] ?>">
                            </div>
                        </div>
                        <div class="col-8 col-sm col-md ml-n1 pl-md-3 pl-lg-1 col-lg-8 pl-0">
                            <div class="box_title">
                                <a href="<?php echo $val['url'] ?>"><?php echo $val['title'] ?></a>
                                <p class="m-0 p-0 d-flex text_14 align-items-center">
                                    <img
                                    src="<?= base_url();?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;"
                                    alt="">BerdikariNASIONAL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="divider my-4"></div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
