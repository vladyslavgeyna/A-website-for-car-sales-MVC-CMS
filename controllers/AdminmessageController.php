<?php

namespace controllers;

use core\Core;
use core\Utils;
use models\Adminmessage;
use models\Image;
use models\Message;
use models\User;

class AdminmessageController extends \core\Controller
{
    public function sendAction()
    {
        if (User::isUserAdmin())
        {
            $this->redirect("/");
        }
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["text"]))
            {
                $errors["text"] = "Ви не ввели повідомлення";
            }
            if (strlen(trim($_POST["text"])) < 20)
            {
                $errors["text"] = "Занадто коротку повідомлення. Введіть більше тексту";
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
                $message_id = Message::addMessage(trim(nl2br($_POST["text"])), User::getCurrentUserId(), date("Y-m-d H:i:s"));
                $admins = User::getAllAdminUsers();
                if (!empty($admins))
                {
                    foreach ($admins as $admin)
                    {
                        Adminmessage::addAdminMessage($message_id, $admin["id"]);
                    }
                }
                $_SESSION["success_send_message"] = "Повідомлення успішно відправлено";
                $this->redirect("/adminmessage/send");
            }
        }
        else
        {
            return $this->render();
        }
    }

    public function indexAction()
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $data = [];
        $data["messages"] = Adminmessage::getAdminMessagesByUserAdminIdInnered(User::getCurrentUserId());
        return $this->renderAdmin(null, [
            "data" => $data
        ]);

    }
}