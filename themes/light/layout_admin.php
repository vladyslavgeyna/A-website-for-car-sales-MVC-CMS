<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */

use models\Image;
use models\User;
if (User::isUserAuthenticated())
{
    $currentUser = User::getCurrentAuthenticatedUser();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $siteName ?> — <?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/themes/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/themes/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/themes/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/themes/admin/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/themes/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/themes/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/themes/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/themes/admin/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/themes/light/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper wrapper-admin-layout">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/themes/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light pt-1 pb-1">
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Головна</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"  href="/user/logout" >
                    Вийти
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <img src="/themes/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Адмін панель</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php if(!User::hasUserImage()):?>
                        <img src="/themes/images/default_avatar.svg" class="img-circle elevation-2" alt="Аватар користувача">
                    <?php else: ?>
                        <img src="/files/user/<?=Image::getImageById($currentUser['image_id'])['name']?>" class="img-circle elevation-2" alt="Аватар користувача">
                    <?php endif;?>
                </div>
                <div class="info">
                    <a href="/" class="d-block"><?=$currentUser["name"]." ".$currentUser["surname"]?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Головна
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <?= $content ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="/themes/admin/plugins/jquery/jquery.min.js"></script>
<script src="/themes/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/themes/admin/plugins/chart.js/Chart.min.js"></script>
<script src="/themes/admin/plugins/sparklines/sparkline.js"></script>
<script src="/themes/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/themes/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="/themes/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="/themes/admin/plugins/moment/moment.min.js"></script>
<script src="/themes/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/themes/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/themes/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/themes/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="/themes/admin/dist/js/adminlte.js"></script>
<script src="https://kit.fontawesome.com/8a5dbfaed5.js" crossorigin="anonymous"></script>
<!--<script src="/themes/admin/dist/js/demo.js"></script>-->
<script src="/themes/admin/dist/js/pages/dashboard.js"></script>
</body>
</html>
