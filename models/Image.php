<?php

namespace models;

use core\Utils;
use core\Core;

class Image
{
    protected static string $tableName = "image";

    public const ALLOWED_PHOTO_TYPES = ["image/jpeg", "image/png"];

    public static function addImage($path, $imageExtension, $moduleName = null)
    {
        if(empty($moduleName))
        {
            $module = Core::getInstance()->app["moduleName"];
        }
        else
        {
            $module = $moduleName;
        }
        $name = uniqid();
        $fileName = $name.".".$imageExtension;
        $fullPath = "files/{$module}/".$fileName;
        move_uploaded_file($path, $fullPath);
        return Core::getInstance()->db->insert(self::$tableName, [
            "name" => $fileName
        ]);
    }

    public static function getImageById($id)
    {
        $image = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id,
        ]);
        if(!empty($image))
        {
            return $image[0];
        }
        return null;
    }

}