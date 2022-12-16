<?php

namespace models;

use core\Utils;
use core\Core;

class Image
{
    protected static string $tableName = "image";

    public const ALLOWED_PHOTO_TYPES = ["image/jpeg", "image/png"];

    public static function addImage($path, $imageExtension)
    {
        $moduleName = Core::getInstance()->app["moduleName"];
        $name = uniqid();
        $fileName = $name.".".$imageExtension;
        $fullPath = "files/{$moduleName}/".$fileName;
        move_uploaded_file($path, $fullPath);
        return Core::getInstance()->db->insert(self::$tableName, [
            "name" => $fileName
        ]);
    }

}