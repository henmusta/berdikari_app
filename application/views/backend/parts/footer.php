<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								
							</li>
							
						</ul>
					</nav>
					<div class="copyright ml-auto">
					    Developed <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="//ginktech.net" target="_blank">Gink Technology</a>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	

	<!--   Core JS Files   -->
	<script src="<?php echo base_url(); ?>assetsatlan/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assetsatlan/js/core/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assetsatlan/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url(); ?>assetsatlan/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>assetsatlan/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="<?php echo base_url(); ?>assetsatlan/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Atlantis JS -->
	<script src="<?php echo base_url(); ?>assetsatlan/js/atlantis.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/backend/js/oneui.core.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/backend/js/oneui.app.min.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/plugins/jquery-validation/jquery.validate.min.js"></script>     

	 <?php 
        if(isset($javascripts)): 
            foreach($javascripts AS $src) :
        ?><script src="<?php echo $src;?>"></script>
        <?php 
            endforeach;
            unset($javascripts,$src);
        endif;
        if( isset($scripts) && is_array($scripts) && count($scripts) > 0 ): 
            foreach($scripts AS $key => $script) :
                echo $script;
            endforeach;
            unset($scripts,$key,$script);
        endif;
        ?>
</body>
</html>