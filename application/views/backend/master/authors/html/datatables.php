<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Content -->



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title"><?php echo ucwords($title);?><small><?php echo ucwords($subtitle);?></small></h4>
                    <a href="<?php echo $btn_add_new;?>" class="btn btn-sm btn-outline-primary btn-round ml-auto">
                    <i class="fas fa-fw fa-plus-circle"></i> Add New
                </a>
                    <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Row
                    </button> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   <table id="<?php echo $id;?>" class="table table-bordered table-striped" width="100%">
                    <?php echo $thead . '<tbody></tbody>' . $tfoot;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>





<!-- END Page Content -->