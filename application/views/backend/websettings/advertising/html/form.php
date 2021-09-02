<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <form id="<?php echo $id;?>" method="<?php echo $method;?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="pk" value="<?php echo isset($data['ads_id']) ? $data['ads_id'] : NULL;?>">
                <input type="hidden" name="data[title]" value="<?php echo isset($data['title']) ? $data['title'] : NULL;?>">
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
                            <label class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="<?php echo isset($data['title']) ? $data['title'] : NULL;?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Type</label>
                            <div class="col-md-8">
                                <select id="type" class="custom-select" name="data[type]">
                                    <option value="script" <?php echo isset($data['type']) && $data['type'] == 'script' ? 'selected' : NULL;?> >Script</option>
                                    <option value="image" <?php echo isset($data['type']) && $data['type'] == 'image' ? 'selected' : NULL;?>>Image</option>
                                </select>
                            </div>
                        </div>
                        <div id="banner-script">
                            <div class="form-group row align-items-center">
                                <label id="lvalue" class="col-md-4 col-form-label">Your Adv Script</label>
                                <div class="col-md-8">
                                    <textarea id="value" class="form-control" name="data[value]" rows="7" placeholder=""><?php echo isset($data['value']) ? $data['value'] : NULL;?></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="banner-image">
                            <div class="form-group row align-items-center">
                                <label class="col-md-4 col-form-label">Image</label>
                                <div class="col-md-8 form-image-container">
                                <?php 
                                $photo = isset($data['value']) && is_file(UPLOADS_FOLDER . 'banner' . DS . $data['value']) ? 
                                '../uploads/banner/'. $data['value'] :
                                '../assets/backend/media/avatars/avatar.jpg';
                                ?>
                                <img src="<?php echo $photo;?>" class="img-thumbnail" style="max-height:100px;max-width:100px;"/>
                                    <input class="form-image-input" type="file" name="photo">
                                </div>
                            </div>                        
                            <div class="form-group row align-items-center">
                                <label class="col-md-4 col-form-label">Link Url</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="data[permalink]" rows="3" placeholder=""><?php echo isset($data['permalink']) ? $data['permalink'] : NULL;?></textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-md-4 col-form-label">Target</label>
                                <div class="col-md-8">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-sm btn-info <?php echo !isset($data["target"]) || (isset($data["target"]) && empty($data["target"])) || (isset($data["target"]) && $data["target"] == "_self") || (isset($data["target"]) && $data["target"] == "_self") ? "active" : NULL;?>">
                                            <input type="radio" name="data[target]" value="_self"> Self
                                        </label>
                                        <label class="btn btn-sm btn-info <?php echo isset($data["target"]) && $data["target"] == "_blank" ? "active" : NULL;?>">
                                            <input type="radio" name="data[target]" value="_blank"> Blank
                                        </label>
                                    </div>
                                </div>
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