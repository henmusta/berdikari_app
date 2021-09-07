<section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Redaksi</a></li>
            </ul>
        </div>
</section>
<style>
	.redaksi_table{
		margin-bottom: 0;
	}
	.redaksi_table h3{
		font-size: 18px;
	}
	ol.daerah {
		counter-reset: counter;
		list-style: none;
		padding-left: 40px;
	}
	ol.daerah li {
		margin: 0 0 0.5rem 0;
		counter-increment: counter;
		position: relative;
	}
	ol.daerah li::before {
		content: counter(counter) ".";
		font-size: 18px;
		position: absolute;
		left: -25px;
		line-height: 28px;
		width: 20px;
		text-align: right;
		top: 0;
}
</style>
<div class="bg-white">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-8">
				<table class="table table-sm table-borderless redaksi_table">
					<?php foreach($lists['pusat'] AS $key => $l ){ 
							if (count($l) == null) { ?>
								<tr>
									<td style="width: 200px;"><h3 class="font-weight-bold"><?=$key?></h3></td>
									<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
									<td><h3> - </h3></td>
								</tr>
							<?php }
							if (count($l) <= 1) {
								foreach($l AS $v){?>
									<?php if($v['sort'] == 1 ){?>
										<tr>
											<td text-align="center" colspan="3">
												<img src="<?=$v['photo']?>" style="width: 100%; max-width: 300px;" class="mb-3"  alt="">
												<h3><?=$v['fullname'];?></h3>
												<h3 class="font-weight-bold mb-5"><?=$v['nama'];?></h3>
											</td>
										</tr>
									<?php }else{?>
										<tr>
											<td style="width: 200px;"><h3 class="font-weight-bold"><?=$v['nama'];?></h3></td>
											<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
											<td><h3><?=$v['fullname'];?></h3></td>
										</tr>
									<?php }
								}
							}else{?>
									<tr>
										<td style="width: 150px;"><h3 class="font-weight-bold"><?=$key?></h3></td>
										<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
										<td>
											<ol style="padding-left: 15px;">
								<?php foreach($l AS $v){?>
										<li>
											<h3>
												<?=$v['fullname'];?> <?php echo (isset($v['phone']) && $v['phone'] != null && $v['nama'] == "Marketing Iklan" ) ? ( ' (' . $v['phone'] . ')') : NULL; ?> 
											</h3>
										</li>
								<?php } ?> 
										</td>
									</tr>
							<?php }
							
					 } ;?>
					<tr>
						<td style="width: 200px;" colspan="3"><h3 class="font-weight-bold mb-0">Daerah</h3></td>
					</tr>
					<tr>
						<td colspan="3">
							<ol class="daerah">
								<?php foreach($lists['daerah'] AS $key => $d) : 
									if (count($d) == null) { ?>
										<li>
											<table class="table table-borderless redaksi_table">
												<tr>
													<td style="width: 150px;">
														<h3><?=$key?></h3>
													</td>
													<td>
														<h3>Kepala Biro : -</h3>
														<h3>Wartawan : -</h3>
													</td>
												</tr>
											</table>
										</li>
									<?php }else{ ?>
										<li>
											<table class="table table-borderless redaksi_table">
												<tr>
													<td style="width: 150px;">
														<h3><?=$key?></h3>
													</td>
														<td>
														<?php 
														$cek_k = true;
														$cek_w = false;
														$count = 0;
														$cw = 0;
														foreach($d AS $v) :
															if ($v['nama'] == 'Wartawan') {
																$cek_w = true;;
															} 
															if ($v['nama'] != 'Kepala Biro' && $cek_k == true && $count == 0) {
																$cek_k = false; 
																$count++; ?>
																<h3>Kepala Biro : - </h3>
															<?php } if ($v['nama'] == 'Wartawan' && $cek_k == false){
																$count++; ?>
																<h3><?=$v['nama']?> : <?=$v['fullname']?></h3>
															<?php }else { 
																$count++;?>
																<h3><?=$v['nama']?> : <?=$v['fullname']?></h3>
															<?php } ?>
														<?php endforeach; ?>
														<?php if ($cek_w == false) {?>
															<h3>Wartawan : - </h3>
														<?php } ?>
													</td>
												</tr>
											</table>
										</li>
									<?php } ?>
								
								<?php endforeach; ?>
							</ol>
						</td>
					</tr>
				</table>
				<p><br></p><p style="text-align: center;"><span style="font-weight: 600; color: rgb(255, 0, 0); text-align: center;">WARTAWAN KUPAS TUNTAS DISERTAI TANDA PENGENAL DAN DILARANG MEMINTA ATAU MENERIMA IMBALAN DALAM BENTUK APAPUN YANG BERKAITAN DENGAN TUGAS JURNALISNYA.</span><br></p>
				<p class="text-center">Alamat E-mail : kupastuntas7@gmail.com</p>
			</div>
		</div>
	</div>
</div>
