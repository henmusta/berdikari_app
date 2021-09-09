<!-- <div class="container mt-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb text-uppercase font-weight-bold">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title;?></li>
        </ol>
    </nav>
</div>


<section class="populer container mt-3 mb-5">
    <div class="row">
        <?php foreach ($lists as $val) {?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body p-1">
                        <a href="<?= $val['url'] ?>" class="text-decoration-none">
                            <img src="<?= $val['image_medium'] ?>" class="img-fluid" alt="<?= $val['title']; ?>">
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-12 d-flex justify-content-center align-content-center">
            <div class="cage-loadmore">
                <a href="<?php echo $url_loadmore;?>" id="btn-load" class="btn-loadmore btn btn-primary" data-page="2">Muat Lainnya</a>
            </div>
        </div>
    </div>
</section> -->

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
        <ul class="row list-epapper-page"  id="listpopuler">
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