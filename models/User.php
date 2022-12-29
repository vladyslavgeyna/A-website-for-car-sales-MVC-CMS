<?php

namespace models;

use core\Core;
use core\Utils;

class User
{
    protected static string $tableName = "user";

    public static function deleteUserByIdImage($id)
    {
        if (!self::hasUserByIdImage($id))
        {
            return null;
        }
        else
        {
            $user = self::getUserById($id);
            $image_id = $user["image_id"];
            Core::getInstance()->db->update(self::$tableName, [
                "image_id" => null
            ], [
                "id" => $id
            ]);
            if (!empty($image_id))
            {
                Image::deleteImageById($image_id, "user");
            }
        }
    }

    public static function getAllAdminUsers(): ?array
    {
        $admins = Core::getInstance()->db->select(self::$tableName, "*", [
           "is_admin" => 1
        ]);
        if (!empty($admins))
        {
            return $admins;
        }
        return null;
    }

    public static function setUserByIdAsAdmin($id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if (!empty($user))
        {
            $messages = Message::getMessagesByUserId($id);
            if (!empty($messages))
            {
                foreach ($messages as $message)
                {
                    Message::deleteMessageById($message["id"]);
                }
            }
            Core::getInstance()->db->update(self::$tableName, [
                "is_admin" => 1
            ], [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function unsetUserByIdAsAdmin($id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if (!empty($user))
        {
            $admin_messages = Adminmessage::getAdminMessagesByUserAdminId($id);
            if (!empty($admin_messages))
            {
                foreach ($admin_messages as $admin_message)
                {
                    Adminmessage::deleteAdminMessageById($admin_message["id"]);
                }
            }
            Core::getInstance()->db->update(self::$tableName, [
                "is_admin" => 0
            ], [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function getAllUsers(): ?array
    {
        $users = Core::getInstance()->db->select(self::$tableName);
        if (!empty($users))
        {
            return $users;
        }
        return null;
    }

    public static function addUser($name, $surname, $lastname, $login, $password, $phone, $image_id = null)
    {
        return Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
            "surname" => $surname,
            "lastname" => $lastname,
            "login" => $login,
            "password" => $password,
            "phone" => $phone,
            "image_id" => $image_id
        ]);
    }

    public static function updateUser($id, $updateArray)
    {
        $updateArray = Utils::filterArray($updateArray, [
            "name", "surname", "lastname", "login", "phone", "image_id"
        ]);
        Core::getInstance()->db->update(self::$tableName, $updateArray, [
            "id" => $id
        ]);
    }

    public static function deleteUserById($id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        if (!empty($user))
        {
            $car_ads = Carad::getAllCarAdsByUserId($id);
            if (!empty($car_ads))
            {
                foreach ($car_ads as $ad)
                {
                    Carad::deleteCarAdById($ad["id"]);
                }
            }
            if ($user[0]["is_admin"] == 0)
            {
                $messages = Message::getMessagesByUserId($id);
                if (!empty($messages))
                {
                    foreach ($messages as $message)
                    {
                        Message::deleteMessageById($message["id"]);
                    }
                }
            }
            if ($user[0]["is_admin"] == 1)
            {
                $admin_messages = Adminmessage::getAdminMessagesByUserAdminId($id);
                if (!empty($admin_messages))
                {
                    foreach ($admin_messages as $admin_message)
                    {
                        Adminmessage::deleteAdminMessageById($admin_message["id"]);
                    }
                }
            }
            Core::getInstance()->db->delete(self::$tableName, [
                "id" => $id
            ]);
            $image_id = $user[0]["image_id"];
            if (!empty($image_id))
            {
                Image::deleteImageById($image_id, "user");
            }
        }
        else
        {
            return null;
        }
    }

    public static function isLoginExists($login): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
           "login" => $login
        ]);
        return !empty($user);
    }

    public static function isLoginExceptCurrentUserExists($login): ?bool
    {
        if (!self::isUserAuthenticated())
        {
            return null;
        }
        else
        {
            $user = Core::getInstance()->db->select(self::$tableName, "*", [
                "login" => $login
            ]);
            return !empty($user) && $user[0]["id"] != self::getCurrentUserId();
        }
    }

    public static function isUserByIdExist($id): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id
        ]);
        return !empty($user);
    }

    public static function hasCurrentUserImage(): ?bool
    {
        if(self::isUserAuthenticated())
        {
            $user = self::getCurrentAuthenticatedUser();
            return (!empty($user["image_id"]));
        }
        else
        {
            return null;
        }
    }

    public static function hasUserByIdImage($user_id): ?bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $user_id
        ]);
        if (!empty($user))
        {
            return !empty($user[0]["image_id"]);
        }
        else
        {
            return null;
        }
    }

    public static function getUserByIdImagePath($user_id): ?string
    {
        if(self::hasUserByIdImage($user_id))
        {
            $user = Core::getInstance()->db->select(self::$tableName, "*", [
               "id" => $user_id
            ]);
            $image_id = $user[0]["image_id"];
            $image = Image::getImageById($image_id);
            return "/files/user/".$image["name"];
        }
        else
        {
            return null;
        }
    }

    public static function getUserByIdInnered($user_id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
           "id" => $user_id
        ]);
        if (!empty($user))
        {
            $result = $user[0];
            $result["name"] = $user[0]["name"];
            $result["surname"] = $user[0]["surname"];
            $result["lastname"] = $user[0]["lastname"];
            $result["phone"] = $user[0]["phone"];
            $result["login"] = $user[0]["login"];
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function getUserById($user_id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $user_id
        ]);
        if (!empty($user))
        {
            return $user[0];
        }
        else
        {
            return null;
        }
    }

    public static function getCurrentUserImagePath(): ?string
    {
        if(self::hasCurrentUserImage())
        {
            $user = self::getCurrentAuthenticatedUser();
            $image_id = $user["image_id"];
            $image = Image::getImageById($image_id);
            return "/files/user/".$image["name"];
        }
        else
        {
            return null;
        }
    }

    public static function isPhoneExists($phone): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "phone" => $phone
        ]);
        return !empty($user);
    }

    public static function isPhoneExceptCurrentUserExists($phone): ?bool
    {
        if (!self::isUserAuthenticated())
        {
            return null;
        }
        else
        {
            $current_user = self::getCurrentAuthenticatedUser();
            $user = Core::getInstance()->db->select(self::$tableName, "*", [
                "phone" => $phone
            ]);
            return !empty($user) && $current_user["phone"] != $user[0]["phone"];
        }
    }


    public static function verifyUser($login, $password): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
           "login" =>  $login,
            "password" => $password
        ]);
        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "login" =>  $login,
            "password" => $password
        ]);
        if(!empty($user))
        {
            return $user[0];
        }
        return null;
    }

    public static function authenticateUser($user)
    {
        $_SESSION["user"] = $user;
    }


    public static function logoutUser()
    {
        unset($_SESSION["user"]);
    }

    public static function isUserAuthenticated(): bool
    {
        return isset($_SESSION["user"]);
    }

    public static function getCurrentAuthenticatedUser()
    {
        return $_SESSION["user"];
    }

    public static function isUserAdmin(): bool
    {
        if (self::isUserAuthenticated())
        {
            $user = self::getCurrentAuthenticatedUser();
            return $user["is_admin"] == 1;
        }
        else
        {
            return false;
        }
    }

    public static function getCountOfUsers(): int
    {
        return Core::getInstance()->db->count(self::$tableName);
    }

    public static function getCurrentUserFullName(): ?string
    {
        if(self::isUserAuthenticated())
        {
            $user = self::getCurrentAuthenticatedUser();
            return $user["name"]." ".$user["surname"];
        }
        else
        {
            return null;
        }
    }

    public static function getCurrentUserId()
    {
        if(self::isUserAuthenticated())
        {
            $user = self::getCurrentAuthenticatedUser();
            return $user["id"];
        }
        else
        {
            return null;
        }
    }


}