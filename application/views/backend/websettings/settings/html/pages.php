<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Content -->
<div class="content">
    <!-- Inline -->
    <style>
        .editable-container.editable-inline, .editable-container.editable-inline > div{
            width: 100%;
        }
        .form-inline.form-group, .form-inline.form-group > div{
            width: 100%;
        }
        .editableform .control-group, .editableform .control-group > div{
            width: 100% !important;
            display: flex;
            align-items: center;
        }
        .editable-input{
            width: calc(100% - 70px);
        }
        .form-inline .form-control{
            width: 100%;
        }
        .editable-cancel{
            background: #da251d !important;
            color: #fff !important; 
        }
    </style>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"><?php echo $title ?></h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-block-logo">Upload Logo</button>
                <button type="reset" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-block-favicon">Upload Favicon</button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive content-table">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <tbody>
                    <?php
                    $notin = array('logo_image','favicon_image');
                    foreach($settings AS $val){
                        if (!in_array($val['keyword'], $notin)) {
                    ?>
                    <tr>
                        <td style="width:180px;"><?php echo ucwords(str_replace(array("_")," ",$val["keyword"]));?></td>
                        <td style="width:10px;">:</td>
                        <td style="width:calc(100% - 190px);">
                            <a href="#"
                                class="editable" 
                                e-style="width: 100%"
                                data-name="keyword"
                                data-type="<?php echo $val["type"];?>" 
                                data-pk="<?php echo $val["setting_id"];?>" 
                                data-url="settings/update"><?php echo ($val["setting_id"] == 8) ? htmlentities($val["value"]) : $val["value"];?></a>
                            </td>
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Modal Images-->
<div class="modal fade" id="modal-block-logo" tabindex="-1" role="dialog" aria-labelledby="modal-block-logo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <form action="settings/update-logo" id="form-image-logo" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Upload Image</h3>
                    </div>
                    <div class="block-content font-size-sm form-image-container">
                        <?php 
                        $photo = isset($logo->value) && is_file(UPLOADS_FOLDER . DS . $logo->value) ? 
                        '../uploads/'. $logo->value :
                        '../assets/backend/media/settings/logo.png';
                        ?>
                        <img class="img-fluid img-thumbnail mx-auto d-block" src="<?php echo $photo ?>" style="width:50%;"/>
                        <input type="file" name="file" class="form-image-input mt-3" style="font-size: 12px;" />
                        <p class="mt-2">Recomended dimension 264x41 pixel and max filesize 2.0MB</p>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Favicon-->
<div class="modal fade" id="modal-block-favicon" tabindex="-1" role="dialog" aria-labelledby="modal-block-favicon" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <form action="settings/update-favicon" id="form-image-favicon">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Upload Favicon</h3>
                    </div>
                    <div class="block-content font-size-sm form-favicon-container">
                        <?php 
                        $photo = isset($favicon->value) && is_file(UPLOADS_FOLDER . 'favicon' . DS . $favicon->value) ? 
                        '../uploads/favicon/'. $favicon->value :
                        '../assets/backend/media/settings/favicon.png';
                        ?>
                        <img class="img-fluid img-thumbnail mx-auto d-block" src="<?php echo $photo ?>" style="width:50%;"/>
                        <input type="file" name="file" class="form-favicon-input mt-3" style="font-size: 12px;" />
                        <p class="mt-2">Recomended dimension 300x300 pixel and max filesize 2.0MB</p>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>