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
<div class="wrapper-layout">
    <header class="pt-3 pb-3 header-layout">
        <nav class="navbar primary-color-bg navbar-expand-lg navbar-dark fixed-top pt-lg-0 pb-lg-0">
            <div class="container align-items-center">
                <a class="navbar-brand " href="/">
                    <i class="bi bi-car-front-fill" style="font-size: 35px"></i>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse align-items-center collapse" id="navbarCollapse" >
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Головна</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-start align-items-md-stretch navbar-buttons flex-column gap-2 flex-md-row">
                        <?php if(User::isUserAuthenticated()):?>
                            <a href="/carcomparison" class="btn btn-icon primary-color-bg-hover primary-color"><span>Порівняння</span><i class="fa-solid fa-scale-balanced"></i></a>
                            <a href="/favoritead" class="btn btn-icon primary-color-bg-hover primary-color"><span>Обране</span><i class="fa-solid fa-heart"></i></a>
                            <a href="/carad/add" class="btn btn-icon primary-color-bg-hover primary-color"><span>Додати оголошення</span><i class="bi bi-plus-circle-fill"></i></a>
                            <div class="dropdown text-end">
                                <a href="#" class="d-block link-triangle link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if(!User::hasCurrentUserImage()):?>
                                        <img src="/themes/images/default_avatar.svg" alt="Аватар користувача" width="34" height="34" class="rounded-circle">
                                    <?php else: ?>
                                        <img src="<?=User::getCurrentUserImagePath()?>" alt="Аватар користувача" width="34" height="34" class="rounded-circle">
                                    <?php endif;?>
                                </a>
                                <ul class="dropdown-menu text-small" >
                                    <li><a class="dropdown-item " href="/user/profile">Профіль</a></li>
                                    <li><a class="dropdown-item " href="/carad/myads">Мої оголошення</a></li>
                                    <li><a class="dropdown-item " href="#">Повідомлення адміну</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item dropdown-item-flex d-flex align-items-center" href="/user/logout"><span>Вийти</span><i style="font-size: 24px" class="bi bi-box-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="/user/register" class="btn btn-icon btn-light primary-color-bg-hover primary-color"><span>Реєстрація</span><i class="bi bi-person-plus-fill"></i></a>
                            <a href="/user/login" class="btn btn-icon btn-light primary-color-bg-hover primary-color"><span>Увійти</span><i class="bi bi-person-check-fill"></i></a>
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
            <span class="mb-3 mb-md-0 text-muted">© 2022 auto-sale by <a target="_blank" style="color: inherit" href="https://github.com/vladyslavgeyna">Vladyslav Geyna</a></span>
        </div>
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li >
                <a target="_blank" class="footer-logo footer-logo-telegram" href="https://t.me/what_is_lovechik">
                    <i class="bi bi-telegram"></i>
                </a>
            </li>
            <li >
                <a target="_blank" class="footer-logo footer-logo-instagram" href="https://www.instagram.com/_what_is_lovechik_/">
                    <i  class="bi bi-instagram"></i>
                </a>
            </li>
            <li >
                <a target="_blank" class="footer-logo footer-logo-facebook" href="https://www.facebook.com/profile.php?id=100072210826751">
                    <i class="bi bi-facebook"></i>
                </a>
            </li>
        </ul>
    </footer>
</div>
<script src="/themes/bootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/8a5dbfaed5.js" crossorigin="anonymous"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>