<section class="kupastv-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 kupastv-detail-page-container">
                    <h1 class="title"><?php echo $title;?></h1>
                    <div class="news-info_top">
                        <div class="date"><?php echo $date.' - '.$time; ?> WIB</div>
                        <div class="view"><i class="fas fa-eye"></i> 
                            <?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?>
                        </div>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="<?php echo $youtube_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="news-info_mid">
                        <a href="" class="author"><img src="<?php echo $author_photo; ?>" alt=""><h1><?php echo $author_fullname; ?></h1></a>
                    </div>
                    <div class="news-content">
                        <?php echo $content; ?>
                    </div>
                    <div class="news-info_bottom">
                        <div class="editor">Editor : <a href=""><?php echo $editor_fullname; ?></a></div>
                        <div class="social-media">
                            <ul>
                                <li class="facebook"><a href="<?php echo $facebook_share ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><div class="count" style="text-align:center;"><?php echo isset($facebook_count) && !empty($facebook_count) ? $facebook_count : '0'; ?></div></li>
                                <li class="twitter"><a href="<?php echo $twitter_share ?>" target="_blank"><i class="fab fa-twitter"></i></a><div class="count" style="text-align:center;"><?php echo isset($twitter_count) && !empty($twitter_count) ? $twitter_count : '0'; ?></div></li>
                                <li class="whatsapp"><a href="<?php echo $whatsapp_share ?>" target="_blank"><i class="fab fa-whatsapp"></i></a><div class="count" style="text-align:center;"><?php echo isset($whatsapp_count) && !empty($whatsapp_count) ? $whatsapp_count : '0'; ?></div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
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
            <div class="news-relateable">
                <h1 class="title">Kupas TV Lainnya</h1>
                <ul class="row">
                    <?php foreach ($lainnya as $val) :?>
                    <li class="col-6 col-sm-3">
                        <a href="<?php echo $val['url'];?>">
                            <img src="<?php echo $val['image_small'];?>" alt="">
                            <div class="description">
                                <h1><?php echo $val['title'];?></h1>
                                <div class="date"><?php echo $val['date'];?></div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </section>