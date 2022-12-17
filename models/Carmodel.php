<?php

namespace models;

use core\Core;

class Carmodel
{
    protected static string $tableName = "car_model";

    public static function addCarModel($name, $car_brand_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
            "car_brand_id" => $car_brand_id,
        ]);
    }

    public static function getCarModelsByCarBrandId($car_brand_id): ?array
    {
        $car_models = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_brand_id" =>  $car_brand_id,
        ]);
        if(!empty($car_models))
        {
            return $car_models;
        }
        return null;
    }
}