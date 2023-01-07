<?php

namespace controllers;

use core\Core;
use models\Car;
use models\Fuel;
use models\User;
use models\Wheeldrive;

class WheeldriveController extends \core\Controller
{
    public function addAction()
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["wheeldrive_name"]))
            {
                $errors["wheeldrive_name"] = "Ви не ввели привід";
            }
            if (Wheeldrive::isWheeldriveByNameExist($_POST["wheeldrive_name"]))
            {
                $errors["wheeldrive_name"] = "Привід з такою назвою вже існує";
            }
            if (count($errors) > 0)
            {
                $auto_complete = $_POST;
                return $this->renderAdmin(null, [
                    "errors" => $errors,
                    "auto_complete" => $auto_complete
                ]);
            }
            else
            {
                Wheeldrive::addWheeldrive(trim($_POST["wheeldrive_name"]));
                $_SESSION["success_wheeldrive_added"] = "Привід успішно додано";
                $this->redirect("/wheeldrive/add");
            }
        }
        else
        {
            return $this->renderAdmin();
        }
    }

    public function indexAction()
    {
        if (User::isUserAdmin())
        {
            $data = [];
            $data["wheeldrives"] = Wheeldrive::getAllWheelDrives();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            return $this->error(403);
        }
    }

    public function deleteAction($params)
    {
        if (!User::isUserAdmin())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Wheeldrive::isWheeldriveByIdExist($id))
        {
            $this->redirect("/");
        }
        if (Car::isCarByWheelDriveIdExist($id))
        {
            $_SESSION["error_wheeldrive_deleted"] = "Автомобіль, що використовує даний привід існує";
            $this->redirect("/wheeldrive");
        }
        Wheeldrive::deleteWheeldriveById($id);
        $_SESSION["success_wheeldrive_deleted"] = "Привід успішно видалено";
        $this->redirect("/wheeldrive");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Wheeldrive::isWheeldriveByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Wheeldrive::getWheelDriveById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели привід";
            }
            if (Wheeldrive::isWheeldriveByNameExist($_POST["name"]))
            {
                $errors["name"] = "Привід з такою назвою вже існує, ви ввели ту ж саму назву";
            }
            if (count($errors) > 0)
            {
                $auto_complete = $_POST;
                return $this->renderAdmin(null, [
                    "errors" => $errors,
                    "auto_complete" => $auto_complete
                ]);
            }
            else
            {
                Wheeldrive::updateWheeldriveById($id, trim($_POST["name"]));
                $_SESSION["success_wheeldrive_edited"] = "Привід успішно відредаговано";
                $this->redirect("/wheeldrive");
            }
        }
        else
        {
            return $this->renderAdmin(null, [
                "auto_complete" => $auto_complete
            ]);
        }
    }
}