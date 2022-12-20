<?php

namespace models;

use core\Core;

class Carimage
{
    protected static string $tableName = "car_image";

    public const MAX_IMAGE_COUNT = 5;

    public static function addCarImage($image_id, $car_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "image_id" => $image_id,
            "car_id" => $car_id,
        ]);
    }
}