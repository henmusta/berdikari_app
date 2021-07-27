<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="block block-themed">
                <div class="block-header bg-smooth-dark">
                    <div class="block-options" style="padding-left:0%">
                        <button type="button" class="btn-block-option">
                            <a href="javascript:history.back();" style="color:rgba(255,255,255,.9);">
                                <i class="far fa-arrow-alt-circle-left"></i>
                            </a>
                        </button>
                    </div>
                    <h3 class="block-title"><?php echo ucwords($title) ?></h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td width="20%">From</td>
                                <td width="1%">:</td>
                                <td><?php echo isset($data['name']) ? $data['name'] : NULL;?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo isset($data['email']) ? $data['email'] : NULL;?></td>
                            </tr>
                            <tr>
                                <td>Date Create</td>
                                <td>:</td>
                                <td><?php echo isset($data['date_create']) ? date_indonesia($data['date_create'],'d F Y H:i') : NULL;?></td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>:</td>
                                <td><?php echo isset($data['subject']) ? $data['subject'] : NULL;?></td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td>:</td>
                                <td><?php echo isset($data['message']) ? $data['message'] : NULL;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>