<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування виду валюти';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування виду валюти</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-typeofcurrency-edit-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencyName">Назва валюти:</label>
                                        <input value="<?=$auto_complete["name"]?>" type="text" name="name" class="form-control" id="InputTypeofcurrencyName" required placeholder="Введіть нову назву валюти">
                                        <?php if (!empty($errors['name'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['name']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencyAbbreviation">Абревіатура валюти:</label>
                                        <input value="<?=$auto_complete["abbreviation"]?>" type="text" name="abbreviation" class="form-control" id="InputTypeofcurrencyAbbreviation" required placeholder="Введіть нову абревіатуру валюти">
                                        <?php if (!empty($errors['abbreviation'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['abbreviation']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencySign">Знак валюти:</label>
                                        <input value="<?=$auto_complete["sign"]?>" type="text" name="sign" class="form-control" id="InputTypeofcurrencySign" required placeholder="Введіть новий знак валюти">
                                        <?php if (!empty($errors['sign'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['sign']; ?></span>
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