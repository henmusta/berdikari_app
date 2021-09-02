<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <form id="<?php echo $id;?>" method="<?php echo $method;?>" autocomplete="off" action="<?php echo $action;?>" enctype="multipart/form-data">
                <input type="hidden" name="pk" value="<?php echo isset($data['id']) ? $data['id'] : NULL;?>">
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
                            <label class="col-md-4 col-form-label">Nama Jabatan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Jabatan" name="data[nama]"
                                    required="required" value="<?php echo isset($data['nama']) ? $data['nama'] : NULL;?>">
                            </div>
                        </div>
						<div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Location</label>
							<div class="col-md-8">
								<select id="select-location" class="form-control" placeholder="location" name="data[location]" required="required">
									<option value="pusat">Pusat</option>
									<option value="daerah">Daerah</option>
								</select>
							</div>
						</div>
						<div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label">Sort</label>
                            <div class="col-md-8">
                                <select class="custom-select" name="data[sort]">
								<?php 
                                    echo isset($data['sort']) ? '<option value="'.$data['sort'].'">'.$data['sort'].'</option>' : NULL;
                                    for($i=1; $i<= 100; $i++){ 
                                        if (!in_array($i, $sort)) {
                                        ?>
                                    <?php 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    ?>
                                        <?php } } ?>
                                </select>
                            </div>
                        </div>
						<div class="form-group row align-items-center">
							<label class="col-md-4 form-label">Show In Redaksi</label>
							<div class="col-md-8">
								<div class="space-x-2">
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="example-radios-inline1" name="data[show]" value="1" 
									<?php echo isset($data['show']) && $data['show']== 1 ? 'checked' : '' ?> >
									<label class="form-check-label" for="example-radios-inline1">Yes</label>
									</div>
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="example-radios-inline2" name="data[show]" value="0"
									<?php echo isset($data['show']) && $data['show']== 0 ? 'checked' : '' ?> >
									<label class="form-check-label" for="example-radios-inline2">No</label>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
