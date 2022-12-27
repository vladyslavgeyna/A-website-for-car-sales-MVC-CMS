<?php

namespace models;

use core\Core;

class Carbrand
{
    protected static string $tableName = "car_brand";

    public static function addCarBrand($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function isCarBrandByNameExist($name): bool
    {
        $car_brand = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        return !empty($car_brand);
    }

    public static function isCarBrandByIdExist($id): bool
    {
        $car_brand = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($car_brand);
    }

    public static function getCarBrandById($id)
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

    public static function deleteCarBrandById($id) //todo тут мабуть треба щось буде з оголошеннями і моделями придумати якщо буде марку видалятись
    {
        $car_brand = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($car_brand))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function updateCarBrandById($id, $newName)
    {
        $car_brand = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($car_brand))
        {
            Core::getInstance()->db->update(self::$tableName, [
                "name" => $newName
            ], [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

}