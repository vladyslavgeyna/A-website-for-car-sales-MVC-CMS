<?php

use core\Core;
/** @var array $data */

Core::getInstance()->pageParams['title'] = 'Повідомлення адміну';

?>

<main class="main main-adminmessage-send">
    <div class="container container-adminmessage-send">
        <?php if (!empty($_SESSION["success_send_message"])): ?>
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 25px;" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-check"></i><span style="margin-left: 10px" ><?= $_SESSION["success_send_message"]; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success_send_message"]); ?>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-xmark"></i><span style="margin-left: 10px" ><?= $error; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center mb-4">Повідомлення адміну</h1>
        <form action="" class="d-flex flex-column" method="post" >
            <div class="mb-3">
                <label for="textAreaText" class="ps-2 mb-1">Введіть текст повідомлення:</label>
                <textarea style="resize: none" class="form-control" name="text" required id="textAreaText"><?= $data['text']; ?></textarea>
                <?php if (!empty($errors['text'])): ?>
                    <div class="error-form-validation" >
                        <span ><?= $errors['text']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="btn btn-submit primary-color-bg primary-color-hover" type="submit">Відправити</button>
        </form>
    </div>
</main>
