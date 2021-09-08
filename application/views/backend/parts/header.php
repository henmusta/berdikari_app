<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<base href="<?php echo base_url('backend');?>/">
<title><?php echo isset($heading['subtitle']) && !empty($heading['subtitle'] ) ? str_replace("_", "", $heading['subtitle']) : NULL ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	
	     <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <!-- generics -->
        <link rel="icon" href="../uploads/favicon/favicon-32.png" sizes="32x32">
        <link rel="icon" href="../uploads/favicon/favicon-57.png" sizes="57x57">
        <link rel="icon" href="../uploads/favicon/favicon-76.png" sizes="76x76">
        <link rel="icon" href="../uploads/favicon/favicon-96.png" sizes="96x96">
        <link rel="icon" href="../uploads/favicon/favicon-128.png" sizes="128x128">
        <link rel="icon" href="../uploads/favicon/favicon-192.png" sizes="192x192">
        <link rel="icon" href="../uploads/favicon/favicon-228.png" sizes="228x228">

        <!-- Android -->
        <link rel="shortcut icon" sizes="196x196" href="../uploads/favicon/favicon-196.png">
        <!-- iOS -->
        <link rel="apple-touch-icon" href="../uploads/favicon/favicon-120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="path/to/favicon-152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="path/to/favicon-180.png" sizes="180x180">

        <!-- Windows 8 IE 10-->
        <meta name="msapplication-TileColor" content="#0161b7">
        <meta name="msapplication-TileImage" content="../uploads/favicon/favicon-144.png">
        <!-- END Icons -->
	
	<!-- Fonts and icons -->
	<script src="<?php echo base_url(); ?>/assetsatlan/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url(); ?>/assetsatlan/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetsatlan/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetsatlan/css/atlantis.min.css">
	<!-- <link rel="stylesheet" id="css-main" href="../assets/backend/css/oneui.min.css"> -->

	<link rel="stylesheet" id="css-main" href="<?php echo base_url(); ?>assets/backend/css/oneui.min.css">
<style>
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
.select2-container {
width: 100% !important;
}
</style>

	<?php 
        if(isset($stylesheets)): 
            foreach($stylesheets AS $href) :
            ?><link rel="stylesheet" href="<?php echo $href;?>"/>
            <?php endforeach; unset($stylesheets,$href);
        endif;
        ?>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="dark2">
				
				<a href="dashboard" class="logo">
					<img src="../uploads/kupastuntas/logoberdikari.png" alt="navbar brand" class="navbar-brand" width="180px">
				</a>

				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			     <?php 
                    $session_photo = $this->session->user->photo;
                    $photo = isset($session_photo) && is_file(UPLOADS_FOLDER . 'administrators' . DS . $session_photo) ? 
                    '../uploads/administrators/'. $session_photo :
                    '../assets/backend/media/avatars/avatar.jpg';
                    ?>
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="white">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?php echo $photo ?>"  alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?php echo $photo ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $this->session->user->fullname;?></h4>
											</div>
										</div>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
    	<?php include('sidebar.php');?>
		<div class="main-panel">
		    <div class="content">





                <div class="page-inner">
                   <?php if(isset($heading['title'])) : ?>
                <!-- Hero -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill h3 my-2">
                                <?php echo isset($heading['title']) ? strtoupper($heading['title']) : NULL;?>
                                <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"><?php echo isset($heading['subtitle']) ? ucwords($heading['subtitle']) : NULL;?></small>
                            </h1>
                            <?php if(isset($heading['breadcrumbs']) && is_array($heading['breadcrumbs']) && count($heading['breadcrumbs']) > 0):?>
                            <nav class="flex-sm-00-auto ml-sm-3">
                                <ol class="breadcrumb breadcrumb-alt">
                                <?php foreach($heading['breadcrumbs'] AS $breadcrumb) : ?>
                                    <li class="breadcrumb-item">
                                        <?php 
                                        echo (isset($breadcrumb['is_active']) && $breadcrumb['is_active'] != TRUE) ?
                                        '<a class="link-fx" href="'.$breadcrumb['href'].'">'.ucwords($breadcrumb['title']).'</a>' : ucwords($breadcrumb['title']);
                                        ?>
                                    </li>
                                <?php endforeach;?>
                                </ol>
                            </nav>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->
                <?php endif;?>