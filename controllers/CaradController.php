<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Utils;
use models\Car;
use models\Carad;
use models\Carbrand;
use models\Carimage;
use models\Carmodel;
use models\Fuel;
use models\Image;
use models\Region;
use models\Transmission;
use models\Typeofcurrency;
use models\User;
use models\Wheeldrive;

class CaradController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if (User::isUserAdmin())
        {
            $data["users_count"] = User::getCountOfUsers();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            $data = [];
            $data["ads"] = Carad::getAllCarAdsInnered();
            return $this->render(null, [
                "title" => "Оголошення",
                "data" => $data
            ]);
        }
    }

    public function addAction()
    {
//        echo "<pre>";
//        var_dump(Carad::getAllCarAdsInnered());
//        echo "</pre>";
//        die();
        if(!User::isUserAdmin())
        {
            if(!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }
            $data = [];
            $additional_options = null;
            $data["max_image_count"] = Carimage::MAX_IMAGE_COUNT;
            $data["car_brands"] = Carbrand::getAllCarBrands();
            $data["regions"] = Region::getAllRegions();
            $data["transmissions"] = Transmission::getAllTransmissions();
            $data["fuels"] = Fuel::getAllFuels();
            $data["wheel_drives"] = Wheeldrive::getAllWheelDrives();
            $data["types_of_currencies"] = Typeofcurrency::getAllTypesOfCurrencies();
//            todo тут треба буде асинзронним запитом отримати моделі, це поки тимчасово
            $data["car_models"] = Carmodel::getAllCarModels();
            if(Core::getInstance()->requestMethod === "POST")
            {
                $errors = [];
                if (!empty($_FILES["car_photos"]["error"][0]))
                {
                    $errors["car_photos_exist"] = "Ви не обрали фотографії";
                }
                if (count($_FILES["car_photos"]["name"]) > Carimage::MAX_IMAGE_COUNT)
                {
                    $errors["car_photos_count"] = "Ви обрали більше, ніж дозволено фотографій";
                }
                if (!empty($_FILES["car_photos"]["type"][0]))
                {
                    foreach ($_FILES["car_photos"]["type"] as $type)
                    {
                        if(!in_array($type, Image::ALLOWED_PHOTO_TYPES))
                        {
                            $errors['car_photos_type'] = "Обрано некоректний тип файлу. Дозволені типи: png та jpeg";
                            break;
                        }
                    }
                }
                if (empty($_POST["main_photo"]))
                {
                    $errors["main_photo"] = "Ви не обрали головне фото";
                }
                if (empty($_POST["car_brand"]) || $_POST["car_brand"] == -1 || !Utils::hasTheSameIdAsInArray($data["car_brands"], $_POST["car_brand"]) )
                {
                    $errors['car_brand'] = "Ви не обрали одну із запропонованих марок авто";
                }
                if (empty($_POST["car_model"]) || $_POST["car_model"] == -1 || !Utils::hasTheSameIdAsInArray($data["car_models"], $_POST["car_model"]) ) // тут мабуть теж требп змінити $data["car_models"]
                {
                    $errors['car_model'] = "Ви не обрали одну із запропонованих модель авто";
                }
                if (empty($_POST["car_year_of_production"]) || !is_numeric($_POST["car_year_of_production"]) || !Utils::isIntDigit($_POST["car_year_of_production"]) || $_POST["car_year_of_production"] == -1 || ($_POST["car_year_of_production"] > date("Y") ||  $_POST["car_year_of_production"] < 1900))
                {
                    $errors['car_year_of_production'] = "Ви не обрали один із запропонованих рік";
                }
                if ($_POST["car_mileage"] <= 0 || !is_numeric($_POST["car_mileage"]) || !Utils::isIntDigit($_POST["car_mileage"]))
                {
                    $errors['car_mileage'] = "Некоректно введений пробіг";
                }
                if (empty($_POST["car_region"]) || $_POST["car_region"] == -1 || !Utils::hasTheSameIdAsInArray($data["regions"], $_POST["car_region"]))
                {
                    $errors['car_region'] = "Ви не обрали одну із запропонованих область";
                }
                if (strlen($_POST["car_district"]) <= 2)
                {
                    $errors['car_district'] = "Некоректно введений район";
                }
                if (strlen($_POST["car_city"]) <= 2)
                {
                    $errors['car_city'] = "Некоректно введене місто (село, селище)";
                }
                if (empty($_POST["car_transmission"]) || $_POST["car_transmission"] == -1 || !Utils::hasTheSameIdAsInArray($data["transmissions"], $_POST["car_transmission"]))
                {
                    $errors['car_transmission'] = "Ви не обрали одну із запропонованих трансмісій";
                }
                if (empty($_POST["car_fuel"]) || $_POST["car_fuel"] == -1 || !Utils::hasTheSameIdAsInArray($data["fuels"], $_POST["car_fuel"]))
                {
                    $errors['car_fuel'] = "Ви не обрали один із запропонованих вид палива";
                }
                if (($_POST["car_fuel"] != 4 || Fuel::getFuelById($_POST["car_fuel"])["name"] != "Електро") && ($_POST["car_engine_capacity"] <= 0 || !is_numeric($_POST["car_engine_capacity"]) || substr( $_POST["car_engine_capacity"], 0, 1 ) === "."))
                {
                    $errors['car_engine_capacity'] = "Некоректно введений об'єм двигуна";
                }
                if (($_POST["car_fuel"] == 4 || Fuel::getFuelById($_POST["car_fuel"])["name"] == "Електро") && !empty($_POST["car_engine_capacity"]))
                {
                    $errors['car_engine_capacity'] = "Двигун не може мати об'єм, якщо вид палива - електро";
                }
                if (empty($_POST["car_wheel_drive"]) || $_POST["car_wheel_drive"] == -1 || !Utils::hasTheSameIdAsInArray($data["wheel_drives"], $_POST["car_wheel_drive"]))
                {
                    $errors['car_wheel_drive'] = "Ви не обрали один із запропонованих вид трансмісії";
                }
                if (strlen($_POST["car_color"]) <= 2)
                {
                    $errors['car_color'] = "Некоректно введений колір";
                }
                if (($_POST["car_number_of_seats"] <= 0 || $_POST["car_number_of_seats"] > 60) || !is_numeric($_POST["car_number_of_seats"]) || !Utils::isIntDigit($_POST["car_number_of_seats"]))
                {
                    $errors['car_number_of_seats'] = "Ви не обрали одну із запропонованих кількість місць";
                }
                if (strlen($_POST["car_additional_options"]) != 0 && strlen($_POST["car_additional_options"]) <= 6)
                {
                    $errors['car_additional_options'] = "Некоректно введено додаткові опції. Залиште поле порожнім, якщо воно не потрібне або вкажіть більше інформації";
                }
                if (strlen($_POST["car_additional_options"]) > 6)
                {
                    $additional_options = $_POST["car_additional_options"];
                }
                if (strlen($_POST["car_ad_title"]) < 6)
                {
                    $errors['car_ad_title'] = "Помилка при введенні заголовку. Введіть більше інформації";
                }
                if (strlen($_POST["car_ad_text"]) < 10)
                {
                    $errors['car_ad_text'] = "Помилка при введенні тексту. Введіть більше інформації";
                }
                if ($_POST["car_price"] <= 0 || !is_numeric($_POST["car_price"]) || substr( $_POST["car_price"], 0, 1 ) === ".")
                {
                    $errors['car_price'] = "Помилка при введенні ціни";
                }
                if (empty($_POST["car_type_of_currency"]) || $_POST["car_type_of_currency"] == -1 || !Utils::hasTheSameIdAsInArray($data["types_of_currencies"], $_POST["car_type_of_currency"]))
                {
                    $errors['car_type_of_currency'] = "Ви не обрали одну із запропонованих валюту";
                }
                if(count($errors) > 0)
                {

                    $auto_complete = $_POST;
                    return $this->render(null, [
                        "data" => $data,
                        "auto_complete" => $auto_complete,
                        "errors" => $errors
                    ]);
                }
                else
                {
                    if ($_POST["car_fuel"] == 4 || Fuel::getFuelById($_POST["car_fuel"])["name"] == "Електро")
                    {
                        $engine_capacity = 0;
                    }
                    else
                    {
                        $engine_capacity = $_POST["car_engine_capacity"];
                    }
                    $car_id = Car::addCar($_POST["car_brand"], $_POST["car_model"], $_POST["car_year_of_production"], $engine_capacity,
                        $_POST["car_fuel"], $_POST["car_transmission"], $_POST["car_color"], $_POST["car_region"], $_POST["car_district"],
                        $_POST["car_city"], $_POST["car_price"], $_POST["car_type_of_currency"], $_POST["car_wheel_drive"], $_POST["car_number_of_seats"],
                        $_POST["car_mileage"], $additional_options);

                    // todo додати перевірку як в Морозова, чи існує такий файл в циклі do while

                    Carad::addCarAd($car_id, $_POST["car_ad_title"], $_POST["car_ad_text"], date("Y-m-d H:i:s"), User::getCurrentUserId());
                    for ($i = 0; $i < count($_FILES["car_photos"]["name"]); $i++)
                    {
                        $extension = Utils::getFileExtension($_FILES["car_photos"]["name"][$i]);
                        $image_id = Image::addImage($_FILES["car_photos"]["tmp_name"][$i], $extension, "car");
                        if ($_POST["main_photo"] != $_FILES["car_photos"]["name"][$i])
                        {
                            Carimage::addCarImage($image_id, $car_id);
                        }
                        else
                        {
                            Carimage::addCarImage($image_id, $car_id, 1);
                        }
                    }
                    $_SESSION["success_car_ad_added"] = "Оголошення успішно додано";
                    return $this->render(null, [
                        "data" => $data
                    ]);
                }
            }
            else
            {
                return $this->render(null, [
                    "data" => $data
                ]);
            }
        }


        else
        {
            //тут якщо користувач адмін...
        }

    }
}