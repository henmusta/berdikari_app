<?php foreach ($infographic as $val) :?>
	<li class="col-6 col-sm-4"><a href="<?php echo $val['image_large'] ?>" data-caption="<?php echo $val['synopsis'] ?>" data-date="<?php echo $val['date'] ?>" class="modal-image"><img src="<?php echo $val['image_large'] ?>" alt=""></a></li>
<?php endforeach; ?>