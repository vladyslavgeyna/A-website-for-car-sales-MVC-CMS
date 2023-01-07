<?php

namespace controllers;

use core\Controller;
use models\Carad;
use models\Favoritead;
use models\User;

class FavoriteadController extends Controller
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
            $data["user_fav_ads"] = Favoritead::getAllFavoriteAdsByUserIdInnered($current_user_id);
            $data["user_fav_ads_count"] = Favoritead::getCountOfFavoriteAdByUserId($current_user_id);
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
        if (Favoritead::hasCurrentUserFavoriteAdByCarAdId($id))
        {
            $this->redirect("/");
        }
        Favoritead::addFavoriteAd(User::getCurrentUserId(), $id);
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
        if (!Favoritead::hasCurrentUserFavoriteAdByCarAdId($id))
        {
            $this->redirect("/");
        }
        Favoritead::deleteFavoriteAdByUserIdAndCarAdId(User::getCurrentUserId(), $id);
        if (!User::isUserAdmin())
        {
            $this->redirect($_SERVER["HTTP_REFERER"]);
        }
    }
}










