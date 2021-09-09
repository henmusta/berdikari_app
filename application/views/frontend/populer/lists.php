<div class="container mt-5">
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
</section>
