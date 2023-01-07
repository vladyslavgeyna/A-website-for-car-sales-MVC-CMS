<?php

namespace controllers;

use models\Carad;
use models\Carcomparison;
use models\Favoritead;
use models\User;

class CarcomparisonController extends \core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if (!User::isUserAdmin())
        {
            $data = [];
            $current_user_id = User::getCurrentUserId();
            $data["user_comp_ads"] = Carcomparison::getAllCarComparisonsByUserIdInnered($current_user_id);
            return $this->render(null, [
                "data" => $data
            ]);
        }
        else
        {
            return $this->error(404);
        }
    }

    public function addAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if (User::isUserAdmin())
        {
            return $this->error(404);
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        $car_ad = Carad::getCarAdById($id);
        if (User::getCurrentUserId() == $car_ad["user_id"])
        {
            $this->redirect("/");
        }
        if (Carcomparison::hasCurrentUserCarComparisonByCarAdId($id))
        {
            $this->redirect("/");
        }
        Carcomparison::addCarComparison(User::getCurrentUserId(), $id);
        if (!User::isUserAdmin())
        {
            $this->redirect("/carad/view/{$id}");
        }
    }

    public function deleteAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if (User::isUserAdmin())
        {
            return $this->error(404);
        }
        $id = intval($params[0]);
        if (!Carad::isCarAdByIdExist($id))
        {
            $this->redirect("/");
        }
        $car_ad = Carad::getCarAdById($id);
        if (User::getCurrentUserId() == $car_ad["user_id"])
        {
            $this->redirect("/");
        }
        if (!Carcomparison::hasCurrentUserCarComparisonByCarAdId($id))
        {
            $this->redirect("/");
        }
        Carcomparison::deleteCarComparisonByUserIdAndCarAdId(User::getCurrentUserId(), $id);
        if (!User::isUserAdmin())
        {
            $this->redirect($_SERVER["HTTP_REFERER"]);
        }
    }
}