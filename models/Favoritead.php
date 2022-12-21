<?php

namespace models;

use core\Core;

class Favoritead
{
    protected static string $tableName = "favorite_ad";

    public static function hasCurrentUserFavoriteAdByCarAdId($car_ad_id): ?bool
    {
        if (User::isUserAuthenticated())
        {
            $user_id = User::getCurrentUserId();
            $favorite_ad = Core::getInstance()->db->select(self::$tableName, "*", [
                "car_ad_id" =>  $car_ad_id,
                "user_id" => $user_id
            ]);
            return !empty($favorite_ad);
        }
        else
        {
            return null;
        }
    }

    public static function getCountOfFavoriteAdsByCarAdId($car_ad_id): int
    {
        $favorite_ads = Core::getInstance()->db->select(self::$tableName, "*", [
           "car_ad_id" => $car_ad_id
        ]);
        return count($favorite_ads);
    }

}