<?php
/** @var array $errors */
/** @var array $data */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Мої оголошення';
//echo "<pre>";
//var_dump($data["user_ads"]);
//echo "</pre>";
//die();

?>
<main class="main main-carad-myads">
    <div class="container container-carad-myads">
        <h1 class="mb-3">Мої оголошення</h1>
        <?php if (empty($data["user_ads"])):?>
            <div style="border-radius: 25px" class="alert alert-primary py-4" role="alert">
                <div class="h1 text-center fw-bold mb-0">Наразі у вас не розміщено жодного оголошення</div>
                <div class="h2 text-center fw-bold pt-2 mb-0">Але Ви можете його <a href="/carad/add">додати</a></div>
            </div>
        <?php else:?>
            <p class="h3 mb-4">Всього оголошень: <?= $data["user_ads_count"]?></p>
             <div class="row row-cols-1 g-3">
                 <?php foreach ($data["user_ads"] as $car_ad):?>
                     <div class="col h-100">
                         <div class="card mb-3" >
                             <div class="row g-0 align-items-center">
                                 <div class="col-md-4">
                                     <div class="image-wrapper m-3">
                                         <a href="/carad/view?id=<?=$car_ad['id']?>">
                                             <img src="/files/car/<?=$car_ad["car"]["main_image"]["name"]?>" class="img-fluid rounded-start" alt="<?=$car_ad["title"]?>">
                                         </a>
                                     </div>
                                 </div>
                                 <div class="col-md-8 align-self-stretch">
                                     <div class="card-body py-4 py-sm-3 h-100">
                                         <div class="card-body-inner h-100">
                                             <div class="card-body-inner-top">
                                                 <h5 class="card-title"><a href="/carad/view?id=<?=$car_ad['id']?>"><?=$car_ad["title"]?></a></h5>
                                                 <div class="row row-cols-lg-1 row-cols-2 mb-xl-2 mb-lg-1 gy-1">
                                                     <div class="col">
                                                         <div class="info d-flex align-items-center gap-2">
                                                             <i class="bi bi-speedometer"></i>
                                                             <p class="m-0"><?=$car_ad['car']['mileage']?> тис. км.</p>
                                                         </div>
                                                     </div>
                                                     <div class="col">
                                                         <div class="info d-flex align-items-center gap-2">
                                                             <i class="bi bi-fuel-pump-fill"></i>
                                                             <?php if ($car_ad['car']['fuel']['name'] == "Електро" || $car_ad['car']['fuel_id'] == 4):?>
                                                                 <p class="m-0"><?=$car_ad['car']['fuel']['name']?></p>
                                                             <?php else:?>
                                                                 <p class="m-0"><?=$car_ad['car']['fuel']['name'].", ".$car_ad['car']['engine_capacity']?> л.</p>
                                                             <?php endif;?>
                                                         </div>
                                                     </div>
                                                     <div class="col">
                                                         <div class="info d-flex align-items-center gap-2">
                                                             <i class="bi bi-gear-wide"></i>
                                                             <p class="m-0"><?=$car_ad['car']['transmission']['name']?></p>
                                                         </div>
                                                     </div>
                                                     <div class="col">
                                                         <div class="info d-flex align-items-center gap-2">
                                                             <i class="bi bi-vinyl-fill"></i>
                                                             <p class="m-0"><?=$car_ad['car']['wheel_drive']['name']?></p>
                                                         </div>
                                                     </div>
                                                     <div class="col-12">
                                                         <div class="info d-flex align-items-center gap-2">
                                                             <i class="bi bi-pin-map-fill"></i>
                                                             <p class="m-0"><?=$car_ad['car']['region']['name']. " область, ".$car_ad['car']['district']." район, ".$car_ad['car']['city']?></p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="card-body-inner-bottom pt-sm-1">
                                                 <div >
                                                     <p class="card-text"><small class="text-muted">Створено: <?=$car_ad['date_of_creating']?></small></p>
                                                 </div>
                                                 <div style="flex-wrap: wrap" class="d-flex gap-1">
                                                     <a href="/carad/edit?id=<?=$car_ad['id']?>" class="btn btn-success">Редагувати</a>
                                                     <?php if ($car_ad["is_active"] == 1): ?>
                                                         <a href="/carad/deactivate?id=<?=$car_ad['id']?>" class="btn btn-primary">Деактивувати</a>
                                                     <?php else: ?>
                                                         <a href="/carad/activate?id=<?=$car_ad['id']?>" class="btn btn-primary">Активувати</a>
                                                     <?php endif; ?>
                                                     <a href="/carad/delete?id=<?=$car_ad['id']?>" class="btn btn-danger">Видалити</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endforeach; ?>
             </div>
        <?php endif;?>
    </div>
</main>