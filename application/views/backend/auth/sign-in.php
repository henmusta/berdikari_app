<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <base href="<?php echo base_url('backend');?>/">
        <title>Kupas Tuntas</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="../assets/backend/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../assets/backend/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/backend/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="../assets/backend/css/oneui.min.css">

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
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="hero-static d-flex align-items-center">
                    <div class="w-100">
                        <!-- Sign In Section -->
                        <div class="content content-full bg-white">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                                    <!-- Header -->
                                    <div class="text-center">
                                        <p class="mb-1">
                                            <img class="img-fluid" src="../uploads/kupastuntas/logoberdikari.png" alt="">
                                        </p>
                                        <h1 class="h4 mb-1">PORTAL ADMINISTRATIONS</h1>
                                        <h2 class="h6 font-w400 text-muted mb-3">Please Sign In</h2>
                                    </div>
                                    <!-- END Header -->

                                    <!-- Sign In Form -->
                                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form id="<?php echo $form['id'];?>" action="<?php echo $form['action'];?>" method="POST">
                                        <div class="py-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-lg form-control-alt" 
                                                    name="data[username]" placeholder="Username" 
                                                    required="required"
                                                    maxlength="20"
                                                    minlength="4">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-lg form-control-alt" 
                                                    name="data[password]" placeholder="Passsword"
                                                    required="required"
                                                    maxlength="20"
                                                    minlength="4">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-center mb-0">
                                            <div class="col-md-6 col-xl-5">
                                                <button type="submit" class="btn btn-block btn-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Section -->

                        <!-- Footer -->
                        <div class="font-size-sm text-center text-muted py-3">
                            <strong>Kupastuntas.co</strong> &copy; <span data-toggle="year-copy"></span>
                        </div>
                        <!-- END Footer -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <script src="../assets/backend/js/oneui.core.min.js"></script>
        <script src="../assets/backend/js/oneui.app.min.js"></script>
        <!-- Page JS Plugins -->
        <script src="../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
        <script src="../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js"></script>        
        <script>
        $(function(){
            'use strict'
            $(document).ready(function(){

                $('form#<?php echo $form['id'];?>').validate({
                    validClass      : 'is-valid',
                    errorClass      : 'is-invalid',
                    errorElement    : 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    submitHandler   : function(form,eve) {
                        eve.preventDefault();
                        var btnSubmit       = $(form).find("[type='submit']"),
                            btnSubmitHtml   = btnSubmit.html();

                        $.ajax({
                            cache       : false,
                            processData : false,
                            contentType : false,
                            type        : 'POST',
                            url         : $(form).attr('action'),
                            data        : new FormData(form),
                            dataType    : 'JSON',
                            beforeSend:function() { 
                                btnSubmit.addClass("disabled").html("<i class='fas fa-spinner fa-pulse fa-fw'></i> Loading ... ");
                            },
                            error       : function(){
                                btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                                One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: 'Server\'s response not found'});
                            },
                            success     : function(response) {
                                btnSubmit.removeClass("disabled").html(btnSubmitHtml);
                                if ( response.status == "success" ){
                                    One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: response.message});
                                    setTimeout(function(){
                                        location.href = response.redirect;
                                    },1000);
                                } else {
                                    One.helpers('notify', {type: 'danger', icon: 'fa fa-exclamation mr-1', message: response.message});
                                }
                            }
                        });
                    }
                });
                $('input[name="data[username]"]').rules("add",{
                    remote: { 
                        url     : "<?php echo $form['validation']['find_user_url']?>", 
                        type    : "POST"
                    },
                    messages : { 
                        remote: "User not found",
                    }
                });

            });
        });
        </script>
    </body>
</html>
