<?php
/** @var array $data */
use core\Core;
use models\User;

Core::getInstance()->pageParams['title'] = 'Відгуки про продавця ' .$data["reviews"]["user"]["surname"]." ".$data["reviews"]["user"]["name"]." ".$data["reviews"]["user"]["lastname"];

?>
<main class="main main-userreview-view">
    <div class="container container-userreview-view">
        <?php if (!empty($_SESSION["success_review_added"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-check"></i><span style="margin-left: 10px" ><?= $_SESSION["success_review_added"]; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success_review_added"]); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION["success_review_deleted"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-check"></i><span style="margin-left: 10px" ><?= $_SESSION["success_review_deleted"]; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success_review_deleted"]); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION["success_review_edited"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-check"></i><span style="margin-left: 10px" ><?= $_SESSION["success_review_edited"]; ?></span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success_review_edited"]); ?>
        <?php endif; ?>
        <?php if (empty($data["reviews"]) || count($data["reviews"]) == 1) : ?>
            <div style="border-radius: 25px" class="alert alert-primary py-4" role="alert">
                <?php if (User::isUserAuthenticated() && User::getCurrentUserId() == $data["reviews"]["user"]["id"]) : ?>
                    <div class="h1 text-center fw-bold mb-0">Наразі Ви не отримали жодного відгуку</div>
                <?php else: ?>
                    <div class="h1 text-center fw-bold mb-0">Наразі цей продавець не отримав жодного відгуку</div>
                    <?php if (User::isUserAuthenticated()) : ?>
                        <div class="h2 text-center fw-bold pt-2 mb-0">Але Ви можете його <a href="/userreview/add/<?=$data["reviews"]["user"]["id"]?>">залишити</a></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php if (User::isUserAuthenticated() && User::getCurrentUserId() == $data["reviews"]["user"]["id"]) : ?>
                <h1 class="mb-3">Відгуки про Вас:</h1>
            <?php else: ?>
                <h1 class="mb-3">Відгуки про продавця:<br><?=$data["reviews"]["user"]["surname"]." ".$data["reviews"]["user"]["name"]." ".$data["reviews"]["user"]["lastname"]?></h1>
            <?php endif; ?>
            <?php for ($i = 0; $i < count($data["reviews"]) - 1; $i++) :?>
                <div class="card mb-4">
                    <h5 class="card-header py-2 fw-bold">
                        <?=$data["reviews"][$i]["user_from"]["surname"]." ".$data["reviews"][$i]["user_from"]["name"]." ".$data["reviews"][$i]["user_from"]["lastname"]?>
                        <?php if($data["reviews"][$i]["user_from"]["id"] == User::getCurrentUserId()): ?>
                        <span>(Ви)</span>
                        <?php endif; ?>
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title"><?=$data["reviews"][$i]["title"]?></h5>
                        <p class="card-text"><?=$data["reviews"][$i]["text"]?></p>
                        <?php if($data["reviews"][$i]["user_from"]["id"] == User::getCurrentUserId()): ?>
                            <button data-bs-toggle="modal" data-bs-target="#confirm-delete-review-<?=$data["reviews"][$i]["id"]?>" type="button" class="btn btn-danger delete-btn">Видалити відгук</button>
                            <a href="/userreview/edit/<?=$data["reviews"][$i]["id"]?>" class="btn btn-primary">Редагувати</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($data["reviews"][$i]["user_from"]["id"] == User::getCurrentUserId()): ?>
                    <div class="modal modal-confirm-delete-review fade" id="confirm-delete-review-<?=$data["reviews"][$i]["id"]?>" tabindex="-1" aria-hidden="false">
                        <div class="modal-dialog modal-dialog-centered">
                            <div style="border-radius: 25px;" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Підтверження</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Ви дійсно бажаєте видалити цей відгук?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-no-action primary-color-bg primary-color-hover" data-bs-dismiss="modal">Відмінити</button>
                                    <a href="/userreview/delete/<?=$data["reviews"][$i]["id"]?>" class="btn btn-danger">Видалити</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endfor ;?>
        <?php endif; ?>
    </div>
</main>