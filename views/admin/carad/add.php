<?php

/** @var array $errors */
/** @var array $data */
/** @var array $auto_complete */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Додавання оголошення';
?>

<main class="main main-carad-add">
    <div class="content-wrapper container-carad-add">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-weight: bold; font-size: 40px" class="m-0">Додавання оголошення</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content section-carad-add-admin section-table-admin">
            <div class="container-fluid">
                <?php if (!empty($_SESSION["success_car_ad_added"])): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-check"></i><?= $_SESSION["success_car_ad_added"]; ?></h4>
                    </div>
                    <?php unset($_SESSION["success_car_ad_added"]); ?>
                <?php endif; ?>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-admin alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="m-0"><i class="icon fa fa-solid fa-xmark"></i>Перевірте коректність заповнених даних</h4>
                    </div>
                <?php endif; ?>
                <div class="card card-primary">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="h4 fw-bold">Додайте фото Вашого автомобіля:</div>
                            <div class="input-group input-file mb-3">
                                <label for="exampleInputPhotos" class="form-label">Оберіть фотографії (максимальна кількість фотографій: <?=$data["max_image_count"]?>)</label>
                                <div>
                                    <input required accept="image/jpeg, image/png" multiple type="file" name="car_photos[]" class="form-control d-flex align-items-center h-100" id="exampleInputPhotos">
                                </div>
                                <?php if (!empty($errors['car_photos_type'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть файл із одним із вказаних розширень. Приклад: image.png або image.jpeg"><?= $errors['car_photos_type']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($errors['car_photos_count'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть менше фотографій"><?= $errors['car_photos_count']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($errors['car_photos_exist'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть фотографії"><?= $errors['car_photos_exist']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($errors['main_photo'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть головне фото"><?= $errors['main_photo']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="error-form-validation hidden">
                                    <span>Ви обрали занадто багато файлів</span>
                                </div>
                                <div style="gap: 10px;" class="images images-block d-flex justify-content-start mt-2 hidden"></div>
                            </div>
                            <hr class="my-4">
                            <div class="h4 fw-bold ">Основна інформація:</div>
                            <div class="mb-3">
                                <label for="inputCarBrand" class="form-label">Марка автомобіля:</label>
                                <select name="car_brand" required class="form-select form-control" id="inputCarBrand" >
                                    <option value="-1" disabled selected >Оберіть марку</option>
                                    <?php foreach ($data["car_brands"] as $item) : ?>
                                        <?php if ($auto_complete["car_brand"] == $item["id"]) : ?>
                                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php else : ?>
                                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['car_brand'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних марок авто"><?= $errors['car_brand']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputCarModel" class="form-label">Модель автомобіля:</label>
                                <select name="car_model" required class="form-select form-control" id="inputCarModel" >
                                    <option value="-1" disabled selected >Оберіть модель</option>
                                    <?php if (!empty($auto_complete["car_models"])) : ?>
                                        <?php foreach ($auto_complete["car_models"] as $item) : ?>
                                            <?php if ($auto_complete["car_model"] == $item["id"]) : ?>
                                                <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php else : ?>
                                                <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (!empty($errors['car_model'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних моделей авто"><?= $errors['car_model']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputCarYearOfProduction" class="form-label">Рік випуску автомобіля:</label>
                                <select name="car_year_of_production" required class="form-select form-control" id="inputCarYearOfProduction" >
                                    <option value="-1" disabled selected >Оберіть рік</option>
                                    <?php for ($i = date("Y"); $i >= 1900; $i--) : ?>
                                        <?php if ($auto_complete["car_year_of_production"] == $i ) : ?>
                                            <option selected value="<?=$i?>"><?=$i?></option>
                                        <?php else : ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                                <?php if (!empty($errors['car_year_of_production'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних років"><?= $errors['car_year_of_production']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputMileage" class="form-label">Пробіг (тисяч кілометрів):</label>
                                <input required name="car_mileage" type="text" class="form-control" value="<?=$auto_complete['car_mileage']?>" placeholder="Наприклад: 220" id="inputMileage" >
                                <?php if (!empty($errors['car_mileage'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно пробіг"><?= $errors['car_mileage']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="error-form-validation hidden">
                                    <span>Ви помилилися при виборі пробігу</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputRegion" class="form-label">Область:</label>
                                <select name="car_region" required class="form-select form-control" id="inputRegion" >
                                    <option value="-1" disabled selected >Оберіть область</option>
                                    <?php foreach ($data["regions"] as $item) : ?>
                                        <?php if ($auto_complete["car_region"] == $item["id"]) : ?>
                                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php else : ?>
                                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['car_region'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних областей"><?= $errors['car_region']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputDistrict" class="form-label">Район:</label>
                                <input required value="<?=$auto_complete['car_district']?>" name="car_district" type="text" placeholder="Наприклад: Бердичівський" class="form-control" id="inputDistrict" >
                                <?php if (!empty($errors['car_district'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно район"><?= $errors['car_district']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputCity" class="form-label">Місто (село, селище):</label>
                                <input required value="<?=$auto_complete['car_city']?>" name="car_city" type="text" placeholder="Наприклад: Семенівка" class="form-control" id="inputCity" >
                                <?php if (!empty($errors['car_city'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно місто (село, селище)"><?= $errors['car_city']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr class="my-4">
                            <div class="h4 fw-bold">Характеристики авто:</div>
                            <div class="mb-3">
                                <label for="inputRegion" class="form-label">Коробка передач:</label>
                                <select name="car_transmission" required class="form-select form-control" id="inputRegion" >
                                    <option value="-1" disabled selected >Оберіть коробку передач</option>
                                    <?php foreach ($data["transmissions"] as $item) : ?>
                                        <?php if ($auto_complete["car_transmission"] == $item["id"]) : ?>
                                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php else : ?>
                                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['car_transmission'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних трансмісій"><?= $errors['car_transmission']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputFuel" class="form-label">Паливо:</label>
                                <select name="car_fuel" required class="form-select form-control" id="inputFuel" >
                                    <option value="-1" disabled selected >Оберіть паливо</option>
                                    <?php foreach ($data["fuels"] as $item) : ?>
                                        <?php if ($auto_complete["car_fuel"] == $item["id"]) : ?>
                                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php else : ?>
                                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['car_fuel'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних вид палива"><?= $errors['car_fuel']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3" id="inputEngineCapacityBlock">
                                <label for="inputEngineCapacity" class="form-label">Об'єм двигуна (в літрах):</label>
                                <input value="<?=$auto_complete['car_engine_capacity']?>" name="car_engine_capacity" type="text" class="form-control" placeholder="Наприклад: 2.2" id="inputEngineCapacity" >
                                <?php if (!empty($errors['car_engine_capacity'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно об'єм двигуна"><?= $errors['car_engine_capacity']; ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="error-form-validation hidden">
                                    <span>Ви помилилися при виборі об'єму двигуна</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputWheelDrive" class="form-label">Привід:</label>
                                <select name="car_wheel_drive" required class="form-select form-control" id="inputWheelDrive" >
                                    <option value="-1" disabled selected >Оберіть привід</option>
                                    <?php foreach ($data["wheel_drives"] as $item) : ?>
                                        <?php if ($auto_complete["car_wheel_drive"] == $item["id"]) : ?>
                                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php else : ?>
                                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['car_wheel_drive'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних привід"><?= $errors['car_wheel_drive']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputColor" class="form-label">Колір:</label>
                                <input required value="<?=$auto_complete['car_color']?>" name="car_color" type="text" class="form-control" placeholder="Наприклад: Червоний" id="inputColor" >
                                <?php if (!empty($errors['car_color'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно колір"><?= $errors['car_color']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="inputCarNumberOfSeats" class="form-label">Кількість місць:</label>
                                <select name="car_number_of_seats" required class="form-select form-control" id="inputCarNumberOfSeats" >
                                    <option value="-1" disabled selected >Оберіть кількість місць</option>
                                    <?php for ($i = 1; $i <= 60; $i++) : ?>
                                        <?php if ($auto_complete["car_number_of_seats"] == $i ) : ?>
                                            <option selected value="<?=$i?>"><?=$i?></option>
                                        <?php else : ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                                <?php if (!empty($errors['car_number_of_seats'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних кількість місць"><?= $errors['car_number_of_seats']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr class="my-4" >
                            <div class="h4 fw-bold">Додаткові опції:</div>
                            <div class="mb-3">
                                <label for="FormControlTextareaAdditionalOptions" class="form-label">Додаткові опції (через кому) (не обов'язково, залиште це поле порожнім, якщо даний пункт не потрібний):</label>
                                <textarea name="car_additional_options" class="form-control" placeholder="Наприклад: Бортовий комп'ютер, задня камера, протитуманні фари, carplay" id="FormControlTextareaAdditionalOptions" style="height: 70px; resize: none;"><?=$auto_complete['car_additional_options']?></textarea>
                                <?php if (!empty($errors['car_additional_options'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно додаткові опції"><?= $errors['car_additional_options']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr class="my-4">
                            <div class="h4 fw-bold">Опис автомобіля:</div>
                            <div class="mb-3">
                                <label for="FormControlTextareaTitle" class="form-label">Заголовок оголошення (вкажіть основні деталі):</label>
                                <input id="FormControlTextareaTitle" placeholder="Наприклад: BMW X5 2015 в M пакеті" required value="<?=$auto_complete['car_ad_title']?>" name="car_ad_title" type="text" class="form-control" >
                                <?php if (!empty($errors['car_ad_title'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно заголовок оголошення"><?= $errors['car_ad_title']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="FormControlTextareaText" class="form-label">Текст оголошення (опис автомобіля):</label>
                                <textarea required name="car_ad_text" class="form-control" id="FormControlTextareaText" style="height: 150px; resize: none;"><?=$auto_complete['car_ad_text']?></textarea>
                                <?php if (!empty($errors['car_ad_text'])): ?>
                                    <div class="error-form-validation">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно текст оголошення"><?= $errors['car_ad_text']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr class="my-4">
                            <div class="h4 fw-bold">Вартість:</div>
                            <div class="mb-3">
                                <label for="inputPrice" class="form-label">Ціна (цифрами)</label> <span>та </span><label for="inputCarTypeOfCurrency">валюта:</label>
                                <div class="d-flex  row m-0 gap-2 flex-row" id="inputPriceWrapper" style="gap: 1rem">
                                    <div class="col p-0">
                                        <input required value="<?=$auto_complete['car_price']?>" name="car_price" type="text" class="form-control" placeholder="Наприклад: 7500" id="inputPrice" >
                                        <?php if (!empty($errors['car_price'])): ?>
                                            <div class="error-form-validation">
                                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно ціну"><?= $errors['car_price']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="error-form-validation error-form-validation-front hidden">
                                            <span>Ви помилилися при виборі ціни</span>
                                        </div>
                                    </div>
                                    <div class="col p-0">
                                        <select name="car_type_of_currency" required class="form-select form-control" id="inputCarTypeOfCurrency" >
                                            <option value="-1" disabled selected >Оберіть валюту</option>
                                            <?php foreach ($data["types_of_currencies"] as $item) : ?>
                                                <?php if ($auto_complete["car_type_of_currency"] == $item["id"]) : ?>
                                                    <option selected value="<?=$item["id"]?>"><?=$item["sign"]." "?>(<?=$item["name"]?>)</option>
                                                <?php else : ?>
                                                    <option value="<?=$item["id"]?>"><?=$item["sign"]." "?>(<?=$item["name"]?>)</option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (!empty($errors['car_type_of_currency'])): ?>
                                            <div class="error-form-validation">
                                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних валюту"><?= $errors['car_type_of_currency']; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" >
                        </div>
                        <div class="card-footer">
                            <button id="btn-add-ad" class="btn primary-color-bg primary-color-hover" type="submit">Розмістити оголошення</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
<script defer>
    function isInt(value) {
        return !isNaN(value) && parseInt(Number(value)) == value && !isNaN(parseInt(value, 10));
    }
    const inputEngineCapacityBlock = document.getElementById("inputEngineCapacityBlock");
    const inputFuel = document.getElementById("inputFuel");
    const MAX_ALLOWED_IMAGE_COUNT = 5;
    const inputFiles = document.getElementById("exampleInputPhotos");
    const buttonAddAd = document.getElementById("btn-add-ad");
    const imagesBlock = document.querySelector(".container-carad-add .images");
    const blockMessageErrorPhoto = document.querySelector(".container-carad-add .input-file .error-form-validation");
    const blockMessageErrorMileage = document.querySelector(".container-carad-add #inputMileage+.error-form-validation");
    const blockMessageErrorEngineCapacity = document.querySelector(".container-carad-add #inputEngineCapacity+.error-form-validation");
    const blockMessageErrorPrice = document.querySelector(".container-carad-add #inputPriceWrapper .error-form-validation-front");
    const inputMileage = document.getElementById("inputMileage");
    const inputEngineCapacity = document.getElementById("inputEngineCapacity");
    const inputPrice = document.getElementById("inputPrice");
    window.addEventListener("load", () => {
        if (inputFuel.value == 4) {
            inputEngineCapacityBlock.classList.add("hidden");
            inputEngineCapacity.value = "";
        } else {
            inputEngineCapacityBlock.classList.remove("hidden");
        }
    });
    inputFuel.addEventListener("change", () => {
        if (inputFuel.value == 4) {
            inputEngineCapacityBlock.classList.add("hidden");
            inputEngineCapacity.value = "";
        } else {
            inputEngineCapacityBlock.classList.remove("hidden");
        }
    });
    inputPrice.addEventListener("input", () => {
        inputPrice.value = inputPrice.value.replace(/[^\d.]/g, '');
        if(isNaN(inputPrice.value) || parseFloat(inputPrice.value) <= 0 ) {
            blockMessageErrorPrice.classList.remove("hidden");
            buttonAddAd.setAttribute("disabled", "disabled");
        } else {
            blockMessageErrorPrice.classList.add("hidden");
            buttonAddAd.removeAttribute("disabled");
        }
    });
    inputEngineCapacity.addEventListener("input", () => {
        inputEngineCapacity.value = inputEngineCapacity.value.replace(/[^\d.]/g, '');
        if(isNaN(inputEngineCapacity.value) || parseFloat(inputEngineCapacity.value) <= 0 ) {
            blockMessageErrorEngineCapacity.classList.remove("hidden");
            buttonAddAd.setAttribute("disabled", "disabled");
        } else {
            blockMessageErrorEngineCapacity.classList.add("hidden");
            buttonAddAd.removeAttribute("disabled");
        }
    });
    inputMileage.addEventListener("input", () => {
        inputMileage.value = inputMileage.value.replace(/[^\d]/g, '');
        if(inputMileage.value != "" &&(!isInt(inputMileage.value) || (parseInt(inputMileage.value) > 999 || parseInt(inputMileage.value) < 1))) {
            blockMessageErrorMileage.classList.remove("hidden");
            buttonAddAd.setAttribute("disabled", "disabled");
        } else {
            blockMessageErrorMileage.classList.add("hidden");
            buttonAddAd.removeAttribute("disabled");
        }
    });
    inputFiles.addEventListener("change", () => {
        console.log(inputFiles.files);
        imagesBlock.innerHTML = "";
        if(inputFiles.files.length > MAX_ALLOWED_IMAGE_COUNT) {
            buttonAddAd.setAttribute("disabled", "disabled");
            blockMessageErrorPhoto.classList.remove("hidden");
            imagesBlock.innerHTML = "";
            imagesBlock.classList.add("hidden");
        } else {
            buttonAddAd.removeAttribute("disabled");
            blockMessageErrorPhoto.classList.add("hidden");
            imagesBlock.classList.remove("hidden");
            for (let i = 0; i < inputFiles.files.length; i++) {
                const div = document.createElement("div");
                const div2 = document.createElement("div");
                const radio = document.createElement("input");
                radio.setAttribute("id", `radio-{${i}}`);
                radio.setAttribute("required", "required");
                const radioLabel = document.createElement("label");
                radioLabel.innerHTML = "головне фото";
                radioLabel.setAttribute("for", `radio-{${i}}`);
                const divRadioBlock = document.createElement("div");
                divRadioBlock.classList.add("radio-block");
                if(i === 0) {
                    radio.setAttribute("checked", "checked");
                }
                radio.setAttribute("type", "radio");
                radio.setAttribute("name", "main_photo");
                radio.setAttribute("value", inputFiles.files[i].name);
                div2.classList.add("column");
                div.classList.add("selected_car_image_block");
                const image = document.createElement("img");
                image.classList.add("img-thumbnail");
                image.setAttribute("alt", "Зображення автомобіля");
                image.src = URL.createObjectURL(inputFiles.files[i]);
                div.appendChild(image);
                div2.appendChild(div);
                divRadioBlock.appendChild(radio);
                divRadioBlock.appendChild(radioLabel);
                div2.appendChild(divRadioBlock);
                imagesBlock.appendChild(div2);
            }
        }
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script defer >
    $(document).ready(function () {
        function createCarModelsSelect(modelsList) {
            const select = document.getElementById("inputCarModel");
            if (modelsList !== null) {
                select.innerHTML = "";
                const option = document.createElement("option");
                option.setAttribute("value", "-1");
                option.setAttribute("disabled", "disabled");
                option.setAttribute("selected", "selected");
                option.innerHTML = "Оберіть модель";
                select.appendChild(option);
                for (let i = 0; i < modelsList.length; i++) {
                    const option = document.createElement("option");
                    option.setAttribute("value", modelsList[i].id);
                    option.innerHTML = modelsList[i].name;
                    select.appendChild(option);
                }
            } else {
                select.innerHTML = "";
                const option = document.createElement("option");
                option.setAttribute("value", "-1");
                option.setAttribute("disabled", "disabled");
                option.setAttribute("selected", "selected");
                option.innerHTML = "Оберіть модель";
                select.appendChild(option);
            }
        }
        let inputCarBrand = document.getElementById("inputCarBrand");
        inputCarBrand.addEventListener("change", () => {
            let value = inputCarBrand.value;
            $.ajax({
                url: "/carad/add",
                method: "POST",
                data: {
                    ajax: 1,
                    car_brand_id: value
                },
                success: function (response) {
                    createCarModelsSelect(JSON.parse(response));
                },
                dataType: "text"
            });
        })
    });
</script>
