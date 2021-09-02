<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Content -->
<div class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="block">
				<div class="block-content pb-4">
					<div class="row">
						<div class="col-md-5">
							<?php 
                            $photo = isset($data['media_source']) && is_file(UPLOADS_FOLDER . 'posts/small/' . DS . $data['media_source']) ? 
                            '../uploads/posts/small/'. $data['media_source'] :
                            '../assets/backend/media/posts/berita.jpg';
							?>
							<img class="img-fluid" src="<?php echo $photo;?>">
							<div class="btn-group btn-group-sm mt-3" role="group" aria-label="Small Outline Primary">
								<a href="berita-foto" class="btn btn-outline-secondary">Back to Lists</a>
								<a href="berita-foto/edit/<?php echo $data['post_id'];?>" class="btn btn-outline-secondary">Edit</a>
							</div>
						</div>
						<div class="col-md-7">
							<h4 class="h4"><?php echo $data['title'];?></h4>
							<div style="font-size:.8rem;"><?php echo $data['synopsis'];?></div>							
						</div>
					</div>
				</div>
			</div>
			<div class="block">
				<div class="block-content pb-4">
					<form id="<?php echo $dropzone['id'];?>" class="dropzone" action="<?php echo $dropzone['action'];?>">
						<input type="hidden" name="post_id" value="<?php echo $data['post_id'];?>">
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block">
				<div class="block-header">
					<h3 class="block-title"><?php echo ucwords($datatable['title']);?><small><?php echo ucwords($datatable['subtitle']);?></small></h3>
				</div>
				<div class="block-content pb-4">
					<table id="<?php echo $datatable['id'];?>" class="table table-bordered table-striped">
					<?php echo $datatable['thead'] . '<tbody></tbody>' . $datatable['tfoot'];?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>