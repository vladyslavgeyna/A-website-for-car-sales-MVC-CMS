<?php

namespace models;

use core\Core;

class Car
{
    protected static string $tableName = "car";

    public static function addCar($car_brand_id, $car_model_id, $year_of_production, $engine_capacity, $fuel_id, $transmission_id, $color,
                                  $region_id, $district, $city, $price, $type_of_currency_id, $wheel_drive_id, $number_of_seats, $mileage, $additional_options)
    {
        return Core::getInstance()->db->insert(self::$tableName, [
            "car_brand_id" => $car_brand_id,
            "car_model_id" => $car_model_id,
            "year_of_production" => $year_of_production,
            "engine_capacity" => $engine_capacity,
            "fuel_id" => $fuel_id,
            "transmission_id" => $transmission_id,
            "color" => $color,
            "region_id" => $region_id,
            "district" => $district,
            "city" => $city,
            "price" => $price,
            "type_of_currency_id" => $type_of_currency_id,
            "wheel_drive_id" => $wheel_drive_id,
            "number_of_seats" => $number_of_seats,
            "mileage" => $mileage,
            "additional_options" => $additional_options
        ]);
    }

    public static function getAllCars(): ?array
    {
        $cars = Core::getInstance()->db->select(self::$tableName);
        if (!empty($cars))
        {
            return $cars;
        }
        return null;
    }

    public static function getCarById($id)
    {
        $car = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($car))
        {
            return $car[0];
        }
        return null;
    }

    public static function getCarByIdInnered($id)
    {
        $car = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if (!empty($car))
        {
            $result = $car[0];
            $result["images"] = Carimage::getAllCarImagesByCarIdInnered($car[0]["id"]);
            $result["main_image"] = Carimage::getMainCarImagesByCarIdInnered($car[0]["id"]);
            $result["car_brand"] = Carbrand::getCarBrandById($car[0]["car_brand_id"]);
            $result["car_model"] = Carmodel::getCarModelById($car[0]["car_model_id"]);
            $result["fuel"] = Fuel::getFuelById($car[0]["fuel_id"]);
            $result["transmission"] = Transmission::getTransmissionById($car[0]["transmission_id"]);
            $result["region"] = Region::getRegionById($car[0]["region_id"]);
            $result["type_of_currency"] = Typeofcurrency::getTypeOfCurrencyById($car[0]["type_of_currency_id"]);
            $result["wheel_drive"] = Wheeldrive::getWheelDriveById($car[0]["wheel_drive_id"]);
            return $result;
        }
        return null;
    }

    public static function getAllCarsInnered(): ?array
    {
        $cars = Core::getInstance()->db->select(self::$tableName);
        if (!empty($cars))
        {
            $result = $cars;
            for ($i = 0; $i < count($cars); $i++)
            {
                $result[$i]["car_brand"] = Carbrand::getCarBrandById($cars[$i]["car_brand_id"]);
                $result[$i]["car_model"] = Carmodel::getCarModelById($cars[$i]["car_model_id"]);
                $result[$i]["fuel"] = Fuel::getFuelById($cars[$i]["fuel_id"]);
                $result[$i]["transmission"] = Transmission::getTransmissionById($cars[$i]["transmission_id"]);
                $result[$i]["region"] = Region::getRegionById($cars[$i]["region_id"]);
                $result[$i]["type_of_currency"] = Typeofcurrency::getTypeOfCurrencyById($cars[$i]["type_of_currency_id"]);
                $result[$i]["wheel_drive"] = Wheeldrive::getWheelDriveById($cars[$i]["wheel_drive_id"]);
            }
            return $result;
        }
        return null;
    }
}