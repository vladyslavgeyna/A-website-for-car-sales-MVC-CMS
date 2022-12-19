<?php


use core\Core;

Core::getInstance()->pageParams['title'] = 'Авторизація';

?>

<main class="main main-login">
    <div class="container container-login">
        <?php if (!empty($_SESSION["success_register"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-check"></i><span style="margin-left: 10px" ><?= $_SESSION["success_register"]; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION["success_register"]); ?>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-xmark"></i><span style="margin-left: 10px" ><?= $error; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center mb-4">Авторизація</h1>
        <form action="" class="d-flex flex-column" method="post" >
            <div class="form-floating">
                <input required type="email" name="login" class="form-control" id="floatingLogin" placeholder="Логін (email)">
                <label for="floatingLogin">Логін</label>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
            </div>
            <button class="btn btn-submit primary-color-bg primary-color-hover" type="submit">Увійти</button>
        </form>
    </div>
</main>
