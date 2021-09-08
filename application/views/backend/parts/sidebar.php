		<!-- Sidebar -->
		<?php 
                    $session_photo = $this->session->user->photo;
                    $photo = isset($session_photo) && is_file(UPLOADS_FOLDER . 'administrators' . DS . $session_photo) ? 
                    '../uploads/administrators/'. $session_photo :
                    '../assets/backend/media/avatars/avatar.jpg';
                    ?>
		<div class="sidebar sidebar-style-2" data-background-color="dark2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo $photo ?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
                                    <?php echo $this->session->user->username;?>
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="administrators/edit/<?php echo $this->session->user->administrator_id;?>">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="auth/sign-out">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item <?php echo  $this->uri->segment(2) == 'dashboard' ||   $this->uri->segment(2) == ''  ? 'active' : '' ; ?>">
							<a href="dashboard">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Master Data</h4>
						</li>
						<li class="nav-item <?php echo  $this->uri->segment(2) == 'authors' ? 'active' : '' ; ?>">
							<a href="authors">
								<i class="fa fa-users"></i>
								<p>Authors</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'jabatan' ? 'active' : '' ; ?>">
							<a href="jabatan">
								<i class="fa fa-sitemap"></i>
								<p>Jabatan</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'redaksi' ? 'active' : '' ; ?>">
							<a href="redaksi">
								<i class="fa fa-building"></i>
								<p>Redaksi</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'categories' ? 'active' : '' ; ?>">
							<a href="categories">
								<i class="fa fa-tags"></i>
								<p>Categories</p>
							</a>
						</li>

                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Post</h4>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'page' ? 'active' : '' ; ?>">
							<a href="page">
								<i class="fas fa-layer-group"></i>
								<p>Page</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'berita' ? 'active' : '' ; ?>">
							<a href="berita">
								<i class="fa fa-newspaper"></i>
								<p>Berita</p>
							</a>
						</li>
                        <!-- <li class="nav-item">
							<a href="">
								<i class="fas fa-images"></i>
								<p>Berita Foto</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="">
								<i class="fas fa-pen-square"></i>
								<p>Infografis</p>
							</a>
						</li> -->
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'e-paper' ? 'active' : '' ; ?>">
							<a href="e-paper">
								<i class="far fa-address-book"></i>
								<p>E-Paper</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'kupas-tv' ? 'active' : '' ; ?>">
							<a href="kupas-tv">
								<i class="fa fa-tv"></i>
								<p>Kupas TV</p>
							</a>
						</li>

                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">INTERACTIONS</h4>
						</li>

                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'guestbooks' ? 'active' : '' ; ?>">
							<a href="guestbooks">
								<i class="far fa-address-book"></i>
								<p>Questbook</p>
							</a>
						</li>

                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">WEB SETTINGS</h4>
						</li>

                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'settings' ? 'active' : '' ; ?>">
							<a href="settings">
								<i class="fa fa-folder-open"></i>
								<p>Settings</p>
							</a>
						</li>
                        <li class="nav-item <?php echo  $this->uri->segment(2) == 'administrators' ? 'active' : '' ; ?>">
							<a href="administrators">
								<i class="fas fa-layer-group"></i>
								<p>Administrator</p>
							</a>
						</li>
                        <li class="nav-item  <?php echo  $this->uri->segment(2) == 'menu' ? 'active' : '' ; ?>">
							<a href="menu">
								<i class="fas fa-layer-group"></i>
								<p>Menu Manager</p>
							</a>
						</li>
                        <li class="nav-item  <?php echo  $this->uri->segment(2) == 'advertising' ? 'active' : '' ; ?>">
							<a href="advertising">
								<i class="fas fa-layer-group"></i>
								<p>Advertesing</p>
							</a>
						</li>

				
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->