<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <form id="<?php echo $id;?>" method="<?php echo $method;?>" autocomplete="off" action="<?php echo $action;?>" enctype="multipart/form-data">
                <input type="hidden" name="pk" value="<?php echo isset($data['author_id']) ? $data['author_id'] : NULL;?>">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title"><?php echo ucwords($title);?><small><?php echo ucwords($subtitle);?></small></h3>
                        <div class="block-options">
                            <a href="javascript:history.back();" class="btn btn-sm btn-outline-danger">
                                <i class="far fa-window-close"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Photo</label>
                            <div class="col-md-8 form-image-container">
                            <?php 
                            $photo = isset($data['photo']) && is_file(UPLOADS_FOLDER . 'administrators' . DS . $data['photo']) ? 
                            '../uploads/administrators/'. $data['photo'] :
                            '../assets/backend/media/avatars/avatar.jpg';
                            ?>
                            <img src="<?php echo $photo;?>" class="img-thumbnail" style="max-height:100px;max-width:100%;"/>
                                <input class="form-image-input" type="file" name="photo">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Username" name="data[username]"
                                    required="required">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Fullname</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Fullname" name="data[fullname]"
                                    required="required">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Status</label>
                            <div class="col-md-8">
                                <select class="form-control" id="example-select" name="data[status]">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="redirect" name="redirect" value="history.back()">
                                    <label class="custom-control-label" for="redirect">Kembali Ke halaman daftar</label>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>