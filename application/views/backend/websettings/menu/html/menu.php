<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title"><?php echo ucwords($title);?><small><?php echo ucwords($subtitle);?></small></h3>
                </div>
                <div class="block-content">
                    <div class="dd form-group" style="float: none;" id="menuList"><?php echo $nestable;?></div>
                    <form class="mb-4" method="POST" action="<?php echo $change_hierarchy_url;?>" id="changeHierarchy">
                        <input type="hidden" id="output" name="hierarchy"/>
                        <button type="submit" class="btn btn-success btn-sm" style="display:none">Save Change <i class="fa fa-fw fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <form id="form-add" autocomplete="off">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title"><?php echo ucwords($title_form);?><small><?php echo ucwords($subtitle);?></small></h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>Title</label>
                            <div style="position:relative; display:block;">
                                <input id="in_title" type="text" class="form-control input-sm" name="menu[title]" value="<?php echo isset($edited['title']) ? $edited['title'] : NULL;?>"/>
                                <div id="result"></div>
                                <input type="hidden" name="menu[menu_type]" value="<?php echo $menu_type ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input id="in_url" type="text" class="form-control input-sm" name="menu[url]" value="<?php echo isset($edited['url']) ? $edited['url'] : NULL;?>"/>
                        </div>
                        <div class="form-group">
                            <label style="display: block;">Target</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-sm btn-info <?php echo !isset($edited["target"]) || (isset($edited["target"]) && empty($edited["target"])) || (isset($edited["target"]) && $edited["target"] == "_self") ? "active" : NULL;?>">
                                    <input type="radio" name="menu[target]" value="_self"> Self
                                </label>
                                <label class="btn btn-sm btn-info <?php echo isset($edited["target"]) && $edited["target"] == "_blank" ? "active" : NULL;?>">
                                    <input type="radio" name="menu[target]" value="_blank"> Blank
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="pk" value="<?php echo isset($edited['menu_id']) ? $edited['menu_id'] : NULL;?>">
                        <div class="form-group">
                            <div class="card-footer"><div class="btn-group"><?php echo $form_btn ?></div></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>