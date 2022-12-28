<?php
/** @var array $errors */
/** @var array $data */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Додавання користувача';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Додавання користувача</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_user_added"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_user_added"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_user_added"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-user-register-admin section-form-admin">
            <div class="container-fluid">
                <div class="card card-primary">
                    <form action="" class="d-flex flex-column" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="floatingName">Ім'я</label>
                                <input required type="text" class="form-control" name="name" value="<?= $data['name'] ?>" id="floatingName" placeholder="Ім'я">
                            </div>
                            <div class="form-group">
                                <label for="floatingSurname">Прізвище</label>
                                <input required type="text" value="<?= $data['surname'] ?>" class="form-control" name="surname" id="floatingSurname" placeholder="Прізвище">
                            </div>
                            <div class="form-group">
                                <label for="floatingLastname">По-батькові</label>
                                <input required type="text" class="form-control" name="lastname" value="<?= $data['lastname'] ?>" id="floatingLastname" placeholder="По-батькові">
                            </div>
                            <div class="form-group">
                                <label for="floatingLogin">Логін (електронна пошта)</label>
                                <input required type="email" value="<?= $data['login'] ?>"  name="login" class="form-control" id="floatingLogin" placeholder="Логін (email)">
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
                            <div class="form-group">
                                <label for="floatingPassword">Пароль</label>
                                <input required type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                <?php if (!empty($errors['password'])): ?>
                                    <div class="error-form-validation">
                                        <span ><?= $errors['password']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="floatingPassword2">Пароль (ще раз)</label>
                                <input required type="password" class="form-control" name="password2" id="floatingPassword2" placeholder="Password">
                                <?php if (!empty($errors['password2'])): ?>
                                    <div class="error-form-validation">
                                        <span ><?= $errors['password2']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="floatingPhone">Телефон</label>
                                <input required type="text" class="form-control" value="<?= $data['phone'] ?>" name="phone"  id="floatingPhone" placeholder="Телефон">
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
                            <div class="form-group">
                                <label for="inputAvatar">Аватар (необов'язково)</label>
                                <input style="cursor: pointer"  type="file" name="avatar" class="form-control d-flex align-items-center h-100" id="inputAvatar" accept="image/jpeg, image/png">
                            </div>
                            <div class="form-group">
                                <label >Чи зробити адміном?</label>
                                <div class="custom-control custom-radio ml-2">
                                    <?php if ($data["is_admin"] == 0 || empty($data["is_admin"])): ?>
                                        <input class="custom-control-input" type="radio" id="radio_no" name="is_admin" checked value="0">
                                    <?php else: ?>
                                        <input class="custom-control-input" type="radio" id="radio_no" name="is_admin"  value="0">
                                    <?php endif;?>
                                    <label for="radio_no" class="custom-control-label">Ні</label>
                                </div>
                                <div class="custom-control custom-radio ml-2">
                                    <?php if ($data["is_admin"] == 1): ?>
                                        <input class="custom-control-input" type="radio" id="radio_yes" checked name="is_admin" value="1">
                                    <?php else: ?>
                                        <input class="custom-control-input" type="radio" id="radio_yes" name="is_admin" value="1">
                                    <?php endif;?>
                                    <label for="radio_yes" class="custom-control-label">Так</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn primary-color-bg primary-color-hover" type="submit">Додати користувача</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>