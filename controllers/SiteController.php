<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Error;
use core\Pagination;
use core\Utils;
use models\Car;
use models\Carad;
use models\Carbrand;
use models\Carmodel;
use models\Region;
use models\User;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction($params)
    {
        if (User::isUserAdmin())
        {
            $data["users_count"] = User::getCountOfUsers();
            $data["car_ads_count"] = Carad::getCountOfCarAds();
            $data["cars_average_price"] = Car::getAverageUSDCarsPrice();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            if(Core::getInstance()->requestMethod === "POST")
            {
                if (isset($_POST["ajax"]))
                {
                    $car_models = Carmodel::getCarModelsByCarBrandId($_POST["car_brand_id"]);
                    exit(json_encode($car_models));
                }
                $car_model_id = null;
                $car_brand_id = null;
                $region_id = null;
                $year_from = null;
                $year_to = null;
                $price_from = null;
                $price_to = null;
                $orderBy = null;
                $get_link = "?";
                if (!empty($_POST["car_brand_id"]) && $_POST["car_brand_id"] != -1 && Carbrand::isCarBrandByIdExist($_POST["car_brand_id"]))
                {
                    $car_brand_id = $_POST["car_brand_id"];
                    $get_link .= "car_brand_id=".$car_brand_id ."&";
                }
                if (!empty($_POST["car_model_id"]) && $_POST["car_model_id"] != -1 && Carmodel::isCarModelByIdExist($_POST["car_model_id"]))
                {
                    $car_model_id = $_POST["car_model_id"];
                    $get_link .= "car_model_id=".$car_model_id ."&";
                }
                if (!empty($_POST["region_id"]) && $_POST["region_id"] != -1 && Region::isRegionByIdExist($_POST["region_id"]))
                {
                    $region_id = $_POST["region_id"];
                    $get_link .= "region_id=".$region_id ."&";
                }
                if (!empty($_POST["year_from"]) && $_POST["year_from"] != -1 && ($_POST["year_from"] >= 1900 && $_POST["year_from"] <= date("Y")))
                {
                    $year_from = $_POST["year_from"];
                    $get_link .= "year_from=".$year_from ."&";
                }
                if (!empty($_POST["year_to"]) && $_POST["year_to"] != -1 && ($_POST["year_to"] >= 1900 && $_POST["year_to"] <= date("Y")))
                {
                    if (!empty($year_from) && $_POST["year_to"] >= $year_from)
                    {
                        $year_to = $_POST["year_to"];
                        $get_link .= "year_to=".$year_to ."&";
                    }
                    else if (empty($year_from))
                    {
                        $year_to = $_POST["year_to"];
                        $get_link .= "year_to=".$year_to ."&";
                    }
                }
                if (!empty($_POST["price_from"]) && $_POST["price_from"] > 0)
                {
                    $price_from = $_POST["price_from"];
                    $get_link .= "price_from=".$price_from ."&";
                }
                if (!empty($_POST["price_to"]) && $_POST["price_to"] > 0)
                {
                    if (!empty($price_from) && $_POST["price_to"] >= $price_from)
                    {
                        $price_to = $_POST["price_to"];
                        $get_link .= "price_to=".$price_to ."&";
                    }
                    else if (empty($price_from))
                    {
                        $price_to = $_POST["price_to"];
                        $get_link .= "price_to=".$price_to ."&";
                    }
                }
                $allowed_order_by = ["default", "price-low-high", "price-high-low", "year-high-low", "year-low-high", "mileage-high-low", "mileage-low-low"];
                if (!empty($_POST["order_by"]) && in_array($_POST["order_by"], $allowed_order_by) && $_POST["order_by"] != "default")
                {
                    $orderBy = $_POST["order_by"];
                    $get_link .= "order_by=".$orderBy ."&";
                }
                if (strlen($get_link) == 1)
                {
                    $get_link = "";
                }
                else
                {
                    $get_link = mb_substr($get_link, 0, -1);
                }
                $this->redirect("/site/index{$get_link}");
            }
            else
            {
                $auto_complete = [];
                $whereArray = [];
                $orderByArray = [];
                $car_model_id = null;
                $car_brand_id = null;
                $region_id = null;
                $year_from = null;
                $year_to = null;
                $price_from = null;
                $price_to = null;
                if (isset($_GET["car_brand_id"]))
                {
                    $car_brand_id = $_GET["car_brand_id"];
                    $auto_complete["car_brand_id"] = $car_brand_id;
                    $auto_complete["car_models"] = Carmodel::getCarModelsByCarBrandId($car_brand_id);
                    $whereArray["car_brand_id"] = $car_brand_id;
                }
                if (isset($_GET["car_model_id"]))
                {
                    $car_model_id = $_GET["car_model_id"];
                    $auto_complete["car_model_id"] = $car_model_id;
                    $whereArray["car_model_id"] = $car_model_id;
                }
                if (isset($_GET["region_id"]))
                {
                    $region_id = $_GET["region_id"];
                    $auto_complete["region_id"] = $region_id;
                    $whereArray["region_id"] = $region_id;
                }
                if (isset($_GET["year_from"]))
                {
                    $year_from = $_GET["year_from"];
                    $auto_complete["year_from"] = $year_from;
                    $whereArray["year_of_production >="] = $year_from;
                }
                if (isset($_GET["year_to"]))
                {
                    $year_to = $_GET["year_to"];
                    $auto_complete["year_to"] = $year_to;
                    $whereArray["year_of_production <="] = $year_to;
                }
                if (isset($_GET["price_from"]))
                {
                    $price_from = $_GET["price_from"];
                    $auto_complete["price_from"] = $price_from;
                    $whereArray["dollar_price >="] = $price_from;
                }
                if (isset($_GET["price_to"]))
                {
                    $price_to = $_GET["price_to"];
                    $auto_complete["price_to"] = $price_to;
                    $whereArray["dollar_price <="] = $price_to;
                }
                if (isset($_GET["order_by"]))
                {
                    if ($_GET["order_by"] == "price-low-high")
                    {
                        $orderByArray["dollar_price"] = "ASC";
                    }
                    else if ($_GET["order_by"] == "price-high-low")
                    {
                        $orderByArray["dollar_price"] = "DESC";
                    }
                    else if ($_GET["order_by"] == "year-high-low")
                    {
                        $orderByArray["year_of_production"] = "ASC";
                    }
                    else if ($_GET["order_by"] == "year-low-high")
                    {
                        $orderByArray["year_of_production"] = "DESC";
                    }
                    else if ($_GET["order_by"] == "year-mileage-high-low")
                    {
                        $orderByArray["mileage"] = "ASC";
                    }
                    else if ($_GET["order_by"] == "mileage-low-low")
                    {
                        $orderByArray["mileage"] = "DESC";
                    }
                }
                if (count($whereArray) == 0)
                {
                    $whereArray = null;
                }
                if (count($orderByArray) == 0)
                {
                    $orderByArray = null;
                }
                $id = intval($params[0]);
                $url_prefix = "";
                $page = $id ?? 1;
                if ($page != 1)
                {
                    $url_prefix = "/site/index";
                }
                $per_page = 3;
                $total = Carad::getCountOfAllActiveCarAdsInnered($whereArray, " INNER JOIN car ON car_ad.id = car.id ");
                $pagination = new Pagination($page, $per_page, $total, $url_prefix);
                $start = $pagination->getStart();
                $data = [];
                $fieldsArray = ["car_ad.id", "car_ad.title", "car_ad.text", "wheel_drive.name as wheel_drive_name", "type_of_currency.sign as type_of_currency_sign",
                    "region.name as region_name", "transmission.name as transmission_name", "fuel.name as fuel_name", "car.mileage as mileage", "car.price as price",
                    "car.engine_capacity as engine_capacity", "car.id as car_id"];
                $innerJoin = "INNER JOIN car on car_ad.car_id = car.id INNER JOIN fuel on car.fuel_id = fuel.id INNER JOIN wheel_drive on car.wheel_drive_id = wheel_drive.id INNER JOIN type_of_currency on car.type_of_currency_id = type_of_currency.id INNER JOIN region on car.region_id = region.id INNER JOIN transmission on car.transmission_id = transmission.id ";
                $data["ads"] = Carad::getAllActiveCarAdsInneredByJoin($start, $per_page, $whereArray, $innerJoin, $fieldsArray, $orderByArray);

                $data["car_brands"] = Carbrand::getAllCarBrands();
                $data["regions"] = Region::getAllRegions();

                return $this->render("views/carad/index.php", [
                    "title" => "Головна сторінка",
                    "data" => $data,
                    "pagination" => $pagination,
                    "auto_complete" => $auto_complete,
                    "total_count_of_found_ads" => $total
                ]);
            }
        }
    }

    public function errorAction($code = null)
    {
        $view_error_404 = User::isUserAdmin() ? "views/admin/site/error-404.php" : "views/site/error-404.php";
        $viewPath = User::isUserAdmin() ? "views/admin/site/error-{$code}.php" : "views/site/error-{$code}.php";
        if(!empty($code))
        {
            if (in_array($code, Error::ALLOWED_ERRORS_TYPES))
            {
                return $this->render($viewPath);
            }
            else
            {
                return $this->render($view_error_404);
            }
        }
        else
        {
            return $this->render($view_error_404);
        }
    }
}