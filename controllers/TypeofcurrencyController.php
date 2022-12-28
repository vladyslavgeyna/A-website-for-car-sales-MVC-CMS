<?php

namespace controllers;

use core\Core;
use models\Car;
use models\Region;
use models\Typeofcurrency;
use models\User;

class TypeofcurrencyController extends \core\Controller
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
            if (empty($_POST["type_of_currency_name"]))
            {
                $errors["type_of_currency_name"] = "Ви не ввели назву валюти";
            }
            if (empty($_POST["type_of_currency_abbreviation"]))
            {
                $errors["type_of_currency_abbreviation"] = "Ви не ввели абревіатуру валюти";
            }
            if (empty($_POST["type_of_currency_sign"]))
            {
                $errors["type_of_currency_sign"] = "Ви не ввели знак валюти";
            }
            if (Typeofcurrency::isTypeOfCurrencyByNameAbbreviationORSignExist($_POST["type_of_currency_name"], $_POST["type_of_currency_abbreviation"], $_POST["type_of_currency_sign"]))
            {
                $errors["type_of_currency_sign"] = "Валюта з такою назвою, абревіатурою або знаком вже існує";
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
                Typeofcurrency::addTypeOfCurrency(trim($_POST["type_of_currency_name"]), trim($_POST["type_of_currency_abbreviation"]), trim($_POST["type_of_currency_sign"]));
                $_SESSION["success_type_of_currency_added"] = "Вид валюти успішно додано";
                $this->redirect("/typeofcurrency/add");
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
            $data["types_of_currencies"] = Typeofcurrency::getAllTypesOfCurrencies();
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
        if (!Typeofcurrency::isTypeOfCurrencyByIdExist($id))
        {
            $this->redirect("/");
        }
        if (Car::isCarByTypeOfCurrencyIdExist($id))
        {
            $_SESSION["error_type_of_currency_deleted"] = "Автомобіль, що використовує даний вид валюти існує";
            $this->redirect("/typeofcurrency");
        }
        Typeofcurrency::deleteTypeOfCurrencyById($id);
        $_SESSION["success_type_of_currency_deleted"] = "Вид валюти успішно видалено";
        $this->redirect("/typeofcurrency");
    }

    public function editAction($params)
    {
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $id = intval($params[0]);
        if (!Typeofcurrency::isTypeOfCurrencyByIdExist($id))
        {
            $this->redirect("/");
        }
        $auto_complete = Typeofcurrency::getTypeOfCurrencyById($id);
        if(Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            if (empty($_POST["name"]))
            {
                $errors["name"] = "Ви не ввели назву валюти";
            }
            if (empty($_POST["abbreviation"]))
            {
                $errors["abbreviation"] = "Ви не ввели абревіатуру валюти";
            }
            if (empty($_POST["sign"]))
            {
                $errors["sign"] = "Ви не ввели знак валюти";
            }
            if (Typeofcurrency::isTypeOfCurrencyByNameAbbreviationANDSignExist($_POST["name"], $_POST["abbreviation"], $_POST["sign"]))
            {
                $errors["sign"] = "Валюта з такою назвою, абревіатурою або знаком вже існує, ви залишилили ті ж дані";
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
                Typeofcurrency::updateTypeOfCurrencyById($id, trim($_POST["name"]), trim($_POST["abbreviation"]), trim($_POST["sign"]));
                $_SESSION["success_type_of_currency_edited"] = "Вид валюти успішно відредаговано";
                $this->redirect("/typeofcurrency");
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