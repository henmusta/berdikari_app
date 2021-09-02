<section class="headline-news">
        <div class="container">
            <ul class="row webview">
                <?php $no=0; foreach ($latest_news as $val): $no++?>
                <?php if ($no == 1) :?>    
                    <li class="col-lg-8">
                        <a href="<?php echo $val['url'] ?>" class="content" style="background-image: url('<?php echo $val['image_large'] ?>');">
                            <div class="date"><?php echo $val['date']; ?> - <?php echo $val['time']; ?> WIB</div>
                            <h1><?php echo $val['title']; ?></h1>
                        </a>
                    </li>
                <?php endif; ?>
                <?php endforeach ?>   
                <li class="col-lg-4">
                    <?php $no=0; foreach ($latest_news as $val): $no++?>
                    <?php if ($no > 1) : ?>
                    <a href="<?php echo $val['url'] ?>" class="content" style="background-image: url('<?php echo $val['image_medium'] ?>');">
                        <div class="date"><?php echo $val['date']; ?> - <?php echo $val['time']; ?> WIB</div>
                        <h1><?php echo $val['title']; ?></h1>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            </ul> 
        </div>
</section>
<section class="second_section-news">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 choice-news mb-4 mb-md-0">
                <h1 class="title">Berita Pilihan</h1>
                <div class="row">
                    <?php $no=0; foreach ($latest_news as $val): $no++?>
                    <?php if ($no == 1) :?>
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <a href="<?php echo $val['url'] ?>" class="main-news">
                            <img src="<?php echo $val['image_large'] ?>" alt="">
                            <h1><?php echo $val['title']; ?></h1>
                            <div class="date"><?php echo $val['date']; ?></div>
                            <div style="white-space: nowrap; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;">
                            <?php echo $val['synopsis'] ?>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>  
                    <div class="col-lg-6">
                        <ul>
                            <?php foreach ($choice_news as $val) : ?>
                            <li>
                                <a href="<?php echo $val['url'] ?>" class="list-news">
                                    <img src="<?php echo $val['image_small'] ?>" alt="">
                                    <div class="description">
                                        <h1><?php echo $val['title']; ?></h1>
                                        <div class="date"><?php echo $val['date']; ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>        
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 politic-news">
                <h1 class="title">Politik</h1>
                <ul>
                    <?php
                      $nomor = 1;
                     foreach ($politik as $val) : ?>
                    <li>
                        <a href="<?php echo $val['url'] ?>" class="list-news">
                            <div class="sort">
                                <?php
                                    echo $nomor++;
                                ?>
                            </div>
                            <div class="description">
                                <h1><?php echo $val['title']; ?></h1>
                                <div class="date"><?php echo $val['date']; ?></div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="e-papper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 e-papper-content">
                <h1 class="title">E-Paper</h1>
                <ul class="row list-epapper">
                    <?php $no=0; foreach ($e_paper as $val) : $no++?>
                    <li class="col-lg-4">
                        <a href="<?php echo $val['url'] ?>">
                            <img src="<?php echo $val['image_medium'] ?>" alt="">
                            <div class="description d-block d-lg-none">
                                <h1><?php echo $val['synopsis'] ?></h1>
                                <div class="date"><?php echo $val['date']; ?></div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <!-- <div class="mb-3">
                    <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?>
                </div>
                <div class="mb-3">
                    <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?>
                </div>
                <div class="mb-3">
                    <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?>
                </div> -->
            </div>
            <div class="col-sm-4 e-papper-banner">
                <!-- <div class="banner-1">
                    <?php echo isset($this->ads['home_sidebar_1']) ? $this->ads['home_sidebar_1'] : NULL;?>
                    <!-- <img src="assets/images/banner2.png" class="img-fluid" alt=""> -->
                </div>
                <div class="banner-2">
                    <?php echo isset($this->ads['home_sidebar_2']) ? $this->ads['home_sidebar_2'] : NULL;?>
                    <!-- <img src="assets/images/banner2.png" class="img-fluid" alt=""> -->
                </div> -->
            </div>
        </div>
    </div>
</section>
<section class="third_section-news">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 local-news mb-4 mb-md-0">
                <h1 class="title">Seputar Lampung</h1>
                <div class="row">
                    <?php $no=0; foreach ($seputar_lampung as $val) : $no++?>
                    <?php if ($no == 1) :?>
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <a href="<?php echo $val['url'];?>" class="main-news">
                            <img src="<?php echo $val['image_medium'];?>" alt="">
                            <h1><?php echo $val['title'];?></h1>
                            <div class="date"><?php echo $val['date'];?></div>
                            <p><?php echo $val['synopsis'];?></p>
                        </a>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                    <div class="col-lg-6">
                        <ul class="row">
                            <?php $no=0; foreach ($seputar_lampung as $val) : $no++?>
                                <?php if ($no > 1) :?>
                            <li class="col-6 col-md-6">
                                <a href="<?php echo $val['url'] ?>" class="list-news d-block">
                                    <div class="cage-image" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
                                    <div class="description">
                                        <h1><?php echo $val['title']; ?></h1>
                                        <div class="date"><?php echo $val['date']; ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 infografis">
                <h1 class="title">Infografis</h1>
                <ul class="owl-infografis-news owl-carousel owl-theme">
                    <?php foreach ($infographic as $val) :?>
                    <li><a href="<?php echo $val['url'] ?>" data-caption="Caption First" data-date="<?php echo $val['date'] ?>" class="modal-image"><img src="<?php echo $val['image_large'] ?>" alt=""></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="mt-5 mb-3">
            <!-- <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?> -->
        </div>
    </div>
</section>

<section class="video-news">
    <div class="container">
        <div class="kupas-tv">
            <div class="header">
                <h1 class="title">Kupas TV</h1>
            </div>
            <div class="body">
                <div class="row">
                    <?php $no=0; foreach ($kupas_tv as $val) : $no++?>
                    <?php if ($no == 1) :?>
                    <div class="col-sm-8">
                        <div class="main-video">
                            <div class="embed-responsive embed-responsive-16by9">   
                                <iframe id="boxview" width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $val['youtube_id'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <h1><?php echo $val['title']; ?></h1>
                            <p><?php echo $val['synopsis']; ?></p>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                    <div class="col-sm-4">
                        <ul>
                            <?php $no=0; foreach ($kupas_tv as $val) : $no++?>
                            <?php if ($no > 1) :?>
                            <li class="">
                                <a href="<?php echo $val['url'];?>" class="list-video" data-title="<?php echo $val['title'];?>" 
                                    data-description=" <?php echo $val['synopsis']; ?>" data-video="<?php echo $val['youtube_id'];?>">
                                    <img src="<?php echo $val['image_medium']; ?>" alt="">
                                    <h1 style="width: 70%;"><?php echo $val['title']; ?></h1>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
