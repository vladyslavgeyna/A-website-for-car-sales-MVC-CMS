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

    public static function getAllCarModels(): ?array
    {
        $car_models = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_models))
        {
            return $car_models;
        }
        return null;
    }

    public static function getCarModelById($id)
    {
        $car_model = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($car_model))
        {
            return $car_model[0];
        }
        return null;
    }

}