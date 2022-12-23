<?php

namespace controllers;

use core\Controller;
use core\Error;
use core\Utils;
use models\Car;
use models\Carad;
use models\User;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if (User::isUserAdmin())
        {
            $data["users_count"] = User::getCountOfUsers();
            $data["car_ads_count"] = Carad::getCountOfCarAds();
            $data["cars_average_price"] = Car::getAverageUSDCarsPrice();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            $data = [];
            $data["ads"] = Carad::getAllActiveCarAdsInnered();
            return $this->render("views/carad/index.php", [
                "title" => "Головна сторінка",
                "data" => $data
            ]);
        }
    }

    public function errorAction($code = null)
    {
        $view_error_404 = User::isUserAdmin() ? "views/admin/site/error-404.php" : "views/site/error-404.php";
        $viewPath = User::isUserAdmin() ? "views/admin/site/error-{$code}.php" : "views/site/error-{$code}.php";
        if(!empty($code))
        {
            if (in_array($code, Error::ALLOWED_ERRORS_TYPES))
            {
                return $this->render($viewPath);
            }
            else
            {
                return $this->render($view_error_404);
            }
        }
        else
        {
            return $this->render($view_error_404);
        }
    }
}