<?php foreach ($lists as $val) :?>
    <li>
     <div class="row">
          <div class="col-sm-4">
             <a href="<?php echo $val['url'] ?>" class="cage-image">
                 <img src="<?php echo $val['image_medium'] ?>" alt="">
             </a>
          </div>
          <div class="col-sm-8">
              <a href="<?php echo $val['url'] ?>"><?php echo $val['title']; ?></a>
              <p><?php echo $val['synopsis']; ?></p>
              <a href="<?php echo $val['url'] ?>" class="btn btn-sm btn-readmore">Selengkapnya</a>
          </div>
     </div> 
    </li>
<?php endforeach; ?>