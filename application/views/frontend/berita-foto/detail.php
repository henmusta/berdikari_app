 <section class="news-photos-page-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 news-photos-page-detail-page-container">
                    <h1 class="title"><?php echo $title; ?></h1>
                    <div class="news-info_top">
                        <div class="date"><?php echo $date; ?></div>
                        <div class="view"><i class="fas fa-eye"></i> <?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></div>
                    </div>
                    <div class="news-info-description">
                        <p><?php echo $content; ?></p>
                    </div>
                    <div class="main-image">
                        <img id="main-image-content" src="<?php echo $image_large ?>" alt="">
                        <p id="main-image-caption"><?php echo $media_caption ?></p>
                    </div>
                    <ul class="carousel-image owl-carousel owl-theme">
                        <?php foreach ($galleries as $val) : ?>
                        <li><a href="<?php echo $val['image_large'] ?>" data-caption="<?php echo htmlentities($val['caption'], ENT_QUOTES); ?>" class="carousel-image-content active"><img src="<?php echo $val['image_medium'] ?>" alt=""></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="news-relateable">
                        <h1 class="title">Berita Foto Lainnya</h1>
                        <ul class="row">
                            <?php foreach ($lainnya as $val) :?>
                            <li class="col-6">
                                <a href="<?php echo $val['url'] ?>">
                                    <div class="cage-image" style="width: 100%; height: 170px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
                                    <!-- <img src="<?php echo $val['image_medium'] ?>" alt=""> -->
                                    <div class="description">
                                        <h1><?php echo $val['title'] ?></h1>
                                        <div class="date"><?php echo $val['date'] ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar_news-relateable">
                        <h1 class="title">Berita Pilihan</h1>
                        <ul class="news-relateable">
                            <?php 
                            $nomor = 1;
                            foreach ($lainnya as $val) :?>
                            <li>
                                <a href="<?php echo $val['url'] ?>" class="list-news">
                                    <div class="sort"><?php echo $nomor++;?></div>
                                    <div class="description">
                                        <h1><?php echo $val['title'] ?></h1>
                                        <div class="date"><?php echo $val['date'] ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="sidebar_banner">
                        <ul class="banner">
                            <li><?php echo isset($this->ads['detail_sidebar_1']) ? $this->ads['detail_sidebar_1'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_2']) ? $this->ads['detail_sidebar_2'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_3']) ? $this->ads['detail_sidebar_3'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_4']) ? $this->ads['detail_sidebar_4'] : NULL;?></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>