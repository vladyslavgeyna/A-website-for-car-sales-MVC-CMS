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
}