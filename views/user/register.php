<?php
/** @var array $errors */
/** @var array $data */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Реєстрація';

?>

<main class="main main-register">
    <div class="container container-register">
        <h1  class="text-center mb-4">Реєстрація</h1>
        <form action="" class="d-flex flex-column" method="post" enctype="multipart/form-data">
            <div class="form-floating">
                <input required type="text" class="form-control" name="name" value="<?= $data['name'] ?>" id="floatingName" placeholder="Ім'я">
                <label for="floatingName">Ім'я</label>
                <?php if (!empty($errors['name'])): ?>
                <div class="error-form-validation">
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке ім'я"><?= $errors['name']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" value="<?= $data['surname'] ?>" class="form-control" name="surname" id="floatingSurname" placeholder="Прізвище">
                <label for="floatingSurname">Прізвище</label>
                <?php if (!empty($errors['surname'])): ?>
                <div class="error-form-validation">
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке прізвище"><?= $errors['surname']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" class="form-control" name="lastname" value="<?= $data['lastname'] ?>" id="floatingLastname" placeholder="По-батькові">
                <label for="floatingLastname">По-батькові</label>
                <?php if (!empty($errors['lastname'])): ?>
                <div class="error-form-validation" >
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке по-батькові"><?= $errors['lastname']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="email" value="<?= $data['login'] ?>"  name="login" class="form-control" id="floatingLogin" placeholder="Логін (email)">
                <label for="floatingLogin">Логін (електронна пошта)</label>
                <?php if (!empty($errors['login_exist'])): ?>
                <div class="error-form-validation" >
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть інший логін"><?= $errors['login_exist']; ?></span>
                </div>
                <?php elseif (!empty($errors['login_error'])): ?>
                <div class="error-form-validation" >
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Email має бути в форматі: example@gmail.com"><?= $errors['login_error']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
                <?php if (!empty($errors['password'])): ?>
                <div class="error-form-validation">
                    <span ><?= $errors['password']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="password" class="form-control" name="password2" id="floatingPassword2" placeholder="Password">
                <label for="floatingPassword2">Пароль (ще раз)</label>
                <?php if (!empty($errors['password2'])): ?>
                <div class="error-form-validation">
                    <span ><?= $errors['password2']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-floating">
                <input required type="text" class="form-control" value="<?= $data['phone'] ?>" name="phone"  id="floatingPhone" placeholder="Телефон">
                <label for="floatingPhone">Телефон</label>
                <?php if (!empty($errors['phone_error'])): ?>
                <div class="error-form-validation">
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Телефон має бути в форматі: 0931231231"><?= $errors['phone_error']; ?></span>
                </div>
                <?php elseif (!empty($errors['phone_exist'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть інший номер телефону"><?= $errors['phone_exist']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="input-group input-file">
                <label for="inputAvatar">Аватар (необов'язково)</label>
                <div>
                    <input accept="image/jpeg, image/png" type="file" name="avatar" class="form-control" id="inputAvatar">
                </div>
                <?php if (!empty($errors['avatar'])): ?>
                <div class="error-form-validation">
                    <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть файл із одним із вказаних розширень. Приклад: image.png або image.jpeg"><?= $errors['avatar']; ?></span>
                </div>
                <?php endif; ?>
            </div>
            <button class="btn primary-color-bg primary-color-hover" type="submit">Зареєструватися</button>
        </form>
    </div>
</main>

