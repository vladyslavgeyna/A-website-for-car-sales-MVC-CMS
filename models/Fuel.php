<?php

namespace models;

use core\Core;

class Fuel
{
    protected static string $tableName = "fuel";

    public static function addFuel($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function getAllFuels(): ?array
    {
        $fuels = Core::getInstance()->db->select(self::$tableName);
        if(!empty($fuels))
        {
            return $fuels;
        }
        return null;
    }

    public static function getFuelById($id)
    {
        $fuel = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($fuel))
        {
            return $fuel[0];
        }
        return null;
    }

    public static function isFuelByNameExist($name): bool
    {
        $fuel = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        return !empty($fuel);
    }

    public static function isFuelByIdExist($id): bool
    {
        $fuel = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($fuel);
    }

    public static function deleteFuelById($id)
    {
        $fuel = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($fuel))
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

    public static function updateFuelById($id, $newName)
    {
        $fuel = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($fuel))
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