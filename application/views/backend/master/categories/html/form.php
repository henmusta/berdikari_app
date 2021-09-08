<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <div class="row">
        <div class="col-lg-8">
            <form id="<?php echo $id;?>" method="<?php echo $method;?>" autocomplete="off" action="<?php echo $action;?>" enctype="multipart/form-data">
                <input type="hidden" name="pk" value="<?php echo isset($data['category_id']) ? $data['category_id'] : NULL;?>">
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
                            <label class="col-md-3 col-form-label">Parent</label>
                            <div class="col-md-9">
                                <select id="<?php echo $select2_parent['id'];?>" class="form-control" name="data[parent_id]">
                                    <?php 
                                    echo (isset($data['parent_id']) && !empty($data['parent_id'])) 
                                        ? '<option value="'. $data['parent_id'] .'">'. $data['parent_title'] .'</option>'
                                        : NULL
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-3 col-form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Title" name="data[title]"
                                    required="required" value="<?php echo isset($data['title']) ? $data['title'] : NULL;?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" placeholder="Description" name="data[description]"><?php echo isset($data['description']) ? $data['description'] : NULL;?></textarea>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-3 col-form-label">Keywords</label>
                            <div class="col-md-9">
                                <textarea class="form-control" placeholder="Keywords" name="data[keywords]"><?php echo isset($data['keywords']) ? $data['keywords'] : NULL;?></textarea>
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
</div>
</div>