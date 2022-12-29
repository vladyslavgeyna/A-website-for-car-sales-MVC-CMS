<?php

use core\Core;

Core::getInstance()->pageParams['title'] = 'Зміна паролю';

?>
<main class="main main-change-password">
    <div class="container container-change-password">
        <h1 class="text-center mb-4">Зміна паролю</h1>
        <form action="" class="d-flex flex-column" method="post" >
            <div class="form-floating">
                <input required type="password" class="form-control" name="old_password" id="floatingPassword1" placeholder="Password">
                <label for="floatingPassword1">Старий пароль</label>
                <?php if (!empty($errors['old_password'])): ?>
                    <div class="error-form-validation">
                        <span ><?= $errors['old_password']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password1" id="floatingPassword2" placeholder="Password">
                <label for="floatingPassword2">Новий пароль</label>
                <?php if (!empty($errors['password1'])): ?>
                    <div class="error-form-validation">
                        <span ><?= $errors['password1']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password2" id="floatingPassword3" placeholder="Password">
                <label for="floatingPassword3">Новий пароль (ще раз)</label>
                <?php if (!empty($errors['password2'])): ?>
                    <div class="error-form-validation">
                        <span ><?= $errors['password2']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="btn btn-submit primary-color-bg primary-color-hover" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Увага! Після зміни паролю буде зроблений вихід з Вашого облікового запису">Змінити пароль</button>
        </form>
    </div>
</main>
