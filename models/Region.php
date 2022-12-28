<?php

namespace models;

use core\Core;

class Region
{
    protected static string $tableName = "region";

    public static function getAllRegions(): ?array
    {
        $regions = Core::getInstance()->db->select(self::$tableName);
        if(!empty($regions))
        {
            return $regions;
        }
        return null;
    }

    public static function getRegionById($id)
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($region))
        {
            return $region[0];
        }
        return null;
    }

    public static function isRegionByNameExist($name): bool
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        return !empty($region);
    }

    public static function addRegion($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function isRegionByIdExist($id): bool
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($region);
    }

    public static function updateRegionById($id, $newName)
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($region))
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

    public static function deleteRegionById($id)
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($region))
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
}