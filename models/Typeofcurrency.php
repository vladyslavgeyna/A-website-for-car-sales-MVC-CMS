<?php

namespace models;

use core\Core;

class Typeofcurrency
{
    protected static string $tableName = "type_of_currency";

    public static function getAllTypesOfCurrencies(): ?array
    {
        $types_of_currencies = Core::getInstance()->db->select(self::$tableName);
        if(!empty($types_of_currencies))
        {
            return $types_of_currencies;
        }
        return null;
    }

    public static function getTypeOfCurrencyById($id)
    {
        $type_of_currency = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if(!empty($type_of_currency))
        {
            return $type_of_currency[0];
        }
        return null;
    }
}