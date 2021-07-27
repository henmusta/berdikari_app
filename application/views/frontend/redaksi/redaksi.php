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
					<?php if($lists[0]['sort'] == 1 ){?>
						<tr>
							<td align="center" colspan="3">
								<img src="<?=$lists[$i]['photo']?>" style="width: 100%; max-width: 300px;" class="mb-3"  alt="">
								<h3><?=$lists[$i]['fullname'];?></h3>
								<h3 class="font-weight-bold mb-5"><?=$lists[$i]['position'];?></h3>
							</td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td align="center" colspan="3">
								<img src="" style="width: 100%; max-width: 300px;" class="mb-3"  alt="">
								<h3>-</h3>
								<h3 class="font-weight-bold mb-5">Chief Executive Officer</h3>
							</td>
						</tr>
					<?php }; ?>
					<?php for($i=0;$i<count($lists);$i++){ 
						if($lists[$i]['sort'] == 1 ){?>
							<tr>
								<td align="center" colspan="3">
									<img src="<?=$lists[$i]['photo']?>" style="width: 100%; max-width: 300px;" class="mb-3"  alt="">
									<h3><?=$lists[$i]['fullname'];?></h3>
									<h3 class="font-weight-bold mb-5"><?=$lists[$i]['position'];?></h3>
								</td>
							</tr>
						<?php };

					} ?>
					
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Pimpinan Perusahaan</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Suhaili, S.E.</h3></td>
					</tr>
					<!-- <tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Pimpinan Redaksi</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Zainal Hidayat, S.H.</h3></td>
					</tr>
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Sekretaris Redaksi</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Reni Susilawati</h3></td>
					</tr>
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Redaktur</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Herwanda Pratama</h3></td>
					</tr>
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Asisten Redaktur</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Erik Handoko</h3></td>
					</tr>
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Manager Keuangan</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Vera Leonita</h3></td>
					</tr>
					<tr>
						<td style="width: 200px;"><h3 class="font-weight-bold">Staff Keuangan</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td><h3>Nur Hakiki</h3></td>
					</tr> -->
					<tr>
						<td style="width: 200px;" colspan="3"><h3 class="font-weight-bold mb-0">Marketing Iklan</h3></td>
					</tr>
					<tr>
						<td colspan="3">
							<ol>
								<li><h3>Reny Agustina (0821-7870-3737)</h3></li>
								<li><h3>Amin Nainggolan (0821-7758-7557)</h3></li>
								<li><h3>Tiara Septia Roza (0821-8166-2886)</h3></li>
							</ol>
						</td>
					</tr>
				</table>
				<table class="table table-sm table-borderless redaksi_table">
					<tr>
						<td style="width: 150px;"><h3 class="font-weight-bold">Wartawan Kota</h3></td>
						<td style="width: 10px; padding: 4.8px 0; text-align: center;">:</td>
						<td>
							<ol style="padding-left: 15px;">
								<li><h3>Siti Khoiria</h3></li>
								<li><h3>Sri</h3></li>
								<li><h3>Rohmah Mustaurida</h3></li>
								<li><h3>Yosepin Wulandari</h3></li>
							</ol>
						</td>
					</tr>
					<tr>
						<td style="width: 200px;" colspan="3"><h3 class="font-weight-bold mb-0">Daerah</h3></td>
					</tr>
					<tr>
						<td colspan="3">
							<ol class="daerah">
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Barat</h3>
											</td>
											<td>
												<h3>Kepala Biro : Satoris M. Baki</h3>
												<h3>Wartawan : Iwan Irawan</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Barat</h3>
											</td>
											<td>
												<h3>Kepala Biro : Satoris M. Baki</h3>
												<h3>Wartawan : Iwan Irawan</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Selatan</h3>
											</td>
											<td>
												<h3>Kepala Biro : Sodugaon Sinaga</h3>
												<h3>Wartawan : Imanuel Simorangkir</h3>
												<h3>Wartawan : Ferry Silalahi</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Utara</h3>
											</td>
											<td>
												<h3>Kepala Biro : Arnold Sitorus</h3>
												<h3>Wartawan : Riki Purnama</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Tengah</h3>
											</td>
											<td>
												<h3>Kepala Biro : -</h3>
												<h3>Wartawan : Sutowo</h3>
												<h3>Wartawan : Hendra</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Lampung Timur</h3>
											</td>
											<td>
												<h3>Kepala Biro : -</h3>
												<h3>Wartawan : Agus Susanto</h3>
												<h3>Wartawan : Sigit Darmaji</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Metro</h3>
											</td>
											<td>
												<h3>Kepala Biro : Djohansyah</h3>
												<h3>Wartawan : Arby Pratama</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Tanggamus</h3>
											</td>
											<td>
												<h3>Kepala Biro : Elya</h3>
												<h3>Wartawan : Sayuti</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Pringsewu</h3>
											</td>
											<td>
												<h3>Kepala Biro : Tutor Manalu</h3>
												<h3>Wartawan : Rifaldi Suhaloho</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Tulang Bawang</h3>
											</td>
											<td>
												<h3>Kepala Biro : Erwinsyah</h3>
												<h3>Wartawan : -</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Tulang Bawang Barat</h3>
											</td>
											<td>
												<h3>Kepala Biro : Ari Irawan</h3>
												<h3>Wartawan : Lucky Nurjaya</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Pesisir Barat</h3>
											</td>
											<td>
												<h3>Kepala Biro : Nova Liance</h3>
												<h3>Wartawan : Echa</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Way Kanan</h3>
											</td>
											<td>
												<h3>Kepala Biro : Fito Aliesetiady</h3>
												<h3>Wartawan : Sandi</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Mesuji</h3>
											</td>
											<td>
												<h3>Kepala Biro : -</h3>
												<h3>Wartawan : Komang Eke Suwardane</h3>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-borderless redaksi_table">
										<tr>
											<td style="width: 150px;">
												<h3>Pesawaran</h3>
											</td>
											<td>
												<h3>Kepala Biro : -</h3>
												<h3>Wartawan : Ragilia</h3>
											</td>
										</tr>
									</table>
								</li>
							</ol>
						</td>
					</tr>
					<tr>
						<td colspan="3"><h3 class="text-center">Alamat E-mail : kupastuntas7@gmail.com</h3></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
