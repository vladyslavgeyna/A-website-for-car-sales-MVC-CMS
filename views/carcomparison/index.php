<?php
/** @var array $data */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Порівняння';

?>
<!--todo Додати відображення про успішну операції-->
<main class="main main-comparison">
    <div class="container container-comparison-top">
        <h1 class="mb-3">Порівняння</h1>

    </div>
    <div style="overflow-x: auto" class="container container-comparison-body">
        <?php if (empty($data["user_comp_ads"])):?>
            <div style="border-radius: 25px" class="alert alert-primary py-4" role="alert">
                <div class="h1 text-center fw-bold mb-0">Наразі у вас немає оголошень, доданих до порівняння</div>
            </div>
        <?php else:?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td ></td>
                    <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                        <td class="p-4" >
                            <div class="d-flex align-items-center justify-content-between">
                                <a class="car-title primary-color" href="/carad/view/<?=$ad["id"]?>"><?=$ad["title"]?></a>
                                <a href="/carcomparison/delete/<?=$ad["id"]?>"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                            <div class="image-wrapper mt-3">
                                <a href="/carad/view/<?=$ad["id"]?>"><img src="/files/car/<?=$ad["car"]["main_image"]["name"]?>" alt="Зображення автомобіля"></a>
                            </div>
                            
                        </td>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Ціна</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["price"]." ".$ad["car"]["type_of_currency"]["sign"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Марка</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["car_brand"]["name"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Модель</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["car_model"]["name"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Рік випуску</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["year_of_production"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Пробіг</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["mileage"]?> тис. км.</td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Коробка передач</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["transmission"]["name"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Паливо</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["fuel"]["name"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Об'єм двигуна</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["engine_capacity"]?> л.</td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Привід</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["wheel_drive"]["name"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Колір</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["color"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Кількість місць</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?=$ad["car"]["number_of_seats"]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Додаткові опції</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <?php if (empty($ad["car"]["additional_options"])) :?>
                                <td>-</td>
                            <?php else:?>
                                <td><?=$ad["car"]["additional_options"]?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th scope="row">Місцезнаходження</th>
                        <?php foreach ($data["user_comp_ads"] as $ad) : ?>
                            <td><?= $ad["car"]["region"]["name"]?> область, <?= $ad["car"]["district"]?> район, <?= $ad["car"]["city"]?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>
    </div>
</main>