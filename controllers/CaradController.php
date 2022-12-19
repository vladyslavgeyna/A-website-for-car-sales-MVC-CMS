<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Carbrand;
use models\Carimage;
use models\Carmodel;
use models\Fuel;
use models\Region;
use models\Transmission;
use models\User;
use models\Wheeldrive;

class CaradController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addAction()
    {
        if(!User::isUserAdmin())
        {
            if(!User::isUserAuthenticated())
            {
                $this->redirect("/");
            }
            $data = [];
            $data["max_image_count"] = Carimage::MAX_IMAGE_COUNT;
            $data["car_brands"] = Carbrand::getAllCarBrands();
            $data["regions"] = Region::getAllRegions();
            $data["transmissions"] = Transmission::getAllTransmissions();
            $data["fuels"] = Fuel::getAllFuels();
            $data["wheel_drives"] = Wheeldrive::getAllWheelDrives();
//            todo тут треба буде асинзронним запитом отримати моделі, це поки тимчасово. треба додати title, text та ціну, а також додаткові опції для автомобіля
            $data["car_models"] = Carmodel::getAllCarModels();
            if(Core::getInstance()->requestMethod === "POST")
            {

                $errors = [];

                if(count($errors) > 0)
                {
                    return $this->render(null, [
                        "data" => $data,
                        "errors" => $errors
                    ]);
                }
                else
                {

                }
            }
            else
            {
                return $this->render(null, [
                    "data" => $data
                ]);
            }
        }


        else
        {
            //тут якщо користувач адмін...
        }

    }
}