<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Додавання виду валюти';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Додавання виду валюти</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_type_of_currency_added"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_type_of_currency_added"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_type_of_currency_added"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-typeofcurrency-add-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencyName">Назва валюти:</label>
                                        <input value="<?=$auto_complete["type_of_currency_name"]?>" type="text" name="type_of_currency_name" class="form-control" id="InputTypeofcurrencyName" required placeholder="Введіть назву валюти">
                                        <?php if (!empty($errors['type_of_currency_name'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['type_of_currency_name']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencyAbbreviation">Абревіатура валюти:</label>
                                        <input value="<?=$auto_complete["type_of_currency_abbreviation"]?>" type="text" name="type_of_currency_abbreviation" class="form-control" id="InputTypeofcurrencyAbbreviation" required placeholder="Введіть абревіатуру валюти">
                                        <?php if (!empty($errors['type_of_currency_abbreviation'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['type_of_currency_abbreviation']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputTypeofcurrencySign">Знак валюти:</label>
                                        <input value="<?=$auto_complete["type_of_currency_sign"]?>" type="text" name="type_of_currency_sign" class="form-control" id="InputTypeofcurrencySign" required placeholder="Введіть знак валюти">
                                        <?php if (!empty($errors['type_of_currency_sign'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['type_of_currency_sign']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Додати</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>