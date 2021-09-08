<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="block block-link-shadow text-center">
                <div class="block-header">
                    <h3 class="block-title"><?php echo ucwords($title);?><small><?php echo ucwords($subtitle);?></small></h3>
                </div>
                <div class="block-content p-0">
                    <div class="row justify-content-center">
                        <div class="btn-group">
                            <a href="<?php echo $links['lists'];?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-fw fa-list"></i> Lists
                            </a>
                            <a href="<?php echo $links['add-new'];?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-fw fa-plus-circle"></i> Add New
                            </a>
                            <a href="<?php echo $links['edit'];?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-fw fas fa-fw fa-pencil-alt"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="block-header text-center">
                    <h3 class="block-title"><?php echo $data['customer_name'];?></h3>
                </div>
                <div class="block-content bg-body-light py-2 text-center">
                    <?php 
                    $photo = isset($data['customer_photo']) && is_file(UPLOADS_FOLDER . 'public' . DS . 'customers' . DS . $data['customer_photo']) ? 
                    'assets/uploads/public/customers/'. $data['customer_photo'] :   
                    'assets/uploads/static/no-image/avatar.jpg';
                    ?>
                    <img src="<?php echo $photo;?>" class="img-thumbnail" style="max-width:120px;max-height:120px;"/>
                </div>
                <div class="block-content font-size-sm py-3">
                    <div class="row justify-content-center">
                        <p class="mb-1 col text-right"><strong>Gender</strong></p>
                        <p class="mb-1 col-1 text-center"><strong>:</strong></p>
                        <p class="mb-1 col text-left"><strong><?php echo $data['customer_gender'];?></strong></p>
                    </div>
                    <div class="row justify-content-center">
                        <p class="mb-1 col text-right"><strong>Email</strong></p>
                        <p class="mb-1 col-1 text-center"><strong>:</strong></p>
                        <p class="mb-1 col text-left"><strong><a href="mailto:<?php echo $data['customer_email'];?>">
                            <?php echo $data['customer_email'];?></a></strong></p>
                    </div>
                    <div class="row justify-content-center">
                        <p class="mb-1 col text-right"><strong>Phone Primary</strong></p>
                        <p class="mb-1 col-1 text-center"><strong>:</strong></p>
                        <p class="mb-1 col text-left"><strong>
                            <a href="tel:<?php echo $data['customer_phone_primary'];?>">
                            <?php echo $data['customer_phone_primary'];?></a></strong></p>
                    </div>
                    <div class="row justify-content-center">
                        <p class="mb-1 col text-right"><strong>Phone Secondary</strong></p>
                        <p class="mb-1 col-1 text-center"><strong>:</strong></p>
                        <p class="mb-1 col text-left"><strong><a href="tel:<?php echo $data['customer_phone_secondary'];?>">
                            <?php echo $data['customer_phone_secondary'];?></a></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>