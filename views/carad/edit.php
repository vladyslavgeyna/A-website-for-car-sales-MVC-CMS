<?php

/** @var array $errors */
/** @var array $data */
/** @var array $auto_complete */
/** @var array $complete_select */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Редагування оголошення';

?>
<main class="main main-carad-add">
    <div class="container container-carad-add">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="h2 mb-0 fw-bold d-flex align-items-center"><i style="font-size: 40px" class="fa-solid fa-xmark"></i><span style="margin-left: 10px" >Перевірте коректність заповнених даних</span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="mb-3">Редагування оголошення</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="h4 fw-bold">Фото Вашого автомобіля:</div>
            <div class="input-group input-file mb-3">
                <label for="exampleInputPhotos" class="form-label">Змініть фотографії або головне фото (максимальна кількість фотографій: <?=$complete_select["max_image_count"]?>)</label>
                <div>
                    <input  accept="image/jpeg, image/png" multiple type="file" name="car_photos[]" class="form-control" id="exampleInputPhotos">
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
                <div style="gap: 10px;" class="images images2 images-block d-flex justify-content-start mt-2 ">
                    <?php for ($i = 0; $i < count($complete_select["images"]); $i++):?>
                        <div class="column">
                            <div class="selected_car_image_block">
                                <img class="img-thumbnail" alt="Зображення автомобіля" src="/files/car/<?=$complete_select["images"][$i]["name"]?>">
                            </div>
                            <div class="radio-block">
                                <?php if ($complete_select["images"][$i]["is_main"] == 1): ?>
                                    <input id="radio-<?=$i?>" class="radio-main" required="required" checked="checked" type="radio" name="main_photo" value="<?=$complete_select["images"][$i]["name"]?>">
                                    <label for="radio-<?=$i?>">головне фото</label>
                                <?php else: ?>
                                    <input id="radio-<?=$i?>" required="required" type="radio" name="main_photo" value="<?=$complete_select["images"][$i]["name"]?>">
                                    <label for="radio-<?=$i?>">головне фото</label>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <div style="gap: 10px;" class="images images-selected images-block d-flex justify-content-start mt-2 hidden"></div>
            </div>
            <hr class="my-4">
            <div class="h4 fw-bold ">Основна інформація:</div>
            <div class="mb-3">
                <label for="inputCarBrand" class="form-label">Марка автомобіля:</label>
                <select name="car_brand_id" required class="form-select" id="inputCarBrand" >
                    <option value="-1" disabled selected >Оберіть марку</option>
                    <?php foreach ($complete_select["car_brands"] as $item) : ?>
                        <?php if ($data["car_brand_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['car_brand_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних марок авто"><?= $errors['car_brand_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputCarModel" class="form-label">Модель автомобіля:</label>
                <select name="car_model_id" required class="form-select" id="inputCarModel" >
                    <option value="-1" disabled selected >Оберіть модель</option>
                    <?php foreach ($complete_select["car_models"] as $item) : ?>
                        <?php if ($data["car_model_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['car_model_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних моделей авто"><?= $errors['car_model_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputCarYearOfProduction" class="form-label">Рік випуску автомобіля:</label>
                <select name="year_of_production" required class="form-select" id="inputCarYearOfProduction" >
                    <option value="-1" disabled selected >Оберіть рік</option>
                    <?php for ($i = date("Y"); $i >= 1900; $i--) : ?>
                        <?php if ($data["year_of_production"] == $i ) : ?>
                            <option selected value="<?=$i?>"><?=$i?></option>
                        <?php else : ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
                <?php if (!empty($errors['year_of_production'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних років"><?= $errors['year_of_production']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputMileage" class="form-label">Пробіг (тисяч кілометрів):</label>
                <input required name="mileage" type="text" class="form-control" value="<?=$data['mileage']?>" placeholder="Наприклад: 220" id="inputMileage" >
                <?php if (!empty($errors['mileage'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно пробіг"><?= $errors['mileage']; ?></span>
                    </div>
                <?php endif; ?>
                <div class="error-form-validation hidden">
                    <span>Ви помилилися при виборі пробігу</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputRegion" class="form-label">Область:</label>
                <select name="region_id" required class="form-select" id="inputRegion" >
                    <option value="-1" disabled selected >Оберіть область</option>
                    <?php foreach ($complete_select["regions"] as $item) : ?>
                        <?php if ($data["region_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['region_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних областей"><?= $errors['region_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputDistrict" class="form-label">Район:</label>
                <input required value="<?=$data['district']?>" name="district" type="text" placeholder="Наприклад: Бердичівський" class="form-control" id="inputDistrict" >
                <?php if (!empty($errors['district'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно район"><?= $errors['district']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputCity" class="form-label">Місто (село, селище):</label>
                <input required value="<?=$data['city']?>" name="city" type="text" placeholder="Наприклад: Семенівка" class="form-control" id="inputCity" >
                <?php if (!empty($errors['city'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно місто (село, селище)"><?= $errors['city']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <hr class="my-4">
            <div class="h4 fw-bold">Характеристики авто:</div>
            <div class="mb-3">
                <label for="inputRegion" class="form-label">Коробка передач:</label>
                <select name="transmission_id" required class="form-select" id="inputRegion" >
                    <option value="-1" disabled selected >Оберіть коробку передач</option>
                    <?php foreach ($complete_select["transmissions"] as $item) : ?>
                        <?php if ($data["transmission_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['transmission_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних трансмісій"><?= $errors['transmission_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputFuel" class="form-label">Паливо:</label>
                <select name="fuel_id" required class="form-select" id="inputFuel" >
                    <option value="-1" disabled selected >Оберіть паливо</option>
                    <?php foreach ($complete_select["fuels"] as $item) : ?>
                        <?php if ($data["fuel_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['fuel_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних вид палива"><?= $errors['fuel_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3" id="inputEngineCapacityBlock">
                <label for="inputEngineCapacity" class="form-label">Об'єм двигуна (в літрах):</label>
                <input value="<?=$data['engine_capacity']?>" name="engine_capacity" type="text" class="form-control" placeholder="Наприклад: 2.2" id="inputEngineCapacity" >
                <?php if (!empty($errors['engine_capacity'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно об'єм двигуна"><?= $errors['engine_capacity']; ?></span>
                    </div>
                <?php endif; ?>
                <div class="error-form-validation hidden">
                    <span>Ви помилилися при виборі об'єму двигуна</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputWheelDrive" class="form-label">Привід:</label>
                <select name="wheel_drive_id" required class="form-select" id="inputWheelDrive" >
                    <option value="-1" disabled selected >Оберіть привід</option>
                    <?php foreach ($complete_select["wheel_drives"] as $item) : ?>
                        <?php if ($data["wheel_drive_id"] == $item["id"]) : ?>
                            <option selected value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["id"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['wheel_drive_id'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть один із вказаних привід"><?= $errors['wheel_drive_id']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputColor" class="form-label">Колір:</label>
                <input required value="<?=$data['color']?>" name="color" type="text" class="form-control" placeholder="Наприклад: Червоний" id="inputColor" >
                <?php if (!empty($errors['color'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно колір"><?= $errors['color']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputCarNumberOfSeats" class="form-label">Кількість місць:</label>
                <select name="number_of_seats" required class="form-select" id="inputCarNumberOfSeats" >
                    <option value="-1" disabled selected >Оберіть кількість місць</option>
                    <?php for ($i = 1; $i <= 60; $i++) : ?>
                        <?php if ($data["number_of_seats"] == $i ) : ?>
                            <option selected value="<?=$i?>"><?=$i?></option>
                        <?php else : ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
                <?php if (!empty($errors['number_of_seats'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних кількість місць"><?= $errors['number_of_seats']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <hr class="my-4" >
            <div class="h4 fw-bold">Додаткові опції:</div>
            <div class="mb-3">
                <label for="FormControlTextareaAdditionalOptions" class="form-label">Додаткові опції (через кому) (не обов'язково, залиште це поле порожнім, якщо даний пункт не потрібний):</label>
                <textarea name="additional_options" class="form-control" placeholder="Наприклад: Бортовий комп'ютер, задня камера, протитуманні фари, carplay" id="FormControlTextareaAdditionalOptions" style="height: 70px; resize: none;"><?= str_replace("<br />", "", $data['additional_options'])?></textarea>
                <?php if (!empty($errors['additional_options'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно додаткові опції"><?= $errors['additional_options']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <hr class="my-4">
            <div class="h4 fw-bold">Опис автомобіля:</div>
            <div class="mb-3">
                <label for="FormControlTextareaTitle" class="form-label">Заголовок оголошення (вкажіть основні деталі):</label>
                <input id="FormControlTextareaTitle" placeholder="Наприклад: BMW X5 2015 в M пакеті" required value="<?=$data['title']?>" name="title" type="text" class="form-control" >
                <?php if (!empty($errors['title'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно заголовок оголошення"><?= $errors['title']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="FormControlTextareaText" class="form-label">Текст оголошення (опис автомобіля):</label>
                <textarea required name="text" class="form-control" id="FormControlTextareaText" style="height: 150px; resize: none;"><?= str_replace("<br />", "", $data['text'])?></textarea>
                <?php if (!empty($errors['text'])): ?>
                    <div class="error-form-validation">
                        <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно текст оголошення"><?=($errors['text']); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <hr class="my-4">
            <div class="h4 fw-bold">Вартість:</div>
            <div class="mb-3">
                <label for="inputPrice" class="form-label">Ціна (цифрами)</label> <span>та </span><label for="inputCarTypeOfCurrency">валюта:</label>
                <div class="d-flex  row m-0 gap-2 flex-row" id="inputPriceWrapper">
                    <div class="col p-0">
                        <input required value="<?=$data['price']?>" name="price" type="text" class="form-control" placeholder="Наприклад: 7500" id="inputPrice" >
                        <?php if (!empty($errors['price'])): ?>
                            <div class="error-form-validation">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Введіть коректно ціну"><?= $errors['price']; ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="error-form-validation error-form-validation-front hidden">
                            <span>Ви помилилися при виборі ціни</span>
                        </div>
                    </div>
                    <div class="col p-0">
                        <select name="type_of_currency_id" required class="form-select" id="inputCarTypeOfCurrency" >
                            <option value="-1" disabled selected >Оберіть валюту</option>
                            <?php foreach ($complete_select["types_of_currencies"] as $item) : ?>
                                <?php if ($data["type_of_currency_id"] == $item["id"]) : ?>
                                    <option selected value="<?=$item["id"]?>"><?=$item["sign"]." "?>(<?=$item["name"]?>)</option>
                                <?php else : ?>
                                    <option value="<?=$item["id"]?>"><?=$item["sign"]." "?>(<?=$item["name"]?>)</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['type_of_currency_id'])): ?>
                            <div class="error-form-validation">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Оберіть одну із вказаних валюту"><?= $errors['type_of_currency_id']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr class="my-4" >
            <button id="btn-add-ad" class="btn primary-color-bg primary-color-hover" type="submit">Зберегти</button>
        </form>
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
    const imagesBlock = document.querySelector(".container-carad-add .images.images-selected");
    const imagesBlockOriginal = document.querySelector(".container-carad-add .images.images2");
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
            imagesBlockOriginal.classList.add("hidden");
            imagesBlock.classList.add("hidden");
        } else if (inputFiles.files.length != 0) {
            imagesBlockOriginal.classList.add("hidden");
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
        } else {
            document.querySelector("input.radio-main").click();
            blockMessageErrorPhoto.classList.add("hidden");
            imagesBlockOriginal.classList.remove("hidden");
            imagesBlock.classList.add("hidden");
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
                url: "/carad/edit/<?=$data["id"]?>",
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