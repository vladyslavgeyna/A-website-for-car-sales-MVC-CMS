<?php

namespace models;

use core\Core;

class Wheeldrive
{
    protected static string $tableName = "wheel_drive";

    public static function getAllWheelDrives(): ?array
    {
        $wheel_drives = Core::getInstance()->db->select(self::$tableName);
        if(!empty($wheel_drives))
        {
            return $wheel_drives;
        }
        return null;
    }

    public static function getWheelDriveById($id)
    {
        $wheel_drive = Core::getInstance()->db->select(self::$tableName, "*", [
           "id" =>  $id
        ]);
        if(!empty($wheel_drive))
        {
            return $wheel_drive[0];
        }
        return null;
    }

    public static function isWheeldriveByNameExist($name): bool
    {
        $wheel_drive = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        return !empty($wheel_drive);
    }

    public static function addWheeldrive($name)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
        ]);
    }

    public static function isWheeldriveByIdExist($id): bool
    {
        $wheel_drive = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($wheel_drive);
    }

    public static function updateWheeldriveById($id, $newName)
    {
        $wheel_drive = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($wheel_drive))
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

    public static function deleteWheeldriveById($id)
    {
        $wheel_drive = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($wheel_drive))
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