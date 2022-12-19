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

}