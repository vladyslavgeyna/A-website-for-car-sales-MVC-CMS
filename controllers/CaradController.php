<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\User;

class CaradController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addAction()
    {
        if(!User::isUserAuthenticated())
        {
            $this->redirect("/");
        }
        if(Core::getInstance()->requestMethod === "POST")
        {

        }
        else
        {
            return $this->render();
        }
    }
}