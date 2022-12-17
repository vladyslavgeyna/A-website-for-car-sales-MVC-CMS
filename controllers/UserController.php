<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Utils;
use models\Image;
use models\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerAction()
    {
        if(User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            $image_id = null;
            $isAvatarExist = false;
            if(strlen($_POST["name"]) <= 2)
            {
                $errors['name'] = "Помилка при введенні імені";
            }
            if(strlen($_POST["surname"]) <= 2)
            {
                $errors['surname'] = "Помилка при введенні прізвища";
            }
            if(strlen($_POST["lastname"]) <= 2)
            {
                $errors['lastname'] = "Помилка при введенні по-батькові";
            }
            if (!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL))
            {
                $errors['login_error'] = "Помилка при введенні логіну";
            }
            if(User::isLoginExists($_POST["login"]))
            {
                $errors['login_exist'] = "Даний логін вже зайнятий";
            }
            if(($_POST["password"] == $_POST["password2"]) && (strlen($_POST["password2"]) < 6))
            {
                $errors['password2'] = "Мінімальна довжина паролю 6 символів";
            }
            if($_POST["password"] != $_POST["password2"])
            {
                $errors['password2'] = "Паролі не співпадають";
            }
            if(strlen($_POST["phone"]) < 10)
            {
                $errors['phone_error'] = "Номер телефону повинен містити принаймні 10 символів";
            }
            if (!preg_match('/^0[3569]\d{8}$/', $_POST["phone"])) // ^(?:\+38)?0[3569]\d{8}$ - на випадок, якщо треба буде +38
            {
                $errors['phone_error'] = "Помилка при введені номеру телефону";
            }
            if (User::isPhoneExists($_POST["phone"]))
            {
                $errors['phone_exist'] = "Користувач з таким номером вже зареєстрований";
            }
            if(empty($_FILES["avatar"]["error"]))
            {
                if(!in_array($_FILES["avatar"]["type"], Image::ALLOWED_PHOTO_TYPES))
                {
                    $errors['avatar'] = "Некоректний тип файлу. Дозволені типи: png та jpeg";
                }
                else
                {
                    $isAvatarExist = true;
                }
            }
            if(count($errors) > 0)
            {
                $data = $_POST;
                return $this->render(null, [
                    "errors" => $errors,
                    "data" => $data
                ]);
            }
            else
            {
                if($isAvatarExist === true)
                {
                    $extension = Utils::getFileExtension($_FILES["avatar"]["name"]);
                    $image_id = Image::addImage($_FILES["avatar"]["tmp_name"], $extension);
                }
                $password = Utils::getHashedString($_POST["password"]);
                User::addUser($_POST["name"], $_POST["surname"], $_POST["lastname"], $_POST["login"], $password, $_POST["phone"], $image_id);
                $_SESSION["success_register"] = "Вітаємо, Ви успішно зареєструвалися";
                $this->redirect("/user/login");
            }

        }
        else
        {
            return $this->render();
        }
    }

    public function loginAction()
    {
        if(User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $password = Utils::getHashedString($_POST["password"]);
            $user = User::getUserByLoginAndPassword($_POST["login"], $password);
            $error = null;
            if(empty($user))
            {
                $error = "Неправильний логін або пароль";
            }
            else
            {
                User::authenticateUser($user);
                $this->redirect("/");
            }
        }
        return $this->render(null, [
            "error" => $error
        ]);
    }

    public function logoutAction()
    {
        User::logoutUser();
        $this->redirect("/user/login");
    }

}