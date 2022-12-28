<?php

namespace controllers;

use core\Core;
use models\Carbrand;
use models\Fuel;
use models\User;

class FuelController extends \core\Controller
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
            if (empty($_POST["fuel_name"]))
            {
                $errors["fuel_name"] = "Ви не ввели вид палива";
            }
            if (Fuel::isFuelByNameExist($_POST["fuel_name"]))
            {
                $errors["fuel_name"] = "Вид палива з такою назвою вже існує";
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
                Fuel::addFuel(trim($_POST["fuel_name"]));
                $_SESSION["success_fuel_added"] = "Вид палива успішно додано";
                $this->redirect("/fuel/add");
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
            $data["fuels"] = Fuel::getAllFuels();
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
        if (!Fuel::isFuelByIdExist($id))
        {
            $this->redirect("/");
        }
        Fuel::deleteFuelById($id);
        $_SESSION["success_fuel_deleted"] = "Вид палива успішно видалено";
        $this->redirect("/fuel");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Fuel::isFuelByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Fuel::getFuelById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели вид палива";
            }
            if (Fuel::isFuelByNameExist($_POST["name"]))
            {
                $errors["name"] = "Вид палива з такою назвою вже існує, ви ввели ту ж саму назву";
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
                Fuel::updateFuelById($id, trim($_POST["name"]));
                $_SESSION["success_fuel_edited"] = "Вид палива успішно відредаговано";
                $this->redirect("/fuel");
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