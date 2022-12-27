<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Carbrand;
use models\Carmodel;
use models\User;

class CarmodelController extends Controller
{
    public function addAction()
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $data = [];
        $data["car_brands"] = Carbrand::getAllCarBrands();
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["car_brand"]))
            {
                $errors['car_brand'] = "Ви не обрали марку";
            }
            if (empty($_POST["car_model_name"]))
            {
                $errors["car_model_name"] = "Ви не ввели модель";
            }
            if (Carmodel::isCarModelByNameAndCarBrandIdExist($_POST["car_model_name"], $_POST["car_brand"]))
            {
                $errors["car_model_name"] = "Модель за такою маркою та назвою вже існує";
            }
            if (count($errors) > 0)
            {
                $auto_complete = $_POST;
                return $this->renderAdmin(null, [
                    "errors" => $errors,
                    "data" => $data,
                    "auto_complete" => $auto_complete
                ]);
            }
            else
            {
                Carmodel::addCarModel(trim($_POST["car_model_name"]), $_POST["car_brand"]);
                $_SESSION["success_car_model_added"] = "Модель успішно додано";
                $this->redirect("/carmodel/add");
            }
        }
        else
        {
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
    }

    public function indexAction()
    {
        if (User::isUserAdmin())
        {
            $data = [];
            $data["car_models"] = Carmodel::getAllCarModels();
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
        if (!Carmodel::isCarModelByIdExist($id))
        {
            $this->redirect("/");
        }
        Carmodel::deleteCarModelById($id);
        $_SESSION["success_car_model_deleted"] = "Модель успішно видалено";
        $this->redirect("/carmodel");
    }



    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Carmodel::isCarModelByIdExist($id))
        {
            $this->redirect("/");
        }
        $data = [];
        $data["car_brands"] = Carbrand::getAllCarBrands();
        $auto_complete = Carmodel::getCarModelById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["car_brand_id"]))
            {
                $errors['car_brand_id'] = "Ви не обрали марку";
            }
            if (!Carbrand::isCarBrandByIdExist($_POST["car_brand_id"]))
            {
                $errors['car_brand_id'] = "Ви не обрали марку";
            }
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели модель";
            }
            if (Carmodel::isCarModelByNameAndCarBrandIdExist($_POST["name"], $_POST["car_brand_id"]))
            {
                $errors["name"] = "Модель за такою маркою та назвою вже існує, ви ввели ту ж саму назву та марку";
            }
            if (count($errors) > 0)
            {
                $auto_complete = $_POST;
                return $this->renderAdmin(null, [
                    "errors" => $errors,
                    "auto_complete" => $auto_complete,
                    "data" => $data
                ]);
            }
            else
            {
                Carmodel::updateCarModelById($id, trim($_POST["name"]), $_POST["car_brand_id"]);
                $_SESSION["success_car_model_edited"] = "Модель успішно відредаговано";
                $this->redirect("/carmodel");
            }
        }
        else
        {
            return $this->renderAdmin(null, [
                "auto_complete" => $auto_complete,
                "data" => $data
            ]);
        }
    }

}