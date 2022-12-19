<?php

namespace models;

use core\Core;

class Fuel
{
    protected static string $tableName = "fuel";

    public static function getAllFuels(): ?array
    {
        $fuels = Core::getInstance()->db->select(self::$tableName);
        if(!empty($fuels))
        {
            return $fuels;
        }
        return null;
    }
}