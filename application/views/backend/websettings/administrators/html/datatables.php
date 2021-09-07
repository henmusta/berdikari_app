<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Content -->
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title"><?php echo ucwords($title);?><small><?php echo ucwords($subtitle);?></small></h3>
            <div class="block-options">
                <a href="<?php echo $btn_add_new;?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-fw fa-plus-circle"></i> Add New
                </a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table id="<?php echo $id;?>" class="table table-bordered table-striped" width="100%">
                    <?php echo $thead . '<tbody></tbody>' . $tfoot;?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->


<!-- Modal Edit -->
<div class="modal fade" id="modalreset" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <form action="<?php echo $reset_url ?>" id="form-reset" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">RESET PASSWORD</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm modal-body">
                        <input type="hidden" name="pk" />
                        <p>Anda yakin ingin mereset password ke default ?</p>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Ok</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>