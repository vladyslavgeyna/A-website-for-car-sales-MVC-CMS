<?php

namespace models;

use core\Core;

class Userreview
{
    protected static string $tableName = "user_review";

    public static function addUserReview($title, $text, $user_id, $user_id_from)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "title" =>  $title,
            "text" => $text,
            "user_id" => $user_id,
            "user_id_from" => $user_id_from
        ]);
    }

    public static function deleteUserReviewById($id)
    {
        $review = Core::getInstance()->db->select(self::$tableName, "*", [
           "id" => $id
        ]);
        if (!empty($review))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "id" => $id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function getAllUserReviewsByUserIdInnered($user_id): ?array
    {
        $reviews = Core::getInstance()->db->select(self::$tableName, "*", [
           "user_id" =>  $user_id
        ]);
        if (!empty($reviews))
        {
            $result = $reviews;
            for ($i = 0; $i < count($reviews); $i++)
            {
                $result[$i]["user_from"] = User::getUserByIdInnered($reviews[$i]["user_id_from"]);
            }
            $result["user"] = User::getUserByIdInnered($user_id);
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function getAllUserReviewsByUserId($user_id): ?array
    {
        $reviews = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" =>  $user_id
        ]);
        if (!empty($reviews))
        {
            return $reviews;
        }
        else
        {
            return null;
        }
    }

    public static function getAllUserReviewsByUserIdFrom($user_id_from): ?array
    {
        $reviews = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id_from" =>  $user_id_from
        ]);
        if (!empty($reviews))
        {
            return $reviews;
        }
        else
        {
            return null;
        }
    }

    public static function isUserReviewsByUserIdExist($user_id): bool
    {
        $reviews = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" =>  $user_id
        ]);
        return !empty($reviews);
    }

    public static function getUserReviewById($id)
    {
        $review = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        if (!empty($review))
        {
            return $review[0];
        }
        else
        {
            return null;
        }
    }

    public static function isUserReviewByIdExist($id): bool
    {
        $reviews = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" =>  $id
        ]);
        return !empty($reviews);
    }
}