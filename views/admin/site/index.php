<?php
/** @var array $data */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Головна сторінка';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Головна сторінка</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-index-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6  h-100">
                        <div class="small-box bg-info">
                            <div class="inner py-3">
                                <h3><?= $data["car_ads_count"] ?></h3>
                                <p style="font-size: 1.2rem">Оголошень на сайті</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-pager px-1"></i>
                            </div>
                            <a href="/carad" class="small-box-footer py-1">Детальніше <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6  h-100">
                        <div class="small-box bg-success">
                            <div class="inner py-3">
                                <h3><?=$data["cars_average_price"]?><sup style="font-size: 20px; margin-left: 10px;">$</sup></h3>
                                <p style="font-size: 1.2rem">Середня ціна на автомобіль</p>
                            </div>
                            <div class="icon">
                                <i style="font-size: 80px;" class="fa-solid fa-dollar-sign"></i>
                            </div>
                            <a href="/car" class="small-box-footer py-1">Детальніше <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 h-100">
                        <div class="small-box bg-warning">
                            <div class="inner py-3">
                                <h3><?= $data["users_count"] ?></h3>
                                <p style="font-size: 1.2rem">Кількість користувачів</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/user" class="small-box-footer py-1">Детальніше <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>