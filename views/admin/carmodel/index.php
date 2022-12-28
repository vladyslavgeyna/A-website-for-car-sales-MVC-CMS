<?php
/** @var array $data */

use core\Core;
use models\Carbrand;

Core::getInstance()->pageParams['title'] = 'Адмін | Всі моделі';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Всі моделі</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_car_model_deleted"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_model_deleted"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_model_deleted"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_car_model_edited"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_model_edited"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_model_edited"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["error_car_model_deleted"])): ?>
                    <div class="alert alert-admin alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-solid fa-xmark"></i><?= $_SESSION["error_car_model_deleted"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["error_car_model_deleted"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-carmodel-index-admin section-table-admin">
            <div class="container-fluid">
                <?php if(!empty($data["car_models"])): ?>
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 7%">ID</th>
                                    <th style="width: 10%">Назва</th>
                                    <th style="width: 2%">ID марки</th>
                                    <th style="width: 30%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data["car_models"] as $car_model) : ?>
                                    <tr>
                                        <td><?=$car_model["id"]?></td>
                                        <td><?=$car_model["name"]?></td>
<!--                                        <td style="cursor: help" data-toggle="tooltip" data-placement="right" title="--><?//=Carbrand::getCarBrandNameById($car_model["car_brand_id"])?><!--">--><?//=$car_model["car_brand_id"]?><!--</td>-->
                                        <td style="cursor: help;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=Carbrand::getCarBrandNameById($car_model["car_brand_id"])?>" ><?=$car_model["car_brand_id"]?></td>
                                        <td class="project-actions text-right d-flex flex-column flex-sm-row justify-content-end" style="gap: 0.5rem">
                                            <a class="btn btn-info " href="/carmodel/edit/<?=$car_model["id"]?>">
                                                <i class="fas fa-pencil-alt pr-1"></i>
                                                Редагувати
                                            </a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-car-model-<?=$car_model["id"]?>" type="button" >
                                                <i class="fas fa-trash pr-1"></i>
                                                Видалити
                                            </button>
                                        </td>
                                        <div class="modal modal-confirm-delete-car-model fade" id="confirm-delete-car-model-<?=$car_model["id"]?>" tabindex="-1" aria-hidden="false">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div style="border-radius: 25px;" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p >Ви дійсно бажаєте видалити цю модель?<br>Ця дія є безповоротною!<br><br>Увага! Видалення не відбудеться, якщо існує авто що використовує дану модель</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                                        <a href="/carmodel/delete/<?=$car_model["id"]?>" class="btn btn-danger">Видалити</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="h1">Моделей не знайдено</div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>
<!--<script defer >-->
<!--    $(document).ready(function () {-->
<!--        $(function () {-->
<!--            $('[data-toggle="tooltip"]').tooltip();-->
<!--        });-->
<!--    };-->
<!--</script>-->