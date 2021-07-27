 <section class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href=""><?php echo $title;?></a></li>
        </ul>
    </div>
</section>
 <section class="epaper-page">
    <div class="container">
        <ul class="row list-epapper-page"  id="listepaper">
            <?php foreach ($lists as $val) :?>
            <li class="col-6 col-sm-3">
                <a href="<?php echo $val['url'] ?>" class="list-epapper-content" style="background-image: url('<?php echo $val['image_medium'] ?>');">
                    <h1 class="list-epapper-content-title"><?php echo $val['title']; ?></h1>
                    <div class="list-epapper-content-date"><?php echo $val['date']; ?></div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="cage-loadmore">
             <a href="<?php echo $url_loadmore;?>" id="btn-load" class="btn-loadmore" data-page="2">Muat Lainnya</a>
        </div>
    </div>
</section>