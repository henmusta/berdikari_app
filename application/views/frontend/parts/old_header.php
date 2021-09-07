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

    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_frontend/css/frontend/vendor.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_frontend/css/frontend/main.css">

    <?php echo isset($metadata['google_analitycs']) ? $metadata['google_analitycs'] : null; ?>
</head>
<body>
    <main>
    <header>
         <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <ul class="left">
                            <li><a href="<?php echo $metadata['facebook_url'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $metadata['instagram_url'] ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?php echo $metadata['twitter_url'] ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCP1Kev8dPb-rQDxSJhG_zgA"><i class="fab fa-youtube"></i></a></li>
                            <!-- <li><a href="<?php echo $metadata['youtube_url'] ?>" target="_blank"><i class="fab fa-youtube"></i></a></li> -->
                        </ul>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center">
                        <ul class="right">
                            <li><?php echo date_indonesia(date('y-m-d'),'l, d F Y')?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="logoandbanner-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 logo d-none d-lg-flex align-items-center">
                        <a href=""><img src="uploads/logo.png" alt="" class="img-fluid"></a>
                    </div>
                    <div class="col-lg-8 banner d-flex justify-content-center align-items-center">
                        <div class="banner" style="width:100%;">
                            <?php echo isset($this->ads['header']) ? $this->ads['header'] : NULL;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-header">
            <div class="container">
                <div class="d-block d-lg-none cage-nav">
                    <div class="navTrigger">
                        <i></i><i></i><i></i>
                    </div>
                </div>
                <a href="" class="d-block d-lg-none logo-mobile"></a>
                <?php echo isset($main_menu) ? $main_menu : NULL;?>
                <div class="search-button">
                    <button id="btn-search"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="search-form">
                <div class="container">
                    <form action="search">
                        <input type="text" placeholder="Cari Berita" name="q"><button type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        
    </header>