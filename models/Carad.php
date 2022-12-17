<?php

namespace models;

use core\Core;

class Carad
{
    protected static string $tableName = "car_ad";

    public static function addCarad($car_id, $title, $text, $date_of_creating, $user_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "car_id" => $car_id,
            "title" => $title,
            "text" => $text,
            "date_of_creating" => $date_of_creating,
            "user_id" => $user_id
        ]);
    }


}