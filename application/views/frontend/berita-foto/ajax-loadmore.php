<?php foreach ($lists as $val) :?>
    <li class="col-6 col-md-6">
        <a href="<?php echo $val['url']; ?>" class="list-news">
            <div class="cage-image" style="width: 100%; height: 150px; border-radius: 5px; background-image: url(<?php echo $val['image_medium'] ?>); background-size:cover; background-position: center center;"></div>
            <!-- <img src="<?php echo $val['image_medium'] ?>" alt=""> -->
            <div class="description">
                <h1><?php echo $val['title'] ?></h1>
                <div class="date"><?php echo $val['date'] ?></div>
            </div>
        </a>
    </li>
<?php endforeach;?>