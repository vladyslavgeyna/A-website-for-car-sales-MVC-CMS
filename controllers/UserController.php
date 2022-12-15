<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\User;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerAction()
    {
        return $this->render();
    }


}