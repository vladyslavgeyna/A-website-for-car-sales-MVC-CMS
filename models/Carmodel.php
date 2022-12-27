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

    public static function isCarModelByNameAndCarBrandIdExist($name, $car_brand_id): bool
    {
        $car_model = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_brand_id" =>  $car_brand_id,
            "name" => $name
        ]);
        return !empty($car_model);
    }

    public static function isCarModelByIdExist($id): bool
    {
        $car_model = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        return !empty($car_model);
    }

    public static function deleteCarModelById($id) //todo тут мабуть треба щось буде з оголошеннями придумати якщо буде модель видалятись
    {
        $car_model = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($car_model))
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

    public static function updateCarModelById($id, $newName, $newCarBrandId)
    {
        $car_model = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($car_model))
        {
            Core::getInstance()->db->update(self::$tableName, [
                "name" => $newName,
                "car_brand_id" => $newCarBrandId
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