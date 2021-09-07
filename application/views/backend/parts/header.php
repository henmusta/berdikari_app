<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <base href="<?php echo base_url('backend');?>/">
        <title><?php echo isset($heading['subtitle']) && !empty($heading['subtitle'] ) ? str_replace("_", "", $heading['subtitle']) : NULL ?></title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

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

        <!-- Stylesheets -->
        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        
        <?php 
        if(isset($stylesheets)): 
            foreach($stylesheets AS $href) :
            ?><link rel="stylesheet" href="<?php echo $href;?>"/>
            <?php endforeach; unset($stylesheets,$href);
        endif;
        ?>
        <link rel="stylesheet" id="css-main" href="../assets/backend/css/oneui.min.css">
        <link rel="stylesheet" href="../assets/backend/css/style.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="../assets/backend/css/themes/amethyst.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-dark'                              Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Light themed Header
            'page-header-dark'                          Dark themed Header

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
            <?php include('sidebar.php');?>
            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Toggle Mini Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        <!-- END Toggle Mini Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <?php 
                    $session_photo = $this->session->user->photo;
                    $photo = isset($session_photo) && is_file(UPLOADS_FOLDER . 'administrators' . DS . $session_photo) ? 
                    '../uploads/administrators/'. $session_photo :
                    '../assets/backend/media/avatars/avatar.jpg';
                    ?>
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded" src="<?php echo $photo ?>" alt="Header Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $this->session->user->fullname;?></span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" style="background: white;" src="<?php echo $photo?>" alt="">
                                </div>
                                <div class="p-2">
                                    <h5 class="dropdown-header text-uppercase">User Options</h5>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="administrators/edit/<?php echo $this->session->user->administrator_id;?>">
                                        <span>Account</span>
                                        <span>
                                            <i class="si si-user ml-1"></i>
                                        </span>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <h5 class="dropdown-header text-uppercase">Actions</h5>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="auth/sign-out">
                                        <span>Log Out</span>
                                        <i class="si si-logout ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-white">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
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