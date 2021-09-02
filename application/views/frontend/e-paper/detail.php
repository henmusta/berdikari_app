<section class="epaper-page-detail">
    <div class="container">
        <h1 class="title"><?php echo $title; ?></h1>
        <div class="date-title"><?php echo $date; ?><span><i class="fas fa-eye"></i> <?php echo isset($read_count) && !empty($read_count) ? $read_count : '0'; ?></span></div>
        <div class="content-page"><?php echo $content;?></div>
        <div class="editor-info">
            <div class="row">
                <div class="col-sm-6 content">
                    <div class="cage-image">
                        <img src="<?php echo $author_photo ?>" alt="">
                    </div>
                    <div class="cage-text">
                        <p class="name">Penulis : <?php echo $author_fullname; ?></p>
                    </div>
                </div>
                <div class="col-sm-6 share-socmed">
                    <p>Share To :</p>
                    <ul>
                        <li class="facebook"><a href="<?php echo $facebook_share ?>" target="_blank"><i class="fab fa-facebook-f"style="color:#fff; background-color:#3b5998; border-radius:100%; padding:5px 8px;"></i></a><div class="count" style="padding-left: 7px;"><?php echo isset($facebook_count) && !empty($facebook_count) ? $facebook_count : '0'; ?></div></li>
                        <li class="twitter"><a href="<?php echo $twitter_share ?>" target="_blank"><i class="fab fa-twitter"style="color:#fff; background-color:#00acee; border-radius:100%; padding:5px 5px;"></i></a><div class="count" style="padding-left: 7px;"><?php echo isset($twitter_count) && !empty($twitter_count) ? $twitter_count : '0'; ?></div></li>
                        <li class="whatsapp"><a href="<?php echo $whatsapp_share ?>" target="_blank"><i class="fab fa-whatsapp"style="color:#fff; background-color:#4FCE5D; border-radius:100%; padding:6px 6px;"></i></a><div class="count" style="padding-left: 7px;"><?php echo isset($whatsapp_count) && !empty($whatsapp_count) ? $whatsapp_count : '0'; ?></div></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="news-relateable">
            <div class="title">
                <h1>E-Paper Lainnya</h1>
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
</section>