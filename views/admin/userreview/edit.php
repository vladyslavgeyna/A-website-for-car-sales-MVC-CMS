<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування відгуку';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування відгуку</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-review-edit-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputTitle">Заголовок оголошення:</label>
                                        <input value="<?=$data["title"]?>" type="text" name="title" class="form-control" id="InputTitle" required placeholder="Введіть новий заголовок відгуку">
                                        <?php if (!empty($errors['title'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['title']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputText">Текст оголошення:</label>
                                        <textarea style="resize: none; height: 100px" class="form-control" name="text" id="InputText" placeholder="Введіть новий текст відгуку"><?=$data["text"]?></textarea>
                                        <?php if (!empty($errors['text'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['text']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Змінити</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>