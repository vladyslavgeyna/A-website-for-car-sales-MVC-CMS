<?php

namespace controllers;

use core\Core;
use models\Car;
use models\Fuel;
use models\Transmission;
use models\User;

class TransmissionController extends \core\Controller
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
            if (empty($_POST["transmission_name"]))
            {
                $errors["transmission_name"] = "Ви не ввели коробку передачі";
            }
            if (Transmission::isTransmissionByNameExist($_POST["transmission_name"]))
            {
                $errors["transmission_name"] = "Коробка передач з такою назвою вже існує";
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
                Transmission::addTransmission(trim($_POST["transmission_name"]));
                $_SESSION["success_transmission_added"] = "Коробку передач успішно додано";
                $this->redirect("/transmission/add");
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
            $data["transmissions"] = Transmission::getAllTransmissions();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }

        else
        {
            // тут якщо НЕ адмін
        }
    }

    public function deleteAction($params)
    {
        if (!User::isUserAdmin())
        {
            $this->redirect("/");
        }
        $id = intval($params[0]);
        if (!Transmission::isTransmissionByIdExist($id))
        {
            $this->redirect("/");
        }
        if (Car::isCarByTransmissionIdExist($id))
        {
            $_SESSION["error_transmission_deleted"] = "Автомобіль, що використовує дану коробку передач існує";
            $this->redirect("/transmission");
        }
        Transmission::deleteTransmissionById($id);
        $_SESSION["success_transmission_deleted"] = "Коробку передач успішно видалено";
        $this->redirect("/transmission");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Transmission::isTransmissionByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Transmission::getTransmissionById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели назву коробки передач";
            }
            if (Transmission::isTransmissionByNameExist($_POST["name"]))
            {
                $errors["name"] = "Коробка передачі з такою назвою вже існує, ви ввели ту ж саму назву";
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
                Transmission::updateTransmissionById($id, trim($_POST["name"]));
                $_SESSION["success_transmission_edited"] = "Коробку передачі успішно відредаговано";
                $this->redirect("/transmission");
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