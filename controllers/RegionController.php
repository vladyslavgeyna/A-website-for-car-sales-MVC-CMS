<?php

namespace controllers;

use core\Core;
use models\Car;
use models\Fuel;
use models\Region;
use models\User;

class RegionController extends \core\Controller
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
            if (empty($_POST["region_name"]))
            {
                $errors["region_name"] = "Ви не ввели область";
            }
            if (Region::isRegionByNameExist($_POST["region_name"]))
            {
                $errors["region_name"] = "Область з такою назвою вже існує";
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
                Region::addRegion(trim($_POST["region_name"]));
                $_SESSION["success_region_added"] = "Область успішно додано";
                $this->redirect("/region/add");
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
            $data["regions"] = Region::getAllRegions();
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
        if (!Region::isRegionByIdExist($id))
        {
            $this->redirect("/");
        }
        if (Car::isCarByRegionIdExist($id))
        {
            $_SESSION["error_region_deleted"] = "Автомобіль, що використовує дану область існує";
            $this->redirect("/region");
        }
        Region::deleteRegionById($id);
        $_SESSION["success_region_deleted"] = "Область успішно видалено";
        $this->redirect("/region");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Region::isRegionByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Region::getRegionById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели область";
            }
            if (Region::isRegionByNameExist($_POST["name"]))
            {
                $errors["name"] = "Область з такою назвою вже існує, ви ввели ту ж саму назву";
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
                Region::updateRegionById($id, trim($_POST["name"]));
                $_SESSION["success_region_edited"] = "Область успішно відредаговано";
                $this->redirect("/region");
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