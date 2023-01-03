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
                if(($_POST["password"] == $_POST["password2"]) && (mb_strlen($_POST["password2"]) < 6))
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
                if(mb_strlen($_POST["name"]) <= 2)
                {
                    $errors['name'] = "Помилка при введенні імені";
                }
                if(mb_strlen($_POST["surname"]) <= 2)
                {
                    $errors['surname'] = "Помилка при введенні прізвища";
                }
                if(mb_strlen($_POST["lastname"]) <= 2)
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
                if(($_POST["password"] == $_POST["password2"]) && (mb_strlen($_POST["password2"]) < 6))
                {
                    $errors['password2'] = "Мінімальна довжина паролю 6 символів";
                }
                if($_POST["password"] != $_POST["password2"])
                {
                    $errors['password2'] = "Паролі не співпадають";
                }
                if(mb_strlen($_POST["phone"]) < 10)
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
        if(User::isUserAdmin() && !User::isUserByIdExist($id))
        {
            $this->redirect("/");
        }
        if (!User::isUserAdmin() && !empty($id))
        {
            $this->redirect("/");
        }
        if (User::isUserAdmin() && !empty($id))
        {
            User::deleteUserById($id);
            $_SESSION["success_deleted_user"] = "Користувача успішно видалено";
            $this->redirect("/user");
        }
        else
        {
            if (!User::isUserAdmin())
            {
                if(Core::getInstance()->requestMethod === "POST")
                {
                    $current_user = User::getCurrentAuthenticatedUser();
                    if ($current_user["password"] != Utils::getHashedString($_POST["delete_profile_password"]))
                    {
                        $_SESSION['delete_profile_error'] = "Невірно введений пароль";
                        $this->redirect("/user/edit");
                    }
                    else
                    {
                        User::deleteUserById(User::getCurrentUserId());
                        $_SESSION['delete_profile_success'] = "Ваш профіль успішно видалено";
                        $this->redirect("/user/logout");
                    }
                }
                else
                {
                    $this->redirect("/");
                }
            }
            else
            {
                // тут якщо адмін свій профіль видаляє
            }
        }
    }

    public function deleteimageAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!empty($id) && !User::isUserAdmin())
        {
            $this->redirect("/");
        }
        if (!empty($id) && !User::isUserByIdExist($id))
        {
            $this->redirect("/");
        }
        if (empty($id) && !User::hasCurrentUserImage())
        {
            $this->redirect("/");
        }
        if (!empty($id) && !User::hasUserByIdImage($id))
        {
            $this->redirect("/");
        }
        if (empty($id))
        {
            User::deleteUserByIdImage(User::getCurrentUserId());
            $_SESSION["success_edit"] = "Дані успішно змінено.<br>Тепер зробіть вхід в Ваш обліковий запис";
            $this->redirect("/user/logout");
        }
        else
        {
            User::deleteUserByIdImage($id);
            $_SESSION["success_user_edited"] = "Користувача #{$id} успішно відредаговано";
            $this->redirect("/user");
        }
    }


    public function changepasswordAction()
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if (!User::isUserAdmin())
        {
            if(Core::getInstance()->requestMethod === "POST")
            {
                $user = User::getCurrentAuthenticatedUser();
                $errors = [];
                if(Utils::getHashedString($_POST['old_password']) != $user["password"])
                {
                    $errors['old_password'] = "Невірно введений старий пароль";
                }
                if(($_POST["password1"] == $_POST["password2"]) && (mb_strlen($_POST["password2"]) < 6))
                {
                    $errors['password2'] = "Мінімальна довжина паролю 6 символів";
                }
                if($_POST["password1"] != $_POST["password2"])
                {
                    $errors['password2'] = "Паролі не співпадають";
                }
                if (count($errors) > 0)
                {
                    return $this->render(null, [
                        "errors" => $errors
                    ]);
                }
                else
                {
                    $password = Utils::getHashedString(trim($_POST["password1"]));
                    User::changeUserByIdPassword(User::getCurrentUserId(), $password);
                    $_SESSION["success_edit"] = "Дані успішно змінено.<br>Тепер зробіть вхід в Ваш обліковий запис";
                    $this->redirect("/user/logout");
                }
            }
            else
            {
                return $this->render();
            }
        }
        else
        {
            // тут для адміна
        }
    }

    public function editAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        $user_id = $params[0];
        if (!User::isUserAdmin() && !empty($user_id))
        {
            $this->redirect("/");
        }
        $image_path = null;
        if (empty($user_id))
        {
            $data = User::getCurrentAuthenticatedUser();
        }
        else
        {
            $data = User::getUserById($user_id);
        }
        if (empty($user_id))
        {
            if (User::hasCurrentUserImage())
            {
                $image_path = User::getCurrentUserImagePath();
            }
        }
        else
        {
            if (User::hasUserByIdImage($user_id))
            {
                $image_path = User::getUserByIdImagePath($user_id);
            }
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            $new_image_id = null;
            $isAvatarExist = false;
            $is_anything_changed = false;
            if(mb_strlen($_POST["name"]) <= 2)
            {
                $errors['name'] = "Помилка при введенні імені";
            }
            if(mb_strlen($_POST["surname"]) <= 2)
            {
                $errors['surname'] = "Помилка при введенні прізвища";
            }
            if(mb_strlen($_POST["lastname"]) <= 2)
            {
                $errors['lastname'] = "Помилка при введенні по-батькові";
            }
            if (!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL))
            {
                $errors['login_error'] = "Помилка при введенні логіну";
            }
            if (empty($user_id))
            {
                if(User::isLoginExceptCurrentUserExists($_POST["login"]))
                {
                    $errors['login_exist'] = "Даний логін вже зайнятий";
                }
            }
            else
            {
                if(User::isLoginExceptUserByidExists($user_id, $_POST["login"]))
                {
                    $errors['login_exist'] = "Даний логін вже зайнятий";
                }
            }
            if(mb_strlen($_POST["phone"]) < 10)
            {
                $errors['phone_error'] = "Номер телефону повинен містити принаймні 10 символів";
            }
            if (!preg_match('/^0[3569]\d{8}$/', $_POST["phone"]))
            {
                $errors['phone_error'] = "Помилка при введені номеру телефону";
            }
            if (empty($user_id))
            {
                if (User::isPhoneExceptCurrentUserExists($_POST["phone"]))
                {
                    $errors['phone_exist'] = "Користувач з таким номером вже зареєстрований";
                }
            }
            else
            {
                if (User::isPhoneExceptUserByidExists($user_id, $_POST["phone"]))
                {
                    $errors['phone_exist'] = "Користувач з таким номером вже зареєстрований";
                }
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
                    $is_anything_changed = true;
                }
            }
            if (!$is_anything_changed)
            {
                $keys = array_keys($_POST);
                foreach ($keys as $key)
                {
                    if ($data[$key] != $_POST[$key])
                    {
                        $is_anything_changed = true;
                        break;
                    }
                }
            }
            if(count($errors) > 0)
            {
                $data = $_POST;
                if (!User::isUserAdmin())
                {
                    return $this->render(null, [
                        "errors" => $errors,
                        "data" => $data,
                        "image_path" => $image_path
                    ]);
                }
                else
                {
                    return $this->renderAdmin(null, [
                        "errors" => $errors,
                        "data" => $data,
                        "image_path" => $image_path
                    ]);
                }
            }
            else if(!$is_anything_changed)
            {
                if (empty($user_id))
                {
                    $this->redirect("/user/edit");
                }
                else
                {
                    $this->redirect("/user/edit/{$user_id}");
                }
            }
            else
            {
                if (empty($user_id))
                {
                    if (User::hasCurrentUserImage())
                    {
                        $new_image_id = $data["image_id"];
                    }
                }
                else
                {
                    if (User::hasUserByIdImage($user_id))
                    {
                        $new_image_id = $data["image_id"];
                    }
                }
                if($isAvatarExist === true)
                {
                    $extension = Utils::getFileExtension($_FILES["avatar"]["name"]);
                    if (empty($data["image_id"]))
                    {
                        $new_image_id = Image::addImage($_FILES["avatar"]["tmp_name"], $extension);
                    }
                    else
                    {
                        $new_image_id = Image::updateImageById($data["image_id"], $_FILES["avatar"]["tmp_name"], $extension);
                    }
                }
                $updateArray = [
                    "name" => trim($_POST["name"]),
                    "surname" => trim($_POST["surname"]),
                    "lastname" => trim($_POST["lastname"]),
                    "login" => trim($_POST["login"]),
                    "phone" => trim($_POST["phone"]),
                    "image_id" => $new_image_id
                ];
                User::updateUser($data["id"], $updateArray);
                if (empty($user_id))
                {
                    $_SESSION["success_edit"] = "Дані успішно змінено.<br>Тепер зробіть вхід в Ваш обліковий запис";
                    $this->redirect("/user/logout");
                }
                else
                {
                    $_SESSION["success_user_edited"] = "Користувача #{$user_id} успішно відредаговано";
                    $this->redirect("/user");
                }
            }
        }
        else
        {
            if (!User::isUserAdmin())
            {
                return $this->render(null, [
                    "data" => $data,
                    "image_path" => $image_path
                ]);
            }
            else
            {
                return $this->renderAdmin(null, [
                    "data" => $data,
                    "image_path" => $image_path,
                    "user_id" => $user_id
                ]);
            }
        }
    }
}