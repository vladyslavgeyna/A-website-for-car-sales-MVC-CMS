<?php
/** @var array $data */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Всі оголошення';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Всі оголошення</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_car_ad_activated"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_ad_activated"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_ad_activated"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_car_ad_deactivated"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_ad_deactivated"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_ad_deactivated"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_car_ad_deleted"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_ad_deleted"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_ad_deleted"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_car_ad_edited"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_ad_edited"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_ad_edited"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-carad-index-admin section-table-admin">
            <div class="container-fluid">
                <?php if(!empty($data["ads"])): ?>
                    <div class="card">
                        <div class="card-body p-0" style="overflow: auto">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 2%">ID</th>
                                    <th style="width: 2%">ID автомобіля</th>
                                    <th style="width: 7%">Заголовок</th>
                                    <th style="width: 15%">Текст</th>
                                    <th style="width: 10%">Дата та час створення</th>
                                    <th style="width: 5%">Чи активне</th>
                                    <th style="width: 3%">ID користувача, що його створив</th>
                                    <th style="width: 15%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data["ads"] as $ad) : ?>
                                    <tr>
                                        <td><?=$ad["id"]?></td>
                                        <td><?=$ad["car_id"]?></td>
                                        <td><?=$ad["title"]?></td>
                                        <?php if (mb_strlen($ad["text"]) > 20): ?>
                                            <td><?=mb_substr($ad["text"], 0, 20, 'UTF-8')?>...</td>
                                        <?php else: ?>
                                            <td><?=$ad["text"]?></td>
                                        <?php endif; ?>
                                        <td><?=$ad["date_of_creating"]?></td>
                                        <?php if ($ad["is_active"] == 1): ?>
                                            <td>Так</td>
                                        <?php else: ?>
                                            <td>Ні</td>
                                        <?php endif; ?>
                                        <td><?=$ad["user_id"]?></td>
                                        <td class="project-actions text-right d-flex flex-column flex-sm-row justify-content-end" style="gap: 0.5rem">
                                            <?php if ($ad["is_active"] == 1): ?>
                                                <a class="btn btn-warning" href="/carad/deactivate/<?=$ad["id"]?>" >
                                                    <i class="fa-solid fa-eye-slash pr-1"></i>
                                                    Деактивувати
                                                </a>
                                            <?php else: ?>
                                                <a class="btn btn-warning" href="/carad/activate/<?=$ad["id"]?>" >
                                                    <i class="fa-solid fa-eye pr-1"></i>
                                                    Активувати
                                                </a>
                                            <?php endif; ?>
                                            <a class="btn btn-info " href="/carad/edit/<?=$ad["id"]?>">
                                                <i class="fas fa-pencil-alt pr-1"></i>
                                                Редагувати
                                            </a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-carad-<?=$ad["id"]?>" type="button" >
                                                <i class="fas fa-trash pr-1"></i>
                                                Видалити
                                            </button>
                                        </td>
                                        <div class="modal modal-confirm-delete-carad fade" id="confirm-delete-carad-<?=$ad["id"]?>" tabindex="-1" aria-hidden="false">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div style="border-radius: 25px;" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p >Ви дійсно бажаєте видалити це оголошення?<br>Ця дія є безповоротною!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                                        <a href="/carad/delete/<?=$ad["id"]?>" class="btn btn-danger">Видалити</a>
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
                    <div class="h1">Оголошень не знайдено</div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>