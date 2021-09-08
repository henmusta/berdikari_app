<?php $no=0; foreach ($lists as $val) : $no++;?>
<li>
    <div class="row no-gutters">
        <div class="col-sm-6 <?php echo $no % 2 == 1 ? '' : 'order-sm-2'; ?> nasional-page-list-mid_image">
            <a href="<?php echo $val['url'] ?>"><img src="<?php echo $val['image_medium'] ?>" alt=""></a>
        </div>
        <div class="col-sm-6 <?php echo $no % 2 == 1 ? '' : 'order-sm-1'; ?> nasional-page-list-mid_text">
            <div class="content">
                <a href="<?php echo $val['url'] ?>"><h1 class="title"><?php echo $val['title']; ?></h1></a>
                <div class="date"><?php echo $val['date']; ?></div>
                <p class="description"><?php echo $val['synopsis']; ?></p>
            </div>
        </div>
    </div>
</li>
<?php endforeach; ?>
