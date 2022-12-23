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

    public function addAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
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

        else
        {
            // тут для адміна
        }
    }


    public function deleteAction($params)
    {
        if (!User::isUserAuthenticated())
        {
            $this->redirect("/");
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
            $this->redirect("/carad/view/{$id}");
        }

        else
        {
            // тут для адміна
        }
    }
}










