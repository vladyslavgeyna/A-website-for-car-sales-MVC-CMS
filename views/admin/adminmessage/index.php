<?php
/** @var array $data */
use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Адмін | Повідомлення';

?>
<main class="main ">
    <div class="content-wrapper">
        <?php if (!empty($data["messages"])) : ?>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="font-weight: bold; font-size: 40px" class="m-0">Повідомлення</h1>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <section class="content section-admin-messages">
            <div class="container-fluid">
                <?php if (!empty($_SESSION["success_message_deleted"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_message_deleted"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_message_deleted"]); ?>
                <?php endif; ?>
                <?php if (empty($data["messages"])) : ?>
                    <div style="border-radius: 25px" class="alert alert-primary py-4 mt-2" role="alert">
                        <div class="h1 text-center fw-bold mb-0">Наразі повідомлень немає</div>
                    </div>
                <?php else: ?>
                <div class="row">
                    <?php foreach ($data["messages"] as $message) :?>
                        <div class="col-12 col-xl-6">
                            <div class="card h-100 mb-4 card-primary">
                                <h5 class="card-header py-2 fw-bold d-flex align-items-center justify-content-between" style="gap: 20px; font-size: 1.2rem">
                                    <span style="flex: 1 1 auto">Від: <?="#".$message["message"]["user"]["id"]." ".$message["message"]["user"]["surname"]." ".$message["message"]["user"]["name"]." ".$message["message"]["user"]["lastname"]?></span>
                                    <span><?=$message["message"]["date_of_creating"]?></span>
                                </h5>
                                <div class="card-body">
                                    <p class="card-text"><?=$message["message"]["text"]?></p>
                                </div>
                                <div class="card-footer">
                                    <button data-toggle="modal" data-target="#confirm-delete-forme-<?=$message["id"]?>" type="button" class="btn btn-danger delete-btn">Видалити для себе</button>
                                    <button data-toggle="modal" data-target="#confirm-delete-forall-<?=$message["id"]?>" type="button" class="btn btn-danger delete-btn">Видалити для всіх</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal-confirm-delete-forall fade" id="confirm-delete-forall-<?=$message["id"]?>" tabindex="-1" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div style="border-radius: 25px;" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p >Ви дійсно бажаєте видалити це повідомлення для всіх адмінів?<br>Ця дія є безповоротною!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                        <a href="/adminmessage/deleteforall/<?=$message["id"]?>" class="btn btn-danger">Видалити</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal modal-confirm-delete-forme fade" id="confirm-delete-forme-<?=$message["id"]?>" tabindex="-1" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div style="border-radius: 25px;" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bold">Підтверження</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p >Ви дійсно бажаєте видалити це повідомлення для себе?<br>Ця дія є безповоротною!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-dismiss="modal">Відмінити</button>
                                        <a href="/adminmessage/deleteforme/<?=$message["id"]?>" class="btn btn-danger">Видалити</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ;?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>