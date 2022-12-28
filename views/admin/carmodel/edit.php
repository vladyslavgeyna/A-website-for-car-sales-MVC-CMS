<?php
/** @var array $data */
/** @var array $errors */
/** @var array $auto_complete */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Редагування моделі';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Редагування моделі</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-carmodel-edit-admin section-form-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group" >
                                        <label for="inputCarBrand">Марка авто:</label>
                                        <select class="form-control" name="car_brand_id" required id="inputCarBrand">
                                            <option value="-1" disabled selected >Оберіть нову марку</option>
                                            <?php foreach ($data["car_brands"] as $item) : ?>
                                                <?php if ($auto_complete["car_brand_id"] == $item["id"]) : ?>
                                                    <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php else : ?>
                                                    <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (!empty($errors['car_brand_id'])): ?>
                                            <div class="error-form-validation mt-2" >
                                                <span><?= $errors['car_brand_id']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputCarModel">Назва моделі:</label>
                                        <input value="<?=$auto_complete["name"]?>" type="text" name="name" class="form-control" id="InputCarModel" required placeholder="Введіть нову назву моделі">
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