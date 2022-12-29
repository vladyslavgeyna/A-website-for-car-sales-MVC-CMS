<?php
/** @var array $data */

use core\Core;

Core::getInstance()->pageParams['title'] = 'Адмін | Всі автомобілі';

?>
<main>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Всі автомобілі</h1>
                    </div>
                    <p class="col-12 mt-3" style="font-weight: 500; font-style: italic;">Примітка: ця сторінка використовується лише для перегляду та не передбачає дій над даними. Всі маніпуляції виконуються на <a href="/carad">сторінці із оголошеннями</a></p>
                </div>
            </div>
        </div>
        <section class="content section-car-index-admin section-table-admin">
            <div class="container-fluid">
                <?php if(!empty($data["cars"])): ?>
                    <div class="card">
                        <div class="card-body p-0" style="overflow: auto">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 3%">ID марки</th>
                                    <th style="width: 2%">ID моделі</th>
                                    <th style="width: 3%">Рік випуску</th>
                                    <th style="width: 5%">Об'єм двигуна</th>
                                    <th style="width: 3%">ID виду палива</th>
                                    <th style="width: 3%">ID коробки передач</th>
                                    <th style="width: 5%">Колір</th>
                                    <th style="width: 3%">ID області</th>
                                    <th style="width: 10%">Район</th>
                                    <th style="width: 7%">Місто</th>
                                    <th style="width: 5%">Ціна</th>
                                    <th style="width: 3%">ID виду валюти</th>
                                    <th style="width: 3%">ID приводу</th>
                                    <th style="width: 3%">Кількість місць</th>
                                    <th style="width: 5%">Пробіг</th>
                                    <th style="width: 30%">Додаткові опції</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data["cars"] as $car) : ?>
                                    <tr>
                                        <td><?=$car["id"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['car_brand']['name']?>"><?=$car["car_brand_id"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['car_model']['name']?>"><?=$car["car_model_id"]?></td>
                                        <td><?=$car["year_of_production"]?></td>
                                        <td><?=$car["engine_capacity"]?> л.</td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['fuel']['name']?>"><?=$car["fuel_id"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['transmission']['name']?>"><?=$car["transmission_id"]?></td>
                                        <td><?=$car["color"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['region']['name']?>"><?=$car["region_id"]?></td>
                                        <td><?=$car["district"]?></td>
                                        <td><?=$car["city"]?></td>
                                        <td><?=$car["price"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['type_of_currency']['name']?>"><?=$car["type_of_currency_id"]?></td>
                                        <td style="cursor: help;"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?=$car['wheel_drive']['name']?>"><?=$car["wheel_drive_id"]?></td>
                                        <td><?=$car["number_of_seats"]?></td>
                                        <td><?=$car["mileage"]?> тис. км.</td>
                                        <?php if (empty($car["additional_options"])) : ?>
                                            <td>-</td>
                                        <?php else :?>
                                            <td><?=$car["additional_options"]?></td>
                                        <?php endif ;?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="h1">Автомобілів не знайдено</div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>