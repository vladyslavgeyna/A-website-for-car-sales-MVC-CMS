<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Додавання виду палива';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Додавання виду палива</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_fuel_added"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_fuel_added"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_fuel_added"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-fuel-add-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="InputCarFuel">Назва виду палива:</label>
                                        <input value="<?=$auto_complete["fuel_name"]?>" type="text" name="fuel_name" class="form-control" id="InputCarFuel" required placeholder="Введіть назву виду палива">
                                        <?php if (!empty($errors['fuel_name'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['fuel_name']; ?></span>
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