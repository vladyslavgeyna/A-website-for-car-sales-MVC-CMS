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
            $data = [];
            $data["ads"] = Carad::getAllCarAds();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            $this->redirect("/");
        }
    }

    public function addAction()
    {
        if(!User::isUserAdmin())
        {
            if(!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }
            if (isset($_POST["ajax"]))
            {
                $car_models = Carmodel::getCarModelsByCarBrandId($_POST["car_brand_id"]);
                exit(json_encode($car_models));
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
            if(Core::getInstance()->requestMethod === "POST")
            {
                $car_models_from_ajax = Carmodel::getCarModelsByCarBrandId($_POST["car_brand"]);
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
                if (empty($_POST["main_photo"]) || !in_array($_POST["main_photo"], $_FILES["car_photos"]["name"]))
                {
                    $errors["main_photo"] = "Ви не обрали головне фото";
                }
                if (empty($_POST["car_brand"]) || $_POST["car_brand"] == -1 || !Utils::hasTheSameIdAsInArray($data["car_brands"], $_POST["car_brand"]) )
                {
                    $errors['car_brand'] = "Ви не обрали одну із запропонованих марок авто";
                }
                if (empty($_POST["car_model"]) || $_POST["car_model"] == -1 || !Utils::hasTheSameIdAsInArray($car_models_from_ajax, $_POST["car_model"]))
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
                if (mb_strlen($_POST["car_district"]) <= 2)
                {
                    $errors['car_district'] = "Некоректно введений район";
                }
                if (mb_strlen($_POST["car_city"]) <= 2)
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
                if ((Fuel::getFuelById($_POST["car_fuel"])["name"] != "Електро" || $_POST["car_fuel"] != 4) && ($_POST["car_engine_capacity"] <= 0 || !is_numeric($_POST["car_engine_capacity"]) || substr( $_POST["car_engine_capacity"], 0, 1 ) === "."))
                {
                    $errors['car_engine_capacity'] = "Некоректно введений об'єм двигуна";
                }
                if ((Fuel::getFuelById($_POST["car_fuel"])["name"] == "Електро" || $_POST["car_fuel"] == 4) && !empty($_POST["car_engine_capacity"]))
                {
                    $errors['car_engine_capacity'] = "Двигун не може мати об'єм, якщо вид палива - електро";
                }
                if (empty($_POST["car_wheel_drive"]) || $_POST["car_wheel_drive"] == -1 || !Utils::hasTheSameIdAsInArray($data["wheel_drives"], $_POST["car_wheel_drive"]))
                {
                    $errors['car_wheel_drive'] = "Ви не обрали один із запропонованих вид трансмісії";
                }
                if (mb_strlen($_POST["car_color"]) <= 2)
                {
                    $errors['car_color'] = "Некоректно введений колір";
                }
                if (($_POST["car_number_of_seats"] <= 0 || $_POST["car_number_of_seats"] > 60) || !is_numeric($_POST["car_number_of_seats"]) || !Utils::isIntDigit($_POST["car_number_of_seats"]))
                {
                    $errors['car_number_of_seats'] = "Ви не обрали одну із запропонованих кількість місць";
                }
                if (mb_strlen($_POST["car_additional_options"]) != 0 && mb_strlen($_POST["car_additional_options"]) <= 6)
                {
                    $errors['car_additional_options'] = "Некоректно введено додаткові опції. Залиште поле порожнім, якщо воно не потрібне або вкажіть більше інформації";
                }
                if (mb_strlen($_POST["car_additional_options"]) > 6)
                {
                    $additional_options = trim($_POST["car_additional_options"]);
                }
                if (mb_strlen($_POST["car_ad_title"]) < 6)
                {
                    $errors['car_ad_title'] = "Помилка при введенні заголовку. Введіть більше інформації";
                }
                if (mb_strlen($_POST["car_ad_text"]) < 10)
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
                    $auto_complete["car_models"] = Carmodel::getCarModelsByCarBrandId($auto_complete["car_brand"]);
                    return $this->render(null, [
                        "data" => $data,
                        "auto_complete" => $auto_complete,
                        "errors" => $errors
                    ]);
                }
                else
                {
                    if ( Fuel::getFuelById($_POST["car_fuel"])["name"] == "Електро" || $_POST["car_fuel"] == 4)
                    {
                        $engine_capacity = 0;
                    }
                    else
                    {
                        $engine_capacity = trim($_POST["car_engine_capacity"]);
                    }
                    $dollar_price = trim($_POST["car_price"]);
                    if ($_POST["car_type_of_currency"] == 2)
                    {
                        $dollar_price = trim($_POST["car_price"]) / Utils::getCurrentEURToUSD();
                    }
                    else if ($_POST["car_type_of_currency"] == 3)
                    {
                        $dollar_price = trim($_POST["car_price"]) / Utils::getCurrentUSDToUAH();
                    }
                    $car_id = Car::addCar($_POST["car_brand"], $_POST["car_model"], $_POST["car_year_of_production"], $engine_capacity,
                        $_POST["car_fuel"], $_POST["car_transmission"], trim($_POST["car_color"]), $_POST["car_region"], trim($_POST["car_district"]),
                        trim($_POST["car_city"]), trim($_POST["car_price"]), $_POST["car_type_of_currency"], $_POST["car_wheel_drive"], $_POST["car_number_of_seats"],
                        $_POST["car_mileage"], $additional_options, $dollar_price);

                    Carad::addCarAd($car_id, trim($_POST["car_ad_title"]), nl2br($_POST["car_ad_text"]), date("Y-m-d H:i:s"), User::getCurrentUserId());
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
                    $this->redirect("/carad/add");
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
            return "sdfsdf";
            //тут якщо користувач адмін...
        }

    }

    public function myadsAction()
    {
        if(!User::isUserAdmin())
        {
            if (!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }
            $data = [];
            $current_user_id = User::getCurrentUserId();
            $data["user_ads"] = Carad::getAllCarAdsByUserIdInnered($current_user_id);
            $data["user_ads_count"] = Carad::getCountOfCarAdsByUserId($current_user_id);
            return $this->render(null, [
                "data" => $data
            ]);
        }
        else
        {
            return $this->error(404);
        }
    }

    public function deactivateAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        $car_ad = Carad::getCarAdById($id);
        if (User::getCurrentUserId() != $car_ad["user_id"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        Carad::deactivateCarAdById($id);
        if (!User::isUserAdmin())
        {
            $_SESSION["success_car_ad_deactivated"] = "Оголошення успішно деактивовано";
            $this->redirect("/carad/myads");
        }
        else
        {
            $_SESSION["success_car_ad_activated"] = "Оголошення #{$id} успішно деактивовано";
            $this->redirect("/carad");
        }

    }

    public function activateAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        $car_ad = Carad::getCarAdById($id);
        if (User::getCurrentUserId() != $car_ad["user_id"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        Carad::activateCarAdById($id);
        if (!User::isUserAdmin())
        {
            $_SESSION["success_car_ad_activated"] = "Оголошення успішно активовано";
            $this->redirect("/carad/myads");
        }
        else
        {
            $_SESSION["success_car_ad_activated"] = "Оголошення #{$id} успішно активовано";
            $this->redirect("/carad");
        }
    }

    public function viewAction($params)
    {
        if(!User::isUserAdmin())
        {
            $id = intval($params[0]);
            $car_ad_id = $id;
            if (!Carad::isCarAdByIdExist($car_ad_id))
            {
                return $this->error(404);
            }
            $data = [];
            $data["ad"] = Carad::getCarAdByIdInnered($car_ad_id);
            if (User::isUserAuthenticated() && User::getCurrentUserId() != $data["ad"]["user_id"] && $data["ad"]["is_active"] != 1)
            {
                return $this->error(403);
            }
            else
            {
                if (User::isUserAuthenticated() && User::getCurrentUserId() == $data["ad"]["user_id"] && $data["ad"]["is_active"] != 1)
                {
                    $data["owner_message"] = "(Оголошення не активне. Інші користувачі його не побачать.)";
                }
                return $this->render(null, [
                    "data" => $data
                ]);
            }
        }
        else
        {
            return $this->error(404);
        }
    }

    public function deleteAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        $car_ad = Carad::getCarAdById($id);
        if (User::getCurrentUserId() != $car_ad["user_id"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        Carad::deleteCarAdById($id);
        if (!User::isUserAdmin())
        {
            $_SESSION["success_car_ad_deleted"] = "Оголошення успішно видалено";
            $this->redirect("/carad/myads");
        }
        else
        {
            $_SESSION["success_car_ad_deleted"] = "Оголошення #{$id} успішно видалено";
            $this->redirect("/carad");
        }
    }

    public function editAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        if (isset($_POST["ajax"]))
        {
            $car_models = Carmodel::getCarModelsByCarBrandId($_POST["car_brand_id"]);
            exit(json_encode($car_models));
        }
        $data = Carad::getCarAdById($id);
        $tmp_car = Car::getCarById($data["car_id"]);
        foreach ($tmp_car as $key => $item)
        {
            if ($key == "id")
            {
                $data["car_id"]= $item;
            }
            else
            {
                $data[$key]= $item;
            }
        }
        $is_anything_changed = false;
        $is_photos_changed = false;
        $additional_options = null;
        $complete_select = [];
        $complete_select["max_image_count"] = Carimage::MAX_IMAGE_COUNT;
        $complete_select["car_brands"] = Carbrand::getAllCarBrands();
        $complete_select["regions"] = Region::getAllRegions();
        $complete_select["transmissions"] = Transmission::getAllTransmissions();
        $complete_select["fuels"] = Fuel::getAllFuels();
        $complete_select["wheel_drives"] = Wheeldrive::getAllWheelDrives();
        $complete_select["types_of_currencies"] = Typeofcurrency::getAllTypesOfCurrencies();
        $complete_select["car_models"] = Carmodel::getCarModelsByCarBrandId($data["car_brand_id"]);
        $complete_select["images"] = Carimage::getAllCarImagesByCarIdInnered($data["id"]);
        $img_names = [];
        $new_main_image_id = null;
        foreach ($complete_select["images"] as $image)
        {
            $img_names []= $image["name"];
            if ($image["is_main"] == 1)
            {
                $new_main_image_id = $image["image_id"];
            }
        }
        if (User::getCurrentUserId() != $data["user_id"] && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_FILES["car_photos"]["error"][0]))
            {
                $is_photos_changed = true;
                $is_anything_changed = true;
            }
            if ($is_photos_changed)
            {
                if (empty($_FILES["car_photos"]["error"][0]) && count($_FILES["car_photos"]["name"]) > Carimage::MAX_IMAGE_COUNT)
                {
                    $errors["car_photos_count"] = "Ви обрали більше, ніж дозволено фотографій";
                }
            }
            if ($is_photos_changed)
            {
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
            }
            if ($is_photos_changed)
            {
                if (empty($_POST["main_photo"]) || !in_array($_POST["main_photo"], $_FILES["car_photos"]["name"]))
                {
                    $errors["main_photo"] = "Ви не обрали головне фото";
                }
            }
            if (!$is_photos_changed && !empty($_POST["main_photo"]) && in_array($_POST["main_photo"], $img_names) && Image::getImageById($new_main_image_id)["name"] != $_POST["main_photo"])
            {
                $is_anything_changed = true;
                foreach ($complete_select["images"] as $image)
                {
                    $image_name = Image::getImageById($image["image_id"])["name"];
                    if ($image_name == $_POST["main_photo"])
                    {
                        $new_main_image_id = $image["image_id"];
                        break;
                    }
                }
            }
            if (empty($_POST["car_brand_id"]) || $_POST["car_brand_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["car_brands"], $_POST["car_brand_id"]) )
            {
                $errors['car_brand_id'] = "Ви не обрали одну із запропонованих марок авто";
            }
            if (empty($_POST["car_model_id"]) || $_POST["car_model_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["car_models"], $_POST["car_model_id"]))
            {
                $errors['car_model_id'] = "Ви не обрали одну із запропонованих модель авто";
            }
            if (empty($_POST["year_of_production"]) || !is_numeric($_POST["year_of_production"]) || !Utils::isIntDigit($_POST["year_of_production"]) || $_POST["year_of_production"] == -1 || ($_POST["year_of_production"] > date("Y") ||  $_POST["year_of_production"] < 1900))
            {
                $errors['year_of_production'] = "Ви не обрали один із запропонованих рік";
            }
            if ($_POST["mileage"] <= 0 || !is_numeric($_POST["mileage"]) || !Utils::isIntDigit($_POST["mileage"]))
            {
                $errors['mileage'] = "Некоректно введений пробіг";
            }
            if (empty($_POST["region_id"]) || $_POST["region_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["regions"], $_POST["region_id"]))
            {
                $errors['region_id'] = "Ви не обрали одну із запропонованих область";
            }
            if (mb_strlen($_POST["district"]) <= 2)
            {
                $errors['district'] = "Некоректно введений район";
            }
            if (mb_strlen($_POST["city"]) <= 2)
            {
                $errors['city'] = "Некоректно введене місто (село, селище)";
            }
            if (empty($_POST["transmission_id"]) || $_POST["transmission_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["transmissions"], $_POST["transmission_id"]))
            {
                $errors['transmission_id'] = "Ви не обрали одну із запропонованих трансмісій";
            }
            if (empty($_POST["fuel_id"]) || $_POST["fuel_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["fuels"], $_POST["fuel_id"]))
            {
                $errors['fuel_id'] = "Ви не обрали один із запропонованих вид палива";
            }
            if ((Fuel::getFuelById($_POST["fuel_id"])["name"] != "Електро" || $_POST["fuel_id"] != 4) && ($_POST["engine_capacity"] <= 0 || !is_numeric($_POST["engine_capacity"]) || substr( $_POST["engine_capacity"], 0, 1 ) === "."))
            {
                $errors['engine_capacity'] = "Некоректно введений об'єм двигуна";
            }
            if ((Fuel::getFuelById($_POST["fuel_id"])["name"] == "Електро" || $_POST["fuel_id"] == 4) && !empty($_POST["engine_capacity"]))
            {
                $errors['engine_capacity'] = "Двигун не може мати об'єм, якщо вид палива - електро";
            }
            if (empty($_POST["wheel_drive_id"]) || $_POST["wheel_drive_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["wheel_drives"], $_POST["wheel_drive_id"]))
            {
                $errors['wheel_drive_id'] = "Ви не обрали один із запропонованих вид трансмісії";
            }
            if (mb_strlen($_POST["color"]) <= 2)
            {
                $errors['color'] = "Некоректно введений колір";
            }
            if (($_POST["number_of_seats"] <= 0 || $_POST["number_of_seats"] > 60) || !is_numeric($_POST["number_of_seats"]) || !Utils::isIntDigit($_POST["number_of_seats"]))
            {
                $errors['number_of_seats'] = "Ви не обрали одну із запропонованих кількість місць";
            }
            if (mb_strlen($_POST["additional_options"]) != 0 && mb_strlen($_POST["additional_options"]) <= 6)
            {
                $errors['additional_options'] = "Некоректно введено додаткові опції. Залиште поле порожнім, якщо воно не потрібне або вкажіть більше інформації";
            }
            if (mb_strlen($_POST["additional_options"]) > 6)
            {
                $additional_options = trim(nl2br($_POST["additional_options"]));
            }
            if (mb_strlen($_POST["title"]) < 6)
            {
                $errors['title'] = "Помилка при введенні заголовку. Введіть більше інформації";
            }
            if (mb_strlen($_POST["text"]) < 10)
            {
                $errors['text'] = "Помилка при введенні тексту. Введіть більше інформації";
            }
            if ($_POST["price"] <= 0 || !is_numeric($_POST["price"]) || substr( $_POST["price"], 0, 1 ) === ".")
            {
                $errors['price'] = "Помилка при введенні ціни";
            }
            if (empty($_POST["type_of_currency_id"]) || $_POST["type_of_currency_id"] == -1 || !Utils::hasTheSameIdAsInArray($complete_select["types_of_currencies"], $_POST["type_of_currency_id"]))
            {
                $errors['type_of_currency_id'] = "Ви не обрали одну із запропонованих валюту";
            }
            $_POST["text"] = nl2br($_POST["text"]);
            $_POST["additional_options"] = nl2br($_POST["additional_options"]);
            if ($_POST["fuel_id"] == 4)
            {
                $_POST["engine_capacity"] = 0;
            }

            if (!$is_anything_changed)
            {
                $keys = array_keys($_POST);
                foreach ($keys as $key)
                {
                    if ($key == "main_photo")
                    {
                        continue;
                    }
                    else if($data[$key] != $_POST[$key])
                    {
                        $is_anything_changed = true;
                        break;
                    }
                }
            }
            if(count($errors) > 0)
            {
                $data = $_POST;
                if (!User::isUserAdmin())
                {
                    return $this->render(null, [
                        "data" => $data,
                        "errors" => $errors,
                        "complete_select" => $complete_select
                    ]);
                }
                else
                {
                    return $this->renderAdmin(null, [
                        "data" => $data,
                        "errors" => $errors,
                        "complete_select" => $complete_select
                    ]);
                }
            }
            else if(!$is_anything_changed)
            {
                $this->redirect("/carad/edit/{$id}");
            }
            else
            {
                if ( Fuel::getFuelById($_POST["fuel_id"])["name"] == "Електро" || $_POST["fuel_id"] == 4)
                {
                    $engine_capacity = 0;
                }
                else
                {
                    $engine_capacity = trim($_POST["engine_capacity"]);
                }
                $dollar_price = trim($_POST["price"]);
                if ($data["type_of_currency_id"] != $_POST["type_of_currency_id"])
                {
                    if ($_POST["type_of_currency_id"] == 2)
                    {
                        $dollar_price = trim($_POST["price"]) / Utils::getCurrentEURToUSD();
                    }
                    else if ($_POST["type_of_currency_id"] == 3)
                    {
                        $dollar_price = trim($_POST["price"]) / Utils::getCurrentUSDToUAH();
                    }
                }
                $updateCarArray = [
                    "car_brand_id" => $_POST["car_brand_id"],
                    "car_model_id" => $_POST["car_model_id"],
                    "year_of_production" => $_POST["year_of_production"],
                    "engine_capacity" => $engine_capacity,
                    "fuel_id" => $_POST["fuel_id"],
                    "transmission_id" => $_POST["transmission_id"],
                    "color" => trim($_POST["color"]),
                    "region_id" => $_POST["region_id"],
                    "district" => trim($_POST["district"]),
                    "city" => trim($_POST["city"]),
                    "price" => trim($_POST["price"]),
                    "type_of_currency_id" => $_POST["type_of_currency_id"],
                    "wheel_drive_id" => $_POST["wheel_drive_id"],
                    "number_of_seats" => $_POST["number_of_seats"],
                    "mileage" => trim($_POST["mileage"]),
                    "additional_options" => $additional_options,
                    "dollar_price" => $dollar_price
                ];
                Car::updateCarById($data["car_id"], $updateCarArray);
                $updateCarAdArray = [
                    "title" => trim($_POST["title"]),
                    "text" => trim($_POST["text"]),
                ];
                Carad::updateCarAdById($id, $updateCarAdArray);
                if ($is_photos_changed)
                {
                    $car_images = Carimage::getAllCarImagesByCarId($data["car_id"]);
                    if (!empty($car_images))
                    {
                        Carimage::deleteAllCarImagesByCarId($data["car_id"]);
                    }
                    for ($i = 0; $i < count($_FILES["car_photos"]["name"]); $i++)
                    {
                        $extension = Utils::getFileExtension($_FILES["car_photos"]["name"][$i]);
                        $image_id = Image::addImage($_FILES["car_photos"]["tmp_name"][$i], $extension, "car");
                        if ($_POST["main_photo"] != $_FILES["car_photos"]["name"][$i])
                        {
                            Carimage::addCarImage($image_id, $data["car_id"]);
                        }
                        else
                        {
                            Carimage::addCarImage($image_id, $data["car_id"], 1);
                        }
                    }
                }
                else
                {
                    $main_image = Carimage::getMainImageByCarId($data["car_id"]);
                    if ($main_image["image_id"] != $new_main_image_id)
                    {
                        Carimage::setAsNotMainCarImageById($main_image["id"]);
                        Carimage::setAsMainCarImageByImageId($new_main_image_id);
                    }
                }
                if (!User::isUserAdmin())
                {
                    $_SESSION["success_car_ad_edited"] = "Оголошення успішно відредаговано";
                    $this->redirect("/carad/myads");
                }
                else
                {
                    $_SESSION["success_car_ad_edited"] = "Оголошення #{$id} успішно відредаговано";
                    $this->redirect("/carad");
                }

            }
        }
        else
        {
            if (!User::isUserAdmin())
            {
                return $this->render(null, [
                    "data" => $data,
                    "complete_select" => $complete_select,
                ]);
            }
            else
            {
                return $this->renderAdmin(null, [
                    "data" => $data,
                    "complete_select" => $complete_select,
                ]);
            }
        }
    }

}