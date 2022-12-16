<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */
use models\User;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $siteName ?> — <?= $title ?></title>
    <link rel="stylesheet" href="/themes/bootstrap/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/light/css/style.css">
    <link rel="stylesheet" href="/themes/bootstrap/bootstrap-icons/bootstrap-icons.css">
</head>
<body>
<div class="wrapper ">
    <header class="pt-3 pb-3 ">
        <nav class="navbar primary-color-bg navbar-expand-md navbar-dark fixed-top pt-1 pb-1">
            <div class="container align-items-center">
                <a class="navbar-brand " href="/">
                    <i class="bi bi-car-front-fill" style="font-size: 35px"></i>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse align-items-center collapse" id="navbarCollapse" style="">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Головна</a>
                        </li>
                    </ul>
                    <div class="d-flex navbar-buttons">
                        <?php if(User::isUserAuthenticated()):?>
                            <a href="user/logout" class="btn btn-light primary-color-bg-hover primary-color">Вийти</a>
                        <?php else: ?>
                            <a href="/user/register" class="btn btn-light primary-color-bg-hover primary-color">Реєстрація</a>
                            <a href="/user/login" class="btn btn-light primary-color-bg-hover primary-color">Ввійти</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?= $content ?>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-5 border-top container">
        <div class="col-md-4 d-flex align-items-center footer-left-flex">
            <a href="/" class="mb-3 me-2 mb-md-0 text-decoration-none lh-1 primary-color-hover footer-logo">
                <i class="bi bi-car-front-fill" style="font-size: 33px"></i>
            </a>
            <span class="mb-3 mb-md-0 text-muted">© 2022 auto-sale by Vladyslav Geyna</span>
        </div>
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li >
                <a class="footer-logo footer-logo-telegram" href="#">
                    <i class="bi bi-telegram"></i>
                </a>
            </li>
            <li >
                <a class="footer-logo footer-logo-instagram" href="#">
                    <i  class="bi bi-instagram"></i>
                </a>
            </li>
            <li >
                <a class="footer-logo footer-logo-facebook" href="#">
                    <i class="bi bi-facebook"></i>
                </a>
            </li>
        </ul>
    </footer>
</div>
<script src="/themes/bootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>