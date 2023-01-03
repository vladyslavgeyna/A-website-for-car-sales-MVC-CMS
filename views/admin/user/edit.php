<?php
/** @var array $errors */
/** @var array $data */
/** @var string $image_path */
/** @var string $user_id */
use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування профілю';

$add_path = empty($user_id) ? "" : "/".$user_id;

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування профілю</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-user-edit-admin section-form-admin pb-5">
            <div class="container-fluid">
                <form action="" class="d-flex flex-column form-main" method="post" enctype="multipart/form-data">
                    <div class="form-group row justify-content-center align-items-center flex-column">
                        <div class="image-wrapper col-5 col-lg-4 p-0 mb-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Обрати зображення">
                            <?php if (!empty($image_path)) :?>
                                <img src="<?=$image_path?>" alt="Аватар користувача" >
                            <?php else: ?>
                                <img src="/themes/images/default_avatar.svg" alt="Аватар користувача" class="img-circle">
                            <?php endif; ?>
                            <div class="choose-image-wrapper">
                                <img src="/themes/images/camera.svg" class="choose-image" alt="Обрати фото">
                            </div>
                            <input accept="image/jpeg, image/png" type="file" id="inputFile" name="avatar">
                        </div>
                        <?php if (!empty($errors['avatar'])): ?>
                            <div class="error-form-validation text-center mt-3">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть файл із одним із вказаних розширень. Приклад: image.png або image.jpeg"><?= $errors['avatar']; ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="text-center file-name" style="font-weight: bold"></div>
                        <?php if (!empty($image_path)): ?>
                            <div class="d-flex justify-content-center mt-3">
                                <a href="/user/deleteimage<?=$add_path?>" class="btn btn-danger">Видалити зображення</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group m-0">
                        <label for="floatingName" class="pl-2">Ім'я</label>
                        <input required type="text" class="form-control" name="name" value="<?= $data['name'] ?>" id="floatingName" placeholder="Ім'я">
                        <?php if (!empty($errors['name'])): ?>
                            <div class="error-form-validation">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке ім'я"><?= $errors['name']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group m-0">
                        <label for="floatingSurname" class="pl-2">Прізвище</label>
                        <input required type="text" value="<?= $data['surname'] ?>" class="form-control" name="surname" id="floatingSurname" placeholder="Прізвище">
                        <?php if (!empty($errors['surname'])): ?>
                            <div class="error-form-validation">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке прізвище"><?= $errors['surname']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group m-0">
                        <label for="floatingLastname" class="pl-2">По-батькові</label>
                        <input required type="text" class="form-control" name="lastname" value="<?= $data['lastname'] ?>" id="floatingLastname" placeholder="По-батькові">
                        <?php if (!empty($errors['lastname'])): ?>
                            <div class="error-form-validation" >
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Занадто коротке по-батькові"><?= $errors['lastname']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group m-0">
                        <label for="floatingLogin"  class="pl-2">Логін (електронна пошта)</label>
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
                    <div class="form-group m-0">
                        <label for="floatingPhone" class="pl-2">Телефон</label>
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
                    <?php if (!empty($errors['general'])): ?>
                        <div class="error-form-validation" style="margin-top: -10px;">
                            <span ><?= $errors['general']; ?></span>
                        </div>
                    <?php endif; ?>
                    <button class="btn primary-color-bg primary-color-hover save" type="submit">Зберегти зміни</button>
                    <hr class="p-0 m-0 mx-4">
                    <a class="btn btn-warning" href="/user/changepassword<?=$add_path?>">Змінити пароль</a>
                </form>
                <div style="max-width: 500px; margin: 0 auto" class="mt-4 mb-5 pt-3 pb-3">
                    <hr >
                </div>
                <div class="danger-zone">
                    <div class="danger-zone-title h2 ">
                        Небезпечна зона
                    </div>
                    <div class="danger-zone-body mt-4 text-center">
                        <button data-toggle="modal" data-target="#confirm-delete-profile-confirm" class="btn btn-danger mt-3">Видалити профіль</button>
                    </div>
                    <?php if (!empty($_SESSION['delete_profile_error'])): ?>
                        <div class="error-form-validation mt-3 text-center p-0" style="margin-top: -10px; cursor:unset;">
                            <span ><?= $_SESSION['delete_profile_error']; ?></span>
                        </div>
                        <?php unset($_SESSION['delete_profile_error']) ?>
                    <?php endif; ?>
                </div>
                <div class="modal modal-confirm-delete-profile-confirm fade" id="confirm-delete-profile-confirm" tabindex="-1" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div style="border-radius: 25px;" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Підтверження</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Ви дійсно бажаєте видалити профіль?<br>Ця дія є безповоротною!<br><br>Увага! В разі видалення профілю будуть видалені всі оголошення та інші дані, пов'язані з ним!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                <a href="/user/delete<?=$add_path?>" class="btn btn-danger btn-yes">Видалити профіль</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section >
    </div>
</main>
<script defer>
    const inputPhone = document.getElementById("floatingPhone");
    const blockFileName = document.querySelector(".file-name");
    inputPhone.addEventListener("input", () => {
        inputPhone.value = inputPhone.value.replace(/[^\d]/g, '');
    });
    const inputFile = document.getElementById("inputFile");
    inputFile.addEventListener("change", () => {
        if (inputFile.files.length == 0) {
            blockFileName.innerHTML = "";
            blockFileName.classList.add("hidden");
        } else {
            blockFileName.innerHTML = inputFile.files[0].name;
            blockFileName.classList.remove("hidden");
        }
    });
</script>