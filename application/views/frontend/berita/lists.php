<section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href=""><?php echo $title;?></a></li>
            </ul>
        </div>
    </section>

<section class="indeks">
        <div class="headline-indeks">
            <div class="container">
                <h1 class="title"><?php echo $title;?></h1>
                <ul class="row">
                    <?php foreach (array_slice($lists,0,4) as $val) :?>
                    <li class="col-sm-6 col-lg-3">
                        <a href="<?php echo $val['url'];?>">
                            <div class="cage-image d-none d-sm-block" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
                            <img class="d-block d-sm-none" src="<?php echo $val['image_medium'];?>" alt="">
                            <div class="description">
                                <h1 style="word-break: break-word;"><?php echo $val['title'];?></h1>
                                <div class="date"><?php echo $val['date'];?></div>
                            </div>
                        </a>
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
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="content-list">
                            <?php $no = $this->uri->segment('3') + 1;
                                  foreach (array_slice($lists, 4) as $val) : 
                                  $no++;?>
                            <li>
                                <div class="mt-3 mb-3">
                                    <?php echo isset($this->ads['home_content']) ? $this->ads['home_content'] : NULL;?>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-4">
                                       <a href="<?php echo $val['url'];?>" class="cage-image">
                                        <div class="cage-image d-none d-sm-block" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
                                        
                                           <!-- <img src="<?php echo $val['image_medium'];?>" alt=""> -->
                                       </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <a href="<?php echo $val['url'];?>" class="description">
                                            <h1><?php echo $val['title'];?></h1>
                                            <p><?php echo $val['synopsis'];?></p>
                                            <div class="date"><?php echo $val['date'];?></div>
                                        </a>
                                    </div>
                               </div>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        
                        <nav class="pagging">
                            <?php echo $links;?>
                            <!-- <ul class="pagination"> -->
                                <!-- <li class="page-item"><i class="fas fa-angle-left"></i></li>
                                <li class="page-item"><i class="fas fa-angle-double-left"></i></li>
                                <li class="page-item"></li>
                                <li class="page-item active"><span class="page-link">2</span></li>
                                <li class="page-item"></li>
                                <li class="page-item"><i class="fas fa-angle-double-right"></i></li>
                                <li class="page-item"><i class="fas fa-angle-right"></i></li> -->
                                <!-- <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-double-left"></i></a></li>
                                <li class="page-item"><a class="page-link" href="">1</a></li>
                                <li class="page-item active"><span class="page-link">2</span></li>
                                <li class="page-item"><a class="page-link" href="">3</a></li>
                                <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-double-right"></i></a></li>
                                <li class="page-item"><a class="page-link" href=""><i class="fas fa-angle-right"></i></a></li> -->
                            <!-- </ul> -->
                        </nav>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar_news-relateable">
                            <h1 class="title">Berita Pilihan</h1>
                            <ul class="news-relateable">
                                <?php $nomor = 1;
                                  foreach (array_slice($lists, 4) as $val) :?>
                                <li>
                                    <a href="<?php echo $val['url']?>" class="list-news">
                                        <div class="sort"><?php echo $nomor++;?></div>
                                        <div class="description">
                                            <h1><?php echo $val['title'];?></h1>
                                            <div class="date"><?php echo $val['date'];?></div>
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
        </div>
</section>