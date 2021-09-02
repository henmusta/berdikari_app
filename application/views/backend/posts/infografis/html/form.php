<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <form id="<?php echo $id;?>" method="<?php echo $method;?>" autocomplete="off" action="<?php echo $action;?>" enctype="multipart/form-data">
        <input type="hidden" name="pk" value="<?php echo isset($data['post_id']) ? $data['post_id'] : NULL;?>">
        <div class="row">
            <div class="col-12">
                <div class="block mb-2">
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
                </div>
            </div>
            <div class="col-md-8">
                <div class="block">
                    <div class="block-content">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control " name="data[title]" required="required" maxlength="255" value="<?php echo isset($data['title']) ? $data['title'] : NULL;?>"/>
                        </div>
                        <div class="form-group" style="font-size:14px;">
                            <textarea id="summernote" class="form-control" name="data[content]"><?php echo isset($data['content']) ? $data['content'] : NULL;?></textarea>
                        </div>
                        <div class="form-group align-items-center">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="redirect" name="redirect" value="history.back()">
                                <label class="custom-control-label" for="redirect">Kembali Ke halaman daftar</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block">
                    <div class="block-content">
                        <div class="form-group">
                            <label>Author</label>
                            <select id="<?php echo $select2_authors['id']?>" class="form-control" name="data[author_id]" required="required">
                            <?php 
                            if(isset($data['author_id'])){
                                echo '<option value="'. $data['author_id'] .'" selected="selected">'. $data['author_fullname'] .'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block bg-gray-light" >
                        <li class="nav-item">
                            <a class="nav-link active" href="#status-tab" data-toggle="tab">Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#img-tab" data-toggle="tab">Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#seo-tab" data-toggle="tab">SEO</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="status-tab" role="tabpanel">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rd-draft" name="data[status]" value="draft" 
                                    <?php echo (!isset($data['status']) || (isset($data['status']) && trim($data['status']) == 'draft' ) ) ? 'checked="checked"' : NULL ?>>
                                    <label class="custom-control-label" for="rd-draft">Draft</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rd-publish" name="data[status]" value="publish"
                                    <?php echo (isset($data['status']) && trim($data['status']) == 'publish' ) ? 'checked="checked"' : NULL ?>>
                                    <label class="custom-control-label" for="rd-publish">Publish</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Time Publish</label>
                                <input type="text" class="form-control flatpickr" name="data[date_publish]" value="<?php echo isset($data['date_publish']) ? $data['date_publish'] : date("Y-m-d H:i");?>"/>
                            </div>
                        </div>
                        <div class="tab-pane" id="img-tab" role="tabpanel">
                            <div class="form-group">
                                <label>Image</label>
                                <?php 
                                $photo = isset($data['media_source']) && is_file(UPLOADS_FOLDER . 'posts' . DS . $data['media_source']) ? 
                                '../uploads/posts/'. $data['media_source'] :
                                '../assets/backend/media/posts/infografis.jpg';
                                ?>
                                <div class="form-image-container">
                                    <img src="<?php echo $photo;?>" class="img-thumbnail img-fluid"/>
                                    <input class="form-image-input" type="file" name="photo">
                                </div>
                                <small class="form-text text-muted">Recomended dimention 500x500 pixel and max filesize 2.0MB</small>
                            </div>
                            <div class="form-group">
                                <label>Caption</label>
                                <textarea class="form-control input-sm" rows="5" name="data[media_caption]"><?php echo isset($data['media_caption']) ? $data['media_caption'] : NULL;?></textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="seo-tab" role="tabpanel">
                            <div class="form-group">
                                <label>Synopsis</label>
                                <textarea class="form-control input-sm" rows="7" name="data[synopsis]"><?php echo isset($data['synopsis']) ? $data['synopsis'] : NULL;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Keywords</label>
                                <textarea class="form-control input-sm" rows="3" name="data[keywords]"><?php echo isset($data['keywords']) ? $data['keywords'] : NULL;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
