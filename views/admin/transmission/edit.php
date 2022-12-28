<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування коробки передач';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування коробки передач</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-transmission-edit-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputTransmission">Назва коробки передач:</label>
                                        <input value="<?=$auto_complete["name"]?>" type="text" name="name" class="form-control" id="InputTransmission" required placeholder="Введіть нову назву коробки передач">
                                        <?php if (!empty($errors['name'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['name']; ?></span>
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