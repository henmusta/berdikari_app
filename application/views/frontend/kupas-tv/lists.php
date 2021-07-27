<section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Kupas TV</a></li>
            </ul>
        </div>
</section>
<section class="kupastv-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="row content-list">
                        <?php foreach ($lists as $val) :?>
                        <li class="col-sm-6">
                            <div class="content">
                                <a href="<?php echo $val['url'] ?>" class="cage-image">
                                    <img src="<?php echo $val['image_medium'] ?>" alt="">
                                </a>
                                <a href="<?php echo $val['url'];?>" class="description">
                                    <h1><?php echo $val['title'] ?></h1>
                                    <div class="date"><?php echo $val['date'] ?></div>
                                </a>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <nav class="pagging">
                         <?php echo $links;?>
                        <!-- <ul class="pagination">
                            <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-double-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="">1</a></li>
                            <li class="page-item active"><span class="page-link">2</span></li>
                            <li class="page-item"><a class="page-link" href="">3</a></li>
                            <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-double-right"></i></a></li>
                            <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-right"></i></a></li>
                        </ul> -->
                    </nav>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar_news-relateable">
                        <h1 class="title">Berita Pilihan</h1>
                        <ul class="news-relateable">
                        <?php $nomor = 1;
                        foreach ($lists as $val) :?>
                            <li>
                                <a href="<?php echo $val['url'] ?>" class="list-news">
                                    <div class="sort"><?php echo $nomor++;?></div>
                                    <div class="description">
                                        <h1><?php echo $val['title'] ?></h1>
                                        <div class="date"><?php echo $val['date'] ?></div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
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