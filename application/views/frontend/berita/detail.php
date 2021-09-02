<style>
    .news-content a{
        color:#007bff !important;
    }
</style>
<section class="news-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 news-detail-page-container">
                    <h1 class="title"><?php echo $title; ?></h1>
                    <div class="news-info_top">
                        <div class="date"><?php echo $date.' - '.$time; ?> WIB</div>
                        <div class="view"><i class="fas fa-eye"></i> <?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></div>
                    </div>
                    <div class="news-main-image">
                        <img src="<?php echo $image_large ?>" alt="">
                    </div>
                    <!--caption berita-->
                    <p class="news-caption" style="font-size:12px;"><?php echo $media_caption; ?></p>
                    <!--end caption berita-->
                    <div class="news-info_mid">
                        <a href="" class="author"><img src="<?php echo $author_photo; ?>" alt=""><h1><?php echo $author_fullname; ?></h1></a>
                    </div>
                    <div class="news-content">
                        <?php echo $content; ?>
                        <div class="mt-3 mb-3">
                            <?php echo isset($this->ads['detail_content']) ? $this->ads['detail_content'] : NULL;?>
                        </div>
                    </div>
                    <div class="news-info_bottom">
                        <div class="editor">Editor : <a href=""><?php echo $editor_fullname; ?></a></div>
                        <div class="social-media">
                            <ul>
                                <li class="facebook"><a href="<?php echo $facebook_share ?>" target="_blank"><i class="fab fa-facebook-f" style="color:#fff; background-color:#3b5998; border-radius:100%; padding:5px 8px;"></i></a><div class="count" style="text-align:center;"><?php echo isset($facebook_count) && !empty($facebook_count) ? $facebook_count : '0'; ?></div></li>
                                <li class="twitter"><a href="<?php echo $twitter_share ?>" target="_blank"><i class="fab fa-twitter"style="color:#fff; background-color:#00acee; border-radius:100%; padding:5px 5px;"></i></a><div class="count" style="text-align:center;"><?php echo isset($twitter_count) && !empty($twitter_count) ? $twitter_count : '0'; ?></div></li>
                                <li class="whatsapp"><a href="<?php echo $whatsapp_share ?>" target="_blank"><i class="fab fa-whatsapp" style="color:#fff; background-color:#4FCE5D; border-radius:100%; padding:6px 6px;"></i></a><div class="count" style="text-align:center;"><?php echo isset($whatsapp_count) && !empty($whatsapp_count) ? $whatsapp_count : '0'; ?></div></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-5">
                        <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sidebar_news-relateable">
                        <h1 class="title">Berita Pilihan</h1>
                        <ul class="news-relateable">
                        <?php $nomor = 1; 
                        foreach ($lainnya as $val) :?>
                            <li>
                                <a href="<?php echo $val['url']; ?>" class="list-news">
                                    <div class="sort"><?php echo $nomor++;?></div>
                                    <div class="description">
                                        <h1><?php echo $val['title']; ?></h1>
                                        <div class="date"><?php echo $val['date']; ?></div>
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
                            <li><?php echo isset($this->ads['detail_sidebar_5']) ? $this->ads['detail_sidebar_5'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_6']) ? $this->ads['detail_sidebar_6'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_7']) ? $this->ads['detail_sidebar_7'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_8']) ? $this->ads['detail_sidebar_8'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_9']) ? $this->ads['detail_sidebar_9'] : NULL;?></li>
                            <li><?php echo isset($this->ads['detail_sidebar_10']) ? $this->ads['detail_sidebar_10'] : NULL;?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="news-relateable">
                <h1 class="title">Berita Lainnya</h1>
                <ul class="row">
                    <?php foreach ($lainnya as $val) :?>
                    <li class="col-6 col-sm-3">
                        <a href="<?php echo $val['url'];?>">
                            <div class="cage-image d-none d-sm-block" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_small'] ?>); background-size:cover; background-position: center center;"></div>
                            <!-- <img src="<?php echo $val['image_small'];?>" alt=""> -->
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
<!-- <section class="news-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 news-detail-page-container">
                <ul class="breadcrumbs">

                    <?php foreach ($categories as $category) :?>
                    <li><a href="<?php echo $category['url'] ?>"><?php echo $category['title']; ?></a></li>
                    <?php endforeach ?>
                </ul>
                <h1 class="title"><?php echo $title.$read_count; ?></h1>
                <div class="date"><?php echo $date.' - '.$time; ?> WIB - <span><i class="fas fa-eye"></i> <?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></span></div>
                <div class="news-image">
                    <img src="<?php echo $image_large ?>" class="img-fluid" alt="">
                    <div class="news-image_caption">
                        <p class="description"><?php echo $media_caption; ?></p>
                    </div>
                </div>
                <div class="editor-info">
                    <div class="row">
                        <div class="col-sm-6 content">
                            <div class="cage-image">
                                <img src="<?php echo $author_photo ?>" alt="">
                            </div>
                            <div class="cage-text">
                                <p class="position">Penulis</p>
                                <p class="name"><?php echo $author_fullname; ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6 share-socmed">
                            <p>Share To :</p>
                            <ul>
                                <li class="facebook"><a href="<?php echo $facebook_share ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><div class="count"><?php echo isset($facebook_count) && !empty($facebook_count) ? $facebook_count : '0'; ?></div></li>
                                <li class="twitter"><a href="<?php echo $twitter_share ?>" target="_blank"><i class="fab fa-twitter"></i></a><div class="count"><?php echo isset($twitter_count) && !empty($twitter_count) ? $twitter_count : '0'; ?></div></li>
                                <li class="whatsapp"><a href="<?php echo $whatsapp_share ?>" target="_blank"><i class="fab fa-whatsapp"></i></a><div class="count"><?php echo isset($whatsapp_count) && !empty($whatsapp_count) ? $whatsapp_count : '0'; ?></div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="news-content">
                    <?php echo $content; ?>
                    <nav class="pagging" style="height: 100%;margin-top: 40px;">
                        <?php if ($total_page > 1) :?>
                            <?php if ($current_page == 'all') :?>
                                <a href="<?php echo $current_url.'/'.$total_page; ?>" class="btn btn-sm btn-primary mb-2 text-white"><i class="fas fa-arrow-left"></i> Halaman Sebelumya</a>
                            <?php else : ?>
                                <a href="<?php echo $current_page < $total_page ? $current_url.'/'.($current_page + 1) : $current_url.'/all'; ?>" class="btn btn-sm btn-primary mb-2 text-white">Halaman Selanjutnya <i class="fas fa-arrow-right"></i></a>
                            <?php endif; ?>
                            <h3 style="font-size: 16px;">Halaman :</h3>
                            <ul class="pagination" style="position: relative;top: 0;left: 0;transform: none;">
                                <?php for ($i=1; $i <= $total_page; $i++) :?>
                                    <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $current_url.'/'.$i ?>"><?php echo $i; ?></a></li>
                                <?php endfor ?>
                                <?php if ($current_page == $total_page || $current_page == 'all') :?>
                                    <li class="page-item <?php echo $current_page == 'all' ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $current_url.'/all' ?>">Semua</a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </nav>
                </div>
                <div class="news-footnote">
                    <ul>
                        <li>Penulis : <?php echo $author_fullname; ?></li>
                        <li>Editor : <?php echo $editor_fullname; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 news-detail-page-banner">
                <div class="banner">
                    <?php echo isset($this->ads['detail_sidebar_1']) ? $this->ads['detail_sidebar_1'] : NULL;?>
                </div>
                <div class="banner">
                    <?php echo isset($this->ads['detail_sidebar_2']) ? $this->ads['detail_sidebar_2'] : NULL;?>
                </div>
                <div class="banner">
                    <?php echo isset($this->ads['detail_sidebar_3']) ? $this->ads['detail_sidebar_3'] : NULL;?>
                </div>
                <div class="banner">
                    <?php echo isset($this->ads['detail_sidebar_4']) ? $this->ads['detail_sidebar_4'] : NULL;?>
                </div>
            </div>
        </div>
        <div class="news-relateable">
            <div class="title">
                <h1>Berita Lainnya</h1>
            </div>
            <ul class="row">
                <?php foreach ($lainnya as $val) :?>
                <li class="col-sm-3">
                    <a href="<?php echo $val['url'] ?>" class="img-link"><img src="<?php echo $val['image_medium'] ?>" alt=""></a>
                    <div class="date"><?php echo $val['date']; ?></div>
                    <a href="<?php echo $val['url'] ?>" class="title"><h1><?php echo $val['title']; ?></h1></a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section> -->