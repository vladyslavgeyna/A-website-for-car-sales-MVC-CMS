<?php
/** @var array $errors */
/** @var array $data */
/** @var array $auto_complete */
use core\Core;

Core::getInstance()->pageParams['title'] = 'Додавання оголошення';

?>
<main class="main main-carad-add">
    <div class="container container-carad-add">
        <h1 class="mb-3">Додавання оголошення</h1>
        <form action="" method="post">
            <div class="h4 fw-bold">Додайте фото Вашого автомобіля:</div>
            <div class="input-group input-file mb-3">
                <label for="exampleInputPhotos" class="form-label">Оберіть фотографії (максимальна кількість фотографій: <?=$data["max_image_count"]?>)</label>
                <div>
                    <input required accept="image/jpeg, image/png" multiple type="file" name="car_photos[]" class="form-control" id="exampleInputPhotos">
                </div>
                <div class="error-form-validation hidden">
                    <span>Ви обрали занадто багато файлів</span>
                </div>
                <div style="gap: 10px;" class="images images-block d-flex justify-content-start mt-2 hidden"></div>
            </div>
            <div class="h4 fw-bold">Основна інформація:</div>
            <div class="mb-3">
                <label for="inputCarBrand" class="form-label">Марка автомобіля:</label>
                <select name="car_brand" required class="form-select" id="inputCarBrand" >
                    <option disabled selected >Оберіть марку</option>
                    <?php foreach ($data["car_brands"] as $item) : ?>
                        <?php if ($auto_complete["car_brand"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputCarModel" class="form-label">Модель автомобіля:</label>
                <select name="car_model" required class="form-select" id="inputCarModel" >
                    <option disabled selected >Оберіть модель</option>
                    <?php foreach ($data["car_models"] as $item) : ?>
                        <?php if ($auto_complete["car_model"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputCarYearOfProduction" class="form-label">Рік випуску автомобіля:</label>
                <select name="car_year_of_production" required class="form-select" id="inputCarYearOfProduction" >
                    <option disabled selected >Оберіть рік</option>
                    <?php for ($i = date("Y"); $i >= 1900; $i--) : ?>
                        <?php if ($auto_complete["car_year_of_production"] == $i ) : ?>
                            <option selected value="<?=$i?>"><?=$i?></option>
                        <?php else : ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputMileage" class="form-label">Пробіг (тисяч кілометрів):</label>
                <input name="car_mileage" type="text" class="form-control" placeholder="Наприклад: 220" id="inputMileage" >
                <div class="error-form-validation hidden">
                    <span>Ви помилилися при вибору пробігу</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputRegion" class="form-label">Область:</label>
                <select name="car_region" required class="form-select" id="inputRegion" >
                    <option disabled selected >Оберіть область</option>
                    <?php foreach ($data["regions"] as $item) : ?>
                        <?php if ($auto_complete["car_region"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputDistrict" class="form-label">Район:</label>
                <input name="car_district" type="text" placeholder="Наприклад: Бердичівський" class="form-control" id="inputDistrict" >
            </div>
            <div class="mb-3">
                <label for="inputCity" class="form-label">Місто (село, селище):</label>
                <input name="car_district" type="text" placeholder="Наприклад: Семенівка" class="form-control" id="inputCity" >
            </div>
            <div class="h4 fw-bold">Характеристики авто:</div>
            <div class="mb-3">
                <label for="inputRegion" class="form-label">Коробка передач:</label>
                <select name="car_transmission" required class="form-select" id="inputRegion" >
                    <option disabled selected >Оберіть коробку передач</option>
                    <?php foreach ($data["transmissions"] as $item) : ?>
                        <?php if ($auto_complete["car_transmission"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputFuel" class="form-label">Паливо:</label>
                <select name="car_fuel" required class="form-select" id="inputFuel" >
                    <option disabled selected >Оберіть паливо</option>
                    <?php foreach ($data["fuels"] as $item) : ?>
                        <?php if ($auto_complete["car_fuel"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputWheelDrive" class="form-label">Привід:</label>
                <select name="car_wheel_drive" required class="form-select" id="inputWheelDrive" >
                    <option disabled selected >Оберіть привід</option>
                    <?php foreach ($data["wheel_drives"] as $item) : ?>
                        <?php if ($auto_complete["car_wheel_drive"] == $item["name"]) : ?>
                            <option selected value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php else : ?>
                            <option value="<?=$item["name"]?>"><?=$item["name"]?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputEngineCapacity" class="form-label">Об'єм двигуна (в літрах):</label>
                <input name="car_engine_capacity" type="text" class="form-control" placeholder="Наприклад: 2.2" id="inputEngineCapacity" >
                <div class="error-form-validation hidden">
                    <span>Ви помилилися при вибору об'єму двигуна</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputColor" class="form-label">Колір:</label>
                <input name="car_color" type="text" class="form-control" placeholder="Наприклад: Червоний" id="inputColor" >
            </div>
            <div class="mb-3">
                <label for="inputCarNumberOfSeats" class="form-label">Кількість місць:</label>
                <select name="car_number_of_seats" required class="form-select" id="inputCarNumberOfSeats" >
                    <option disabled selected >Оберіть кількість місць</option>
                    <?php for ($i = 1; $i <= 60; $i++) : ?>
                        <?php if ($auto_complete["car_number_of_seats"] == $i ) : ?>
                            <option selected value="<?=$i?>"><?=$i?></option>
                        <?php else : ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>
            <button id="btn-add-ad" type="submit" class="btn btn-primary">Розмістити оголошення</button>
        </form>
    </div>
</main>
<script defer>
    function isInt(value) {
        return !isNaN(value) && parseInt(Number(value)) == value && !isNaN(parseInt(value, 10));
    }
    const MAX_ALLOWED_IMAGE_COUNT = 5;
    const inputFiles = document.getElementById("exampleInputPhotos");
    const buttonAddAd = document.getElementById("btn-add-ad");
    const imagesBlock = document.querySelector(".container-carad-add .images");
    const blockMessageErrorPhoto = document.querySelector(".container-carad-add .input-file .error-form-validation");
    const blockMessageErrorMileage = document.querySelector(".container-carad-add #inputMileage+.error-form-validation");
    const blockMessageErrorEngineCapacity = document.querySelector(".container-carad-add #inputEngineCapacity+.error-form-validation");
    const inputMileage = document.getElementById("inputMileage");
    const inputEngineCapacity = document.getElementById("inputEngineCapacity");
    inputEngineCapacity.addEventListener("input", () => {
        inputEngineCapacity.value = inputEngineCapacity.value.replace(/[^\d.]/g, '');
        if(isNaN(inputEngineCapacity.value) || parseInt(inputEngineCapacity.value) <= 0 ) {
            console.log("error");
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
                div.classList.add("selected_car_image_block");
                const image = document.createElement("img");
                image.classList.add("img-thumbnail");
                image.setAttribute("alt", "Зображення автомобіля");
                image.src = URL.createObjectURL(inputFiles.files[i]);
                div.appendChild(image);
                imagesBlock.appendChild(div);
            }
        }
    });
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
<!--<script  >-->
<!--    $("document").ready(function () {-->
<!--        let select = document.getElementById("select1");-->
<!--        select.addEventListener("change", () => {-->
<!--            $.ajax({-->
<!--                url: "/fetch/car_brand.php",-->
<!--                method: "post",-->
<!--                dataType: "html",-->
<!--                data: {"id": select.value},-->
<!--                success: function (data) {-->
<!--                    // let car_models = data;-->
<!--                    console.log(data);-->
<!--                }-->
<!--            });-->
<!--        })-->
<!--    });-->
<!--</script>-->
