<section class="news-photos-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 news-photos-page-container">
                    <?php $no=0; foreach ($lists as $val): $no++?>
                    <?php if ($no == 1) :?>   
                        <a href="<?php echo $val['url']; ?>" class="main-news">
                            <div class="cage-image">
                                <img src="<?php echo $val['image_large'] ?>" alt="">
                                <div class="count"><i class="fas fa-camera"></i> 10 Foto</div>
                            </div>  
                            <div class="description">
                                <h1><?php echo $val['title'] ?></h1>
                                <div class="date"><?php echo $val['date'] ?></div>
                            </div>
                        </a>
                    <?php endif;?>
                    <?php endforeach;?>
                    <ul class="row" id="lists-berita">
                        <?php foreach ($lists as $val) :?>
                        <li class="col-6 col-md-6">
                            <a href="<?php echo $val['url']; ?>" class="list-news">
                                <div class="cage-image" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
                                <!-- <img src="<?php echo $val['image_medium'] ?>" alt=""> -->
                                <div class="description">
                                    <h1><?php echo $val['title'] ?></h1>
                                    <div class="date"><?php echo $val['date'] ?></div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="cage-loadmore">
                        <a href="<?php echo $url_loadmore;?>" id="btn-load" class="btn-loadmore" data-page="2">Muat Lainnya</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sidebar_news-relateable-photo">
                        <h1 class="title">Seputar Lampung</h1>
                        <ul class="news-relateable">
                            <?php foreach ($lists as $val) :?>
                            <li>
                                <a href="<?php echo $val['url'] ?>" class="list-news">
                                    <img src="<?php echo $val['image_small'] ?>" alt="">
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
                            <li><?php echo isset($this->ads['home_sidebar_1']) ? $this->ads['home_sidebar_1'] : NULL;?></li>
                            <li><?php echo isset($this->ads['home_sidebar_2']) ? $this->ads['home_sidebar_2'] : NULL;?></li>
                            <li><?php echo isset($this->ads['home_sidebar_3']) ? $this->ads['home_sidebar_3'] : NULL;?></li>
                            <li><?php echo isset($this->ads['home_sidebar_4']) ? $this->ads['home_sidebar_4'] : NULL;?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>