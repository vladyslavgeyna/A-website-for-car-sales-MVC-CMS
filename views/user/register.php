<?php

use core\Core;

Core::getInstance()->pageParams['title'] = 'Реєстрація';

?>

<main class="main main-register">
    <div class="container container-register">
        <h1 class="fw-bold text-center mb-4">Реєстрація</h1>
        <form action="" class="d-flex flex-column" method="post">
            <div class="form-floating">
                <input required type="text" class="form-control" name="name"  id="floatingName" placeholder="Ім'я">
                <label for="floatingName">Ім'я</label>
                <?php if (!empty($errors['name'])): ?>
                    <div class="error-form-validation"><?= $errors['name']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" class="form-control" name="surname" id="floatingSurname" placeholder="Прізвище">
                <label for="floatingSurname">Прізвище</label>
                <?php if (!empty($errors['surname'])): ?>
                    <div class="error-form-validation"><?= $errors['surname']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" class="form-control" name="lastname" id="floatingLastname" placeholder="По-батькові">
                <label for="floatingLastname">По-батькові</label>
                <?php if (!empty($errors['lastname'])): ?>
                    <div class="error-form-validation"><?= $errors['lastname']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="email" name="login" class="form-control" id="floatingLogin" placeholder="Логін (email)">
                <label for="floatingLogin">Логін (email)</label>
                <?php if (!empty($errors['login'])): ?>
                    <div class="error-form-validation"><?= $errors['login']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
                <?php if (!empty($errors['password'])): ?>
                    <div class="error-form-validation"><?= $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password2" id="floatingPassword2" placeholder="Password">
                <label for="floatingPassword2">Пароль (ще раз)</label>
                <?php if (!empty($errors['password2'])): ?>
                    <div class="error-form-validation"><?= $errors['password2']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" class="form-control" name="password2"  id="floatingPhone" placeholder="Телефон">
                <label for="floatingPhone">Телефон</label>
                <?php if (!empty($errors['phone'])): ?>
                    <div class="error-form-validation"><?= $errors['phone']; ?></div>
                <?php endif; ?>
            </div>
            <div class="input-group input-file">
                <label for="inputAvatar">Аватар (необов'язково)</label>
                <div>
                    <input accept="image/jpeg, image/png" type="file" name="avatar" class="form-control" id="inputAvatar">
                </div>
            </div>
            <button class="btn primary-color-bg primary-color-hover" type="submit">Зареєструватися</button>
        </form>
    </div>
</main>

