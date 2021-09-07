<?php foreach ($lists as $val) :?>
	<li class="col-6 col-sm-3">
	    <a href="<?php echo $val['url'] ?>" class="list-epapper-content" style="background-image: url('<?php echo $val['image_medium'] ?>');">
	        <h1 class="list-epapper-content-title"><?php echo $val['title']; ?></h1>
	        <div class="list-epapper-content-date"><?php echo $val['date']; ?></div>
	    </a>
	</li>
<?php endforeach; ?>