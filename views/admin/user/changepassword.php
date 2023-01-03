<?php

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Зміна паролю';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Зміна паролю</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-user-changepassword-admin section-form-admin">
            <div class="container-fluid">
                <form action="" class="d-flex flex-column" method="post" >
                    <div class="form-group">
                        <label for="floatingPassword2">Новий пароль</label>
                        <input required type="password" class="form-control" name="password1" id="floatingPassword2" >
                        <?php if (!empty($errors['password1'])): ?>
                            <div class="error-form-validation">
                                <span ><?= $errors['password1']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="floatingPassword3">Новий пароль (ще раз)</label>
                        <input required type="password" class="form-control" name="password2" id="floatingPassword3">
                        <?php if (!empty($errors['password2'])): ?>
                            <div class="error-form-validation">
                                <span ><?= $errors['password2']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-submit primary-color-bg primary-color-hover" type="submit" >Змінити пароль</button>
                </form>
            </div>
        </section>
    </div>
</main>
