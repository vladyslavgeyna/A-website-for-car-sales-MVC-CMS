<?php

namespace models;

use core\Core;

class Adminmessage
{
    protected static string $tableName = "admin_message";

    public static function addAdminMessage($message_id, $user_admin_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
           "message_id" => $message_id,
           "user_admin_id" => $user_admin_id
        ]);
    }

    public static function getAdminMessagesByMessageId($message_id): ?array
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
           "message_id" =>  $message_id
        ]);
        if (!empty($a_m))
        {
            return $a_m;
        }
        else
        {
            return null;
        }
    }

    public static function getAdminMessagesByUserAdminId($user_admin_id): ?array
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_admin_id" =>  $user_admin_id
        ]);
        if (!empty($a_m))
        {
            return $a_m;
        }
        else
        {
            return null;
        }
    }

    public static function getAdminMessageById($id)
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if (!empty($a_m))
        {
            return $a_m[0];
        }
        else
        {
            return null;
        }
    }

    public static function getAdminMessagesByUserAdminIdInnered($user_admin_id)
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_admin_id" =>  $user_admin_id
        ]);
        if (!empty($a_m))
        {
            $result = $a_m;
            for ($i = 0; $i < count($a_m); $i++)
            {
                $result[$i]["message"] = Message::getMessageByIdInnered($a_m[$i]["message_id"]);
            }
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function getCountOfAdminMessagesByMessageId($message_id)
    {
        return Core::getInstance()->db->count(self::$tableName, [
            "message_id" =>  $message_id
        ]);
    }

    public static function deleteAdminMessageById($id)
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if (!empty($a_m))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "id" =>  $id
            ]);
            if (self::getCountOfAdminMessagesByMessageId($a_m[0]["message_id"]) == 0)
            {
                Message::deleteMessageById($a_m[0]["message_id"]);
            }
        }
        else
        {
            return null;
        }
    }

    public static function isAdminMessageByIdExist($id): bool
    {
        $a_m = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        return !empty($a_m);
    }


}