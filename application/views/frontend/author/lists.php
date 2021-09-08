<section class="news-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 news-detail-page-container mb-0">
                <div class="editor-info">
                    <div class="row">
                        <div class="col-sm-6 content">
                            <div class="cage-image">
                                <img src="<?php echo $author['photo'];?>">
                            </div>
                            <div class="cage-text">
                                <p class="position">Penulis</p>
                                <p class="name"><?php echo $author['fullname'];?></p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
<section class="list-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 list-page-container">
                <ul id="lists-berita">
                    <?php foreach ($lists as $val) :?>
                    <li>
                       <div class="row">
                            <div class="col-sm-4">
                               <a href="<?php echo $val['url'] ?>" class="cage-image">
                                   <img src="<?php echo $val['image_medium'] ?>" alt="">
                               </a>
                            </div>
                            <div class="col-sm-8">
                                <a href="<?php echo $val['url'] ?>"><?php echo $val['title']; ?></a>
                                <p><?php echo $val['synopsis']; ?></p>
                                <a href="<?php echo $val['url'] ?>" class="btn btn-sm btn-readmore">Selengkapnya</a>
                            </div>
                       </div> 
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="cage-loadmore">
                    <a href="<?php echo $url_loadmore;?>" class="btn-loadmore" id="btn-load" data-page="2">Muat Lainnya</a>
                </div>
            </div>
            <div class="col-sm-3 list-page-banner">
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
    </div>
</section>

