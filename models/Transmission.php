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
}