<?php

namespace models;

use core\Core;

class Message
{
    protected static string $tableName = "message";

    public static function addMessage($text, $user_id, $date_of_creating)
    {
        return Core::getInstance()->db->insert(self::$tableName, [
            "text" => $text,
            "user_id" => $user_id,
            "date_of_creating" => $date_of_creating,
        ]);
    }

    public static function deleteMessageById($id)
    {
        $messages = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if(!empty($messages))
        {
            $admin_messages = Adminmessage::getAdminMessagesByMessageId($id);
            if (!empty($admin_messages))
            {
                foreach ($admin_messages as $admin_message)
                {
                    Adminmessage::deleteAdminMessageById($admin_message["id"]);
                }
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

    public static function getMessagesByUserId($user_id): ?array
    {
        $m = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" =>  $user_id
        ]);
        if (!empty($m))
        {
            return $m;
        }
        else
        {
            return null;
        }
    }

    public static function getMessageById($id): ?array
    {
        $m = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if (!empty($m))
        {
            return $m[0];
        }
        else
        {
            return null;
        }
    }

    public static function getMessageByIdInnered($id): ?array
    {
        $m = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if (!empty($m))
        {
            $result = $m[0];
            $result["user"] = User::getUserById($m[0]["user_id"]);
            return $result;
        }
        else
        {
            return null;
        }
    }

}