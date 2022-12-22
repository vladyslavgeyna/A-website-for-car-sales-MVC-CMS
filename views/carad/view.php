<?php
/** @var array $errors */
/** @var array $data */
use core\Core;
use models\Favoritead;
use models\User;

Core::getInstance()->pageParams['title'] = 'Оголошення ' . $data["ad"]["title"];

?>

<main class="main main-carad-view">
    <div class="container container-carad-view">
        <div class="title-block mb-4 pb-2">
            <?php if (User::isUserAuthenticated()): ?>
                <?php if (Favoritead::hasCurrentUserFavoriteAdByCarAdId($data["ad"]["id"])): ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Видалити оголошення з обраного" href="/favoritead/delete?id=<?=$data["ad"]["id"]?>"><i class="fa-solid fa-heart h1 m-0"></i></a>
                <?php else: ?>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Додати оголошення до обраного" href="/favoritead/add?id=<?=$data["ad"]["id"]?>"><i class="fa-regular fa-heart h1 m-0"></i></a>
                <?php endif; ?>
            <?php endif; ?>
            <h1 class="m-0"><?=$data["ad"]["title"]?></h1>
        </div>
        <div class="carad-view-wrapper mt-4 ">
            <div class="carad-view-left-wrapper mt-lg-0 mt-3">
                <div class="carad-view-left">
                    <div class="carad-view-price ">
                        <div style="border-radius: 25px;" class="alert alert-success p-2 ps-3" role="alert">
                            <p class="h2 m-0 fw-bold"><?=$data["ad"]["car"]["price"]." ".$data["ad"]["car"]["type_of_currency"]["sign"]?></p>
                        </div>
                    </div>
                    <div class="carad-view-owner p-2">
                        <div class="carad-view-owner-content d-flex gap-3">
                            <div style="width: 100px;" class="carad-view-owner-image-wrapper">
                                <?php if (User::hasUserByIdImage($data["ad"]["user_id"])): ?>
                                    <img class="w-100"  src="<?=User::getUserByIdImagePath($data["ad"]["user_id"])?>" alt="Аватар продавця">
                                <?php else: ?>
                                    <img class="w-100" src="/themes/images/default_avatar_2.svg" alt="Аватар продавця">
                                <?php endif; ?>
                            </div>
                            <div class="carad-view-owner-data">
                                <p class="mb-2 h5">
                                    <strong>Продавець</strong>
                                    <?php if (User::isUserAuthenticated()): ?>
                                        <?php if (User::getCurrentUserId() == $data["ad"]["user_id"]): ?>
                                            <strong><span> (Ви)</span></strong>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>
                                <p class="mb-2"><?=$data["ad"]["user"]["surname"]." ".$data["ad"]["user"]["name"]." ".$data["ad"]["user"]["lastname"]?></p>
                                <a class="h5" href="tel:+38<?=$data["ad"]["user"]["phone"]?>"><i style="font-size: 18px;" class="fa-solid fa-phone pe-2"></i><?=$data["ad"]["user"]["phone"]?></a>
                                <a class="h5" href="mailto:<?=$data["ad"]["user"]["login"]?>"><i style="font-size: 18px;" class="fa-solid fa-envelope  pe-2"></i><?=$data["ad"]["user"]["login"]?></a>
                            </div>
                        </div>
                    </div>
                    <div class="carad-view-info ps-2 mt-3">
                        <div class="carad-view-created">
                            <p class="mb-2">Оголошення створене: <strong><?=$data["ad"]["date_of_creating"]?></strong></p>
                        </div>
                        <div class="carad-view-favorites-count">
                            <p class="mb-2">Збережень до обраного: <strong><?=Favoritead::getCountOfFavoriteAdByCarAdId($data["ad"]["id"])?></strong></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="carad-view-right-wrapper pl-md-3">
                <div class="carad-view-right">
                    <?php if ( count($data["ad"]["car"]["images"]) != 1):?>
                        <div style="border-radius: 25px; overflow: hidden; " class="carad-view-right-swiper">
                            <div id="carouselExampleIndicators" class="carousel slide">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <?php for ($i = 1; $i < count($data["ad"]["car"]["images"]); $i++):?>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i?>" aria-label="Slide <?=$i + 1?>"></button>
                                    <?php endfor;?>
                                </div>
                                <div class="carousel-inner d-flex align-items-center">
                                    <div class="carousel-item active">
                                        <a href="/files/car/<?=$data["ad"]["car"]["main_image"]["name"]?>" data-fancybox="gallery">
                                            <img src="/files/car/<?=$data["ad"]["car"]["main_image"]["name"]?>" class="d-block w-100" alt="Зображення автомобіля">
                                        </a>
                                    </div>
                                    <?php foreach ($data["ad"]["car"]["images"] as $image):?>
                                        <?php if ($image["is_main"] == 1):?>
                                            <?php continue; ?>
                                        <?php endif; ?>
                                        <div class="carousel-item">
                                            <a href="/files/car/<?=$image["name"]?>" data-fancybox="gallery">
                                                <img src="/files/car/<?=$image["name"]?>" class="d-block w-100" alt="Зображення автомобіля">
                                            </a>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    <?php else:?>
                        <div class="carousel-item-image-one">
                            <img src="/files/car/<?=$data["ad"]["car"]["main_image"]["name"]?>" class="d-block w-100" alt="Зображення автомобіля">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
<script defer src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
