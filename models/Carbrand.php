<?php

namespace models;

use core\Core;

class Carbrand
{
    protected static string $tableName = "car_brand";

    public static function addCarbrand($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function getCarbrandById($id)
    {
        $car_brand = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id,
        ]);
        if(!empty($car_brand))
        {
            return $car_brand[0];
        }
        return null;
    }

    public static function getAllCarBrands(): ?array
    {
        $car_brands = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_brands))
        {
            return $car_brands;
        }
        return null;
    }


}