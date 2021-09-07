<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kupas Tuntas<?=isset($title) ? ' - '. $title : ''?></title>
    <base href="<?php echo base_url();?>">

    <!-- generics -->
    <link rel="icon" href="uploads/favicon/favicon-32.png" sizes="32x32">
    <link rel="icon" href="uploads/favicon/favicon-57.png" sizes="57x57">
    <link rel="icon" href="uploads/favicon/favicon-76.png" sizes="76x76">
    <link rel="icon" href="uploads/favicon/favicon-96.png" sizes="96x96">
    <link rel="icon" href="uploads/favicon/favicon-128.png" sizes="128x128">
    <link rel="icon" href="uploads/favicon/favicon-192.png" sizes="192x192">
    <link rel="icon" href="uploads/favicon/favicon-228.png" sizes="228x228">

    <!-- Android -->
    <link rel="shortcut icon" sizes="196x196" href="uploads/favicon/favicon-196.png">

    <!-- iOS -->
    <link rel="apple-touch-icon" href="uploads/favicon/favicon-120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="path/to/favicon-152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="path/to/favicon-180.png" sizes="180x180">

    <!-- Windows 8 IE 10-->
    <meta name="msapplication-TileColor" content="#0161b7">
    <meta name="msapplication-TileImage" content="uploads/favicon/favicon-144.png">

    <!-- Windows 8.1 + IE11 and above -->
    <meta name="msapplication-config" content="uploads/favicon/browserconfig.xml" />
    
    <meta name="title"          content="<?php echo isset($metadata['title']) ? $metadata['title'] : null; ?>"/>
    <meta name="description"      content="<?php echo isset($metadata['description']) ? $metadata['description'] : null; ?>"/>
    <meta name="keyword"        content="<?php echo isset($metadata['keyword']) ? $metadata['keyword'] : null; ?>"/>
    
    <meta name="robots" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    
    <meta property="og:type" content="<?php echo isset($metadata['og_type']) ? $metadata['og_type'] : null ?>" />
    <meta property="og:title" content="<?php echo isset($metadata['title']) ? $metadata['title'] : null; ?>">
    <meta property="og:description" content="<?php echo isset($metadata['description']) ? $metadata['description'] : null; ?>">
    <meta property="og:image" itemprop="image" content="<?php echo isset($metadata['image']) ? $metadata['image'] : null; ?>">
    <meta property="og:image:secure_url" itemprop="image" content="<?php echo isset($metadata['image']) ? $metadata['image'] : null; ?>">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:site_name" content="<?php echo isset($metadata['title']) ? $metadata['title'] : null; ?>">
    
    <meta name="twitter:title" content="<?php echo isset($metadata['title']) ? $metadata['title'] : null; ?>">
    <meta name="twitter:description" content="<?php echo isset($metadata['description']) ? $metadata['description'] : null; ?>">
    <meta name="twitter:image" content="<?php echo isset($metadata['image']) ? $metadata['image'] : null; ?>">
    <meta name="twitter:image:alt" content="<?php echo isset($metadata['image']) ? $metadata['image'] : null; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <base href="<?php echo base_url('/');?>">
    <title>Kupas Tuntas</title>

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?= base_url()?>assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/frontend/css/style.css">
    <!-- Custom Font -->
    <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">

    <?php echo isset($metadata['google_analitycs']) ? $metadata['google_analitycs'] : null; ?>
</head>
<body>
    <main>
        <header>
            <div class="nav__top bg_dark_c">
                <div class="container">
                    <div class="row py-1">
                        <div class="col-6">
                            <a href="#" class="text-decoration-none text-white text_12 mr-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-decoration-none text-white text_12 mr-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-decoration-none text-white text_12"><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="col-6 text-right">
                            <h5 class="text_12 font-weight-normal text-white m-0 py-1">Rabu, 12 April 2021</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adv container">
                <div class="row py-3">
                    <div class="col-4 d-none d-md-block">
                        <div class="d-flex align-items-center h-100">
                            <a href="index.html" class="align-self-center"><img src="<?= base_url()?>assets/frontend/images/logo/Logo-Header.png" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-12 text-right">
                        <img src="<?= base_url()?>assets/frontend/images/adv/iklan-6.jpg" width="100%" alt="Iklan">
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg_primary_c">
                <div class="container">
                    <button class="navbar-toggler" type="button">
                        <i class="fas fa-bars text-white"></i>
                    </button>
                    <div class="ml-auto d-block d-lg-none search-box">
                        <form action="" class="p-0 m-0">
                            <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" placeholder="Type to Search...">
                        </form>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <div class="ic d-none" id="close">
                                <i class="fas fa-times"></i>
                            </div>
                            <a class="nav-link active  my-1" href="index.html">HOME</a>
                            <a class="nav-link  my-1" href="about.html">TENTANG KAMI</a>
                            <a class="nav-link  my-1" href="indeks.html">INDEKS</a>
                            <a class="nav-link  my-1" href="nasional.html">NASIONAL</a>
                            <a class="nav-link  my-1" href="nasional.html">POLITIK</a>
                            <a class="nav-link  my-1" href="nasional.html">OLAHRAGA</a>
                            <a class="nav-link  my-1" href="paper.html">E-PAPER</a>
                            <a class="nav-link  my-1" href="kupas_tv.html">KUPAS-TV</a>
                        </div>
                    </div>
                    <div class="ml-auto d-none d-lg-block search-box">
                        <form action="" class="m-0 p-0">
                            <button type="button" class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" placeholder="Type to Search...">
                        </form>
                    </div>
                </div>
            </nav>
        </header>