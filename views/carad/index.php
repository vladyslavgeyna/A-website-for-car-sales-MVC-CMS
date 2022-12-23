<?php
/** @var string $title */
/** @var array $data */

use core\Core;

Core::getInstance()->pageParams['title'] = $title;
?>
<main class="main main-car-ad-index">
    <div class="container container-car-ad-index">
        <div class="row row-cols-xxl-3 g-xxl-5 row-cols-xl-3 g-xl-3 row-cols-lg-2 g-lg-3 row-cols-md-2 g-md-4 row-cols-1 g-5">
            <?php if (empty($data["ads"])): ?>
                <div class="h1 fw-bold text-center w-100">Наразі оголошень немає</div>
            <?php else: ?>
                <?php foreach ($data["ads"] as $ad): ?>
                    <div class="col">
                        <div class="card h-100" >
                            <div class="card-wrapper h-100">
                                <div class="car-top">
                                    <div class="m-2 image-wrapper ">
                                        <a href="/carad/view/<?=$ad['id']?>">
                                            <img src="/files/car/<?=$ad['car']['main_image']['name']?>" class="card-img-top " alt="<?=$ad['title']?>">
                                        </a>
                                    </div>
                                    <div class="card-body pb-0">
                                        <a href="/carad/view/<?=$ad['id']?>" class="card-title h5 mb-2"><?=$ad['title']?></a>
                                        <p class="card-text card-price mb-2"><?=$ad['car']['price']." ".$ad['car']['type_of_currency']['sign']?></p>
                                        <div class="row row-cols-sm-2 row-cols-1 mb-3 gy-1">
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-speedometer"></i>
                                                    <p class="m-0"><?=$ad['car']['mileage']?> тис. км.</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-fuel-pump-fill"></i>
                                                    <?php if ($ad['car']['fuel']['name'] == "Електро" || $ad['car']['fuel_id'] == 4):?>
                                                        <p class="m-0"><?=$ad['car']['fuel']['name']?></p>
                                                    <?php else:?>
                                                        <p class="m-0"><?=$ad['car']['fuel']['name'].", ".$ad['car']['engine_capacity']?> л.</p>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-gear-wide"></i>
                                                    <p class="m-0"><?=$ad['car']['transmission']['name']?></p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="info">
                                                    <i class="bi bi-vinyl-fill"></i>
                                                    <p class="m-0"><?=$ad['car']['wheel_drive']['name']?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <div class="card-body pt-0">
                                        <a href="/carad/view/<?=$ad['id']?>" class="btn btn-view primary-color-bg primary-color-hover w-100">Переглянути</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>