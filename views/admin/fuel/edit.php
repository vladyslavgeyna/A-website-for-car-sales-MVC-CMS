<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування виду палива';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування виду палива</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-fuel-edit-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputCarBrand">Назва виду палива:</label>
                                        <input value="<?=$auto_complete["name"]?>" type="text" name="name" class="form-control" id="InputCarBrand" required placeholder="Введіть нову назву виду палива">
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