<?php

namespace models;

use core\Core;

class Car
{
    protected static string $tableName = "car";

    public static function addCar($car_brand_id, $car_model_id, $year_of_production, $engine_capacity, $fuel_id, $transmission_id, $color,
                                  $region_id, $district, $city, $price, $wheel_drive_id, $number_of_seats, $mileage, $additional_options)
    {
        Core::getInstance()->db->insert(self::$tableName, [
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
            "wheel_drive_id" => $wheel_drive_id,
            "number_of_seats" => $number_of_seats,
            "mileage" => $mileage,
            "additional_options" => $additional_options
        ]);
    }
}