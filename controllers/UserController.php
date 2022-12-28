<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Utils;
use models\Image;
use models\Typeofcurrency;
use models\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerAction()
    {
        if(User::isUserAuthenticated() && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        if (User::isUserAdmin())
        {
            if(Core::getInstance()->requestMethod === "POST")
            {
                $errors = [];
                $image_id = null;
                $isAvatarExist = false;
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
                if (!preg_match('/^0[3569]\d{8}$/', $_POST["phone"]))
                {
                    $errors['phone_error'] = "Помилка при введені номеру телефону";
                }
                if (User::isPhoneExists($_POST["phone"]))
                {
                    $errors['phone_exist'] = "Користувач з таким номером вже зареєстрований";
                }
                if(empty($_FILES["avatar"]["error"]))
                {
                    $isAvatarExist = true;
                }
                if(count($errors) > 0)
                {
                    $data = $_POST;
                    return $this->renderAdmin(null, [
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
                    $password = Utils::getHashedString(trim($_POST["password"]));
                    $user_id = User::addUser(trim($_POST["name"]), trim($_POST["surname"]), trim($_POST["lastname"]), trim($_POST["login"]), $password, trim($_POST["phone"]), $image_id);
                    if ($_POST["is_admin"] == 1)
                    {
                        User::setUserByIdAsAdmin($user_id);
                    }
                    $_SESSION["success_user_added"] = "Користувача успішно додано";
                    $this->redirect("/user/register");
                }
            }
            else
            {
                return $this->renderAdmin();
            }
        }
        else
        {
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
                    $password = Utils::getHashedString(trim($_POST["password"]));
                    User::addUser(trim($_POST["name"]), trim($_POST["surname"]), trim($_POST["lastname"]), trim($_POST["login"]), $password, trim($_POST["phone"]), $image_id);
                    $_SESSION["success_register"] = "Вітаємо, Ви успішно зареєструвалися";
                    $this->redirect("/user/login");
                }
            }
            else
            {
                return $this->render();
            }
        }
    }

    public function loginAction()
    {
        if(User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $error = null;
        if(Core::getInstance()->requestMethod === "POST")
        {
            $password = Utils::getHashedString(trim($_POST["password"]));
            $user = User::getUserByLoginAndPassword(trim($_POST["login"]), $password);
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

    public function profileAction()
    {
        if(!User::isUserAdmin())
        {
            if (!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }

            $data = [];
            $data["user"] = User::getCurrentAuthenticatedUser();
            return $this->render(null, [
               "data" => $data
            ]);

        }

        else
        {
            // тут для адміна
        }
    }

    public function indexAction()
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $data = [];
        $data["users"] = User::getAllUsers();
        return $this->renderAdmin(null, [
            "data" => $data
        ]);
    }

    public function setadminAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if(!User::isUserByIdExist($id))
        {
            $this->redirect("/");
        }
        User::setUserByIdAsAdmin($id);
        $_SESSION["success_setted_admin"] = "Користувача #{$id} успішно встановлено адміном";
        $this->redirect("/user");
    }

    public function unsetadminAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if(!User::isUserByIdExist($id))
        {
            $this->redirect("/");
        }
        User::unsetUserByIdAsAdmin($id);
        if (User::getCurrentUserId() != $id)
        {
            $_SESSION["success_unsetted_admin"] = "Користувача #{$id} успішно видалено як адміна";
            $this->redirect("/user");
        }
        else
        {
            $this->redirect("/user/logout");
        }
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if(!User::isUserByIdExist($id))
        {
            $this->redirect("/");
        }
        if (!User::isUserAdmin() && User::getCurrentUserId() != $id)
        {
            $this->redirect("/");
        }
        User::deleteUserById($id);
        if (User::isUserAdmin() && User::getCurrentUserId() != $id)
        {
            $_SESSION["success_deleted_user"] = "Користувача успішно видалено";
            $this->redirect("/user");
        }
        else
        {
            $this->redirect("/user/logout");
        }
    }



}