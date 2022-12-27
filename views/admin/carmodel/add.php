<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Додавання моделі';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Додавання моделі</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_car_model_added"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_model_added"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_model_added"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-carmodel-add-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group" >
                                        <label for="inputCarBrand">Марка авто:</label>
                                        <select class="form-control" name="car_brand" required id="inputCarBrand">
                                            <option value="-1" disabled selected >Оберіть марку</option>
                                            <?php foreach ($data["car_brands"] as $item) : ?>
                                                <?php if ($auto_complete["car_brand"] == $item["id"]) : ?>
                                                    <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php else : ?>
                                                    <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (!empty($errors['car_brand'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['car_brand']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputCarBrand">Назва моделі:</label>
                                        <input value="<?=$auto_complete["car_model_name"]?>" type="text" name="car_model_name" class="form-control" id="InputCarBrand" required placeholder="Введіть назву моделі">
                                        <?php if (!empty($errors['car_model_name'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['car_model_name']; ?></span>
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