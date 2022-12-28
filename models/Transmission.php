<?php

namespace models;

use core\Core;

class Transmission
{
    protected static string $tableName = "transmission";

    public static function getAllTransmissions(): ?array
    {
        $transmissions = Core::getInstance()->db->select(self::$tableName);
        if(!empty($transmissions))
        {
            return $transmissions;
        }
        return null;
    }

    public static function getTransmissionById($id)
    {
        $transmission = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($transmission))
        {
            return $transmission[0];
        }
        return null;
    }

    public static function isTransmissionByNameExist($name): bool
    {
        $transmission = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        return !empty($transmission);
    }

    public static function addTransmission($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function isTransmissionByIdExist($id): bool
    {
        $transmission = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($transmission);
    }

    public static function updateTransmissionById($id, $newName)
    {
        $transmission = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($transmission))
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

    public static function deleteTransmissionById($id)
    {
        $transmission = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($transmission))
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