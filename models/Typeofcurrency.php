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

    public static function isTypeOfCurrencyByNameAbbreviationORSignExist($name, $abbreviation, $sign): bool
    {
        $type_of_currency1 = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        $type_of_currency2 = Core::getInstance()->db->select(self::$tableName, "*", [
            "abbreviation" => $abbreviation,
        ]);
        $type_of_currency3 = Core::getInstance()->db->select(self::$tableName, "*", [
            "sign" => $sign,
        ]);
        return !empty($type_of_currency1) || !empty($type_of_currency2) || !empty($type_of_currency3) ;
    }

    public static function isTypeOfCurrencyByNameAbbreviationANDSignExist($name, $abbreviation, $sign): bool
    {
        $type_of_currency1 = Core::getInstance()->db->select(self::$tableName, "*", [
            "name" => $name,
        ]);
        $type_of_currency2 = Core::getInstance()->db->select(self::$tableName, "*", [
            "abbreviation" => $abbreviation,
        ]);
        $type_of_currency3 = Core::getInstance()->db->select(self::$tableName, "*", [
            "sign" => $sign,
        ]);
        return !empty($type_of_currency1) && !empty($type_of_currency2) && !empty($type_of_currency3) ;
    }

    public static function addTypeOfCurrency($name, $abbreviation, $sign)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
            "abbreviation" => $abbreviation,
            "sign" => $sign
        ]);
    }

    public static function isTypeOfCurrencyByIdExist($id): bool
    {
        $type_of_currency = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        return !empty($type_of_currency);
    }

    public static function deleteTypeOfCurrencyById($id)
    {
        $type_of_currency = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($type_of_currency))
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

    public static function updateTypeOfCurrencyById($id, $newName, $newAbbreviation, $newSign)
    {
        $region = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($region))
        {
            Core::getInstance()->db->update(self::$tableName, [
                "name" => $newName,
                "abbreviation" => $newAbbreviation,
                "sign" => $newSign
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