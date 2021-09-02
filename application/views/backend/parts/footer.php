<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                            Developed <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="//ginktech.net" target="_blank">Gink Technology</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                            <a class="font-w600" href="https://1.envato.market/xWy" target="_blank">Kupastuntas.co</a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
        <script src="../assets/backend/js/oneui.core.min.js"></script>
        <script src="../assets/backend/js/oneui.app.min.js"></script>
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