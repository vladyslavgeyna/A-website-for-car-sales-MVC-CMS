<?php

namespace models;

use core\Core;

class Carad
{
    protected static string $tableName = "car_ad";

    public static function addCarAd($car_id, $title, $text, $date_of_creating, $user_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "car_id" => $car_id,
            "title" => $title,
            "text" => $text,
            "date_of_creating" => $date_of_creating,
            "user_id" => $user_id
        ]);
    }

    public static function updateCarAdById($id, $updateArray)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($car_ad))
        {
            Core::getInstance()->db->update(self::$tableName, $updateArray, [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function getAllCarAds(): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_ads))
        {
            return $car_ads;
        }
        return null;
    }

    public static function getCarAdByCarId($car_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if(!empty($car_ad))
        {
            return $car_ad[0];
        }
        return null;
    }

    public static function getCarAdByCarIdInnered($car_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if(!empty($car_ad))
        {
            $result = $car_ad[0];
            $result["car"] = Car::getCarByIdInnered($car_ad[0]["car_id"]);
            return $result;
        }
        return null;
    }

    public static function getCarAdByIdInnered($car_ad_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $car_ad_id
        ]);
        if(!empty($car_ad))
        {
            $result = $car_ad[0];
            $result["car"] = Car::getCarByIdInnered($car_ad[0]["car_id"]);
            $result["user"] = User::getUserByIdInnered($car_ad[0]["user_id"]);
            return $result;
        }
        return null;
    }



    public static function getCarAdById($car_ad_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $car_ad_id
        ]);
        if(!empty($car_ad))
        {
            return $car_ad[0];
        }
        return null;
    }

    public static function getActiveCarAdById($car_ad_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $car_ad_id,
            "is_active" => 1
        ]);
        if(!empty($car_ad))
        {
            return $car_ad[0];
        }
        return null;
    }

    public static function isCarAdByIdExist($car_ad_id): bool
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $car_ad_id
        ]);
        return !empty($car_ad);
    }


    public static function getAllCarAdsInnered(): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_ads))
        {
            $result = $car_ads;
            for ($i = 0; $i < count($car_ads); $i++)
            {
                $result[$i]["car"] = Car::getCarByIdInnered($car_ads[$i]["car_id"]);
            }
            return $result;
        }
        return null;
    }

    public static function getCountOfCarAdsByUserId($user_id): ?int
    {
        return Core::getInstance()->db->count(self::$tableName, [
            "user_id" => $user_id
        ]);
    }

    public static function getAllCarAdsByUserIdInnered($user_id): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($car_ads))
        {
            $result = $car_ads;
            for ($i = 0; $i < count($car_ads); $i++)
            {
                $result[$i]["car"] = Car::getCarByIdInnered($car_ads[$i]["car_id"]);
            }
            return $result;
        }
        return null;
    }

    public static function getAllCarAdsByUserId($user_id): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($car_ads))
        {
            return $car_ads;
        }
        return null;
    }

    public static function getAllActiveCarAdsInnered($offset = null, $limit = null, $whereArray = null): ?array
    {
        $active_car_ads = Core::getInstance()->db->select(self::$tableName, "*", ["is_active" => 1], null, $limit, $offset);
        if(!empty($active_car_ads))
        {
            $tmp = $active_car_ads;
            for ($i = 0; $i < count($active_car_ads); $i++)
            {
                $car = Car::getCarByIdInnered($active_car_ads[$i]["car_id"], $whereArray);
                if (!empty($car))
                {
                    $tmp[$i]["car"] = $car;
                }
            }
            $result = [];
            for ($i = 0; $i < count($tmp); $i++)
            {
                if (!empty($tmp[$i]["car"]))
                {
                    $result[$i] = $tmp[$i];
                }
            }
            return $result;
        }
        return null;
    }

    public static function getAllActiveCarAdsInneredByJoin($offset = null, $limit = null, $whereArray = null, $innerJoin = null, $fieldsArray = "*", $orderBy = null): ?array
    {
        $whereArray["is_active"] = 1;
        $active_car_ads = Core::getInstance()->db->select(self::$tableName, $fieldsArray, $whereArray, $orderBy, $limit, $offset, $innerJoin);
        if(!empty($active_car_ads))
        {
            for ($i = 0; $i < count($active_car_ads); $i++)
            {
                $active_car_ads[$i]["main_image"] = Carimage::getMainCarImageNameByCarIdInnered($active_car_ads[$i]["car_id"]);
            }
            return $active_car_ads;
        }
        return null;
    }

    public static function getCountOfAllActiveCarAdsInnered($whereArray = null, $innerJoin = null)
    {
        $whereArray["is_active"] = 1;
        return Core::getInstance()->db->count(self::$tableName, $whereArray, $innerJoin);
    }

    public static function getCountOfCarAds($whereArray = null): int
    {
        return Core::getInstance()->db->count(self::$tableName, $whereArray);
    }

    public static function deactivateCarAdById($id)
    {
        Core::getInstance()->db->update(self::$tableName, [
            "is_active" => 0
        ], [
            "id" => $id
        ]);
    }

    public static function activateCarAdById($id)
    {
        Core::getInstance()->db->update(self::$tableName, [
            "is_active" => 1
        ], [
            "id" => $id
        ]);
    }

    public static function deleteCarAdById($id)
    {
        $car_ad = Carad::getCarAdById($id);
        if (!empty($car_ad))
        {
            $fav_ads = Favoritead::getAllFavoriteAdsByCarAdId($id);
            $car_comp = Carcomparison::getAllCarComparisonsByCarAdId($id);
            if (!empty($fav_ads))
            {
                Favoritead::deleteAllFavoriteAdsByCarAdId($id);
            }
            if (!empty($car_comp))
            {
                Carcomparison::deleteAllCarComparisonsByCarAdId($id);
            }
            Core::getInstance()->db->delete(self::$tableName, [
                "id" => $id
            ]);
            Car::deleteCarById($car_ad["car_id"]);
        }
        else
        {
            return null;
        }
    }


}