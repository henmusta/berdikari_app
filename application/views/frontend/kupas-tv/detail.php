<section class="container detail_news my-5">
    <div class="row">
        <div class="col-12 col-lg-8 mb-5">
            <div class="title_detail_news">
                <p class="m-0 font-weight-bold">
                    <img src="<?=base_url();?>assets/frontend/images/logo/logo-kategori-2.png" width="30" alt=""> BerdikariNASIONAL
                </p>
                <p class="m-0 text-muted font-weight-normal mt-2 text_14"><?php echo $date; ?></p>
                <h5><?php echo $title; ?></h5>
            </div>
            <div class="card bg-light border-0 mb-3 mt-3">
                <div class="card-body text-muted p-3 d-flex justify-content-between">
                    <p class="m-0 text_14">Oleh <span class="text-primary"><?php echo $author_fullname; ?></span></p>
                    <span class="text-primary"><i class="fas fa-play text_12 mr-1 text-muted"></i><?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></span>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9 rounded mt-2">
                <iframe src="<?php echo $youtube_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <article class="mt-3">
                <?php echo $content; ?>
            </article>
        </div>
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="d-flex justify-content-between">
                <h5 class="title_pilihan border_left font-weight-bold pl-2">BERITA PILIHAN</h5>
                <a href="#" class="text-decoration-none text-primary">Lihat Lainnya <i
                    class="fas fa-chevron-right text-muted ml-3"></i>
                </a>
            </div>

            <div class="box_news mt-4">
                <?php $nomor = 1;
                foreach ($lainnya as $val) {?>
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-lg-4">
                            <div class="box_img">
                                <img src="<?php echo $val['image_small'] ?>" alt="<?php echo $val['title'];?>">
                            </div>
                        </div>
                        <div class="col-8 col-sm col-md ml-n1 pl-md-3 pl-lg-1 col-lg-8 pl-0">
                            <div class="box_title">
                                <a href="<?php echo $val['url']?>"><?php echo $val['title'];?></a>
                                <p class="m-0 p-0 d-flex text_14 align-items-center"><img
                                    src="<?=base_url()?>assets/frontend/images/logo/logo-kategori-2.png" class="mr-1" style="width: 20px;"
                                    alt="">BerdikariNASIONAL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="divider my-4"></div>
                <?php } ?> 
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="mt-2">
                            <?= isset($this->ads['detail_sidebar_1']) ? $this->ads['detail_sidebar_1'] : NULL;?> 
                        </div>
                        <div class="mt-2">
                            <?= isset($this->ads['detail_sidebar_2']) ? $this->ads['detail_sidebar_2'] : NULL;?>
                        </div>
                        <div class="mt-2">
                            <?= isset($this->ads['detail_sidebar_3']) ? $this->ads['detail_sidebar_3'] : NULL;?>
                        </div>
                        <div class="mt-2">
                            <?= isset($this->ads['detail_sidebar_4']) ? $this->ads['detail_sidebar_4'] : NULL;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
