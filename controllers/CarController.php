<?php

namespace controllers;

use models\Car;
use models\User;

class CarController extends \core\Controller
{
    public function indexAction()
    {
//        var_dump(mb_strlen("Привіт"));
//        die();
        if (!User::isUserAdmin())
        {
            return $this->error(403);
        }
        $data = [];
        $data["cars"] = Car::getAllCarsInnered();
        return $this->renderAdmin(null, [
            "data" => $data
        ]);
    }
}