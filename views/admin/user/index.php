<?php
/** @var array $data */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Всі користувачі';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Всі користувачі</h1>
                    </div>
                </div>
                <?php if (!empty($_SESSION["success_user_deleted"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_user_deleted"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_user_deleted"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_user_edited"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_user_edited"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_user_edited"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_setted_admin"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_setted_admin"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_setted_admin"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_unsetted_admin"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_unsetted_admin"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_unsetted_admin"]); ?>
                <?php endif; ?>
                <?php if (!empty($_SESSION["success_deleted_user"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_deleted_user"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_deleted_user"]); ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="content section-user-index-admin section-table-admin">
            <div class="container-fluid">
                <?php if(!empty($data["users"])): ?>
                    <div class="card">
                        <div class="card-body p-0" style="overflow: auto">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 3%">ID</th>
                                    <th style="width: 5%">Ім'я</th>
                                    <th style="width: 7%">Прізвище</th>
                                    <th style="width: 10%">По-батькові</th>
                                    <th style="width: 12%">Логін</th>
                                    <th style="width: 7%">Телефон</th>
                                    <th style="width: 1%">Чи адмін</th>
                                    <th style="width: 2%">ID зображення</th>
                                    <th style="width: 30%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data["users"] as $user) : ?>
                                    <tr>
                                        <td><?=$user["id"]?></td>
                                        <td><?=$user["name"]?></td>
                                        <td><?=$user["surname"]?></td>
                                        <td><?=$user["lastname"]?></td>
                                        <td><?=$user["login"]?></td>
                                        <td><?=$user["phone"]?></td>
                                        <?php if($user["is_admin"] == 1):?>
                                            <td>Так</td>
                                        <?php else:?>
                                            <td>Ні</td>
                                        <?php endif;?>
                                        <?php if(!empty($user["image_id"])):?>
                                            <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=\models\Image::getImageNameById($user["image_id"])?>">
                                                <?=$user["image_id"]?>
                                            </td>
                                        <?php else:?>
                                            <td>
                                                -
                                            </td>
                                        <?php endif;?>
                                        <td class="project-actions text-right d-flex flex-column flex-sm-row justify-content-end" style="gap: 0.5rem">
                                            <?php if(($user["is_admin"]) != 1):?>
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#confirm-setadmin-user-<?=$user["id"]?>" type="button" >
                                                    <i class="fa-solid fa-user-shield pr-1"></i>
                                                    Зробити адміном
                                                </button>
                                            <?php else:?>
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#confirm-unsetadmin-user-<?=$user["id"]?>" type="button" >
                                                    <i class="fa-solid fa-user-lock pr-1"></i>
                                                    Видалити як адміна
                                                </button>
                                            <?php endif;?>
                                            <a class="btn btn-info " href="/user/edit/<?=$user["id"]?>">
                                                <i class="fas fa-pencil-alt pr-1"></i>
                                                Редагувати
                                            </a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-user-<?=$user["id"]?>" type="button" >
                                                <i class="fas fa-trash pr-1"></i>
                                                Видалити
                                            </button>
                                        </td>
                                        <div class="modal modal-confirm-delete-user fade" id="confirm-delete-user-<?=$user["id"]?>" tabindex="-1" aria-hidden="false">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div style="border-radius: 25px;" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p >Ви дійсно бажаєте видалити цього коритувача?<br>Ця дія є безповоротною!<br><br>Увага! В разі видалення користувача будуть видалені всі дані, пов'язані з ним, зокрема, оголошення!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                                        <a href="/user/delete/<?=$user["id"]?>" class="btn btn-danger">Видалити</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(($user["is_admin"]) != 1):?>
                                            <div class="modal modal-confirm-setadmin-user fade" id="confirm-setadmin-user-<?=$user["id"]?>" tabindex="-1" aria-hidden="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div style="border-radius: 25px;" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p >Ви дійсно бажаєте зробити цього користувача адміном?<br><br>Увага! В разі встановлення цього користувача адміном він матиме доступ до адмін панелі системи!</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                                            <a href="/user/setadmin/<?=$user["id"]?>" class="btn btn-warning">Зробити адміном</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else:?>
                                            <div class="modal modal-confirm-unsetadmin-user fade" id="confirm-unsetadmin-user-<?=$user["id"]?>" tabindex="-1" aria-hidden="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div style="border-radius: 25px;" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p >Ви дійсно бажаєте видалити цього користувача як адміна?<br><br>Увага! В разі видалення цього користувача як адміна він втратить доступ до адмін панелі системи!</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                                            <a href="/user/unsetadmin/<?=$user["id"]?>" class="btn btn-warning">Видалити як адміна</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="h1">Користувачів не знайдено</div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>