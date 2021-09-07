<?php foreach ($lists as $val) :?>
<li class="col-6 col-sm-4">
    <a href="<?php echo $val['url'] ?>" class="img-link"><img src="<?php echo $val['image_medium'] ?>" alt=""></a>
    <a href="<?php echo $val['url'] ?>" class="title"><h1><?php echo $val['title']; ?></h1></a>
    <div class="date"><?php echo $val['date']; ?></div>
    <p class="description"><?php echo $val['synopsis']; ?></p>
</li>
<?php endforeach; ?>