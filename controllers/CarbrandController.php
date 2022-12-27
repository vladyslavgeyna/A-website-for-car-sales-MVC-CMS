<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Carbrand;
use models\User;

class CarbrandController extends Controller
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
            if (empty($_POST["car_brand_name"]))
            {
                $errors["car_brand_name"] = "Ви не ввели марку";
            }
            if (Carbrand::isCarBrandByNameExist($_POST["car_brand_name"]))
            {
                $errors["car_brand_name"] = "Марка з такою назвою вже існує";
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
                Carbrand::addCarBrand(trim($_POST["car_brand_name"]));
                $_SESSION["success_car_brand_added"] = "Марку успішно додано";
                $this->redirect("/carbrand/add");
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
            $data["car_brands"] = Carbrand::getAllCarBrands();
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
        if (!Carbrand::isCarBrandByIdExist($id))
        {
            $this->redirect("/");
        }
        Carbrand::deleteCarBrandById($id);
        $_SESSION["success_car_brand_deleted"] = "Марку успішно видалено";
        $this->redirect("/carbrand");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Carbrand::isCarBrandByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Carbrand::getCarBrandById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели марку";
            }
            if (Carbrand::isCarBrandByNameExist($_POST["name"]))
            {
                $errors["name"] = "Марка з такою назвою вже існує, ви ввели ту ж саму назву";
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
                Carbrand::updateCarBrandById($id, trim($_POST["name"]));
                $_SESSION["success_car_brand_edited"] = "Марку успішно відредаговано";
                $this->redirect("/carbrand");
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