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
        do
        {
            $name = uniqid();
            $fileName = $name.".".$imageExtension;
            $fullPath = "files/{$module}/".$fileName;
        } while(file_exists($fullPath));
        self::compressImage($path, $fullPath, 40);
        //move_uploaded_file($path, $fullPath);
        return Core::getInstance()->db->insert(self::$tableName, [
            "name" => $fileName
        ]);
    }

    public static function updateImageById($id, $path, $imageExtension, $moduleName = null)
    {
        $image = self::getImageById($id);
        if (!empty($image))
        {
            self::deleteImageById($id);
            return self::addImage($path, $imageExtension, $moduleName);
        }
        else
        {
            return null;
        }
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

    public static function deleteImageById($id, $moduleName = null)
    {
        if(empty($moduleName))
        {
            $module = Core::getInstance()->app["moduleName"];
        }
        else
        {
            $module = $moduleName;
        }
        $image = self::getImageById($id);
        if (!empty($image))
        {
            $image_path = "files/{$module}/".$image["name"];
            if (is_file($image_path))
            {
                unlink($image_path);
            }
            Core::getInstance()->db->delete(self::$tableName, [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    protected static function compressImage($input_image, $output_image, $quality)
    {
        $info = getimagesize($input_image);
        if ($info["mime"] == "image/jpeg")
        {
            $img = imagecreatefromjpeg($input_image);
            imagejpeg($img, $output_image, $quality);
        }
        else if ($info["mime"] == "image/png")
        {
            $img = imagecreatefrompng($input_image);
            imagejpeg($img, $output_image, $quality);
        }
    }

    public static function getImageNameById($id)
    {
        $image = Core::getInstance()->db->select(self::$tableName, "name", [
            "id" => $id
        ]);
        if (!empty($image))
        {
            return $image[0]["name"];
        }
        else
        {
            return null;
        }
    }


}