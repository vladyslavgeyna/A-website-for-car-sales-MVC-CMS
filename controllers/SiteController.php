<?php

namespace controllers;

use core\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        return $this->render(null, [
           'title' => 'Головна сторінка сайту'
        ]);
    }

    public function errorAction($code = null)
    {
        if(!empty($code))
        {
            switch ($code)
            {
                case 404:
                    return $this->render("views/site/error.php");
                    break;
            }
        }
        else
        {
            return $this->render("views/site/error.php");
        }
    }
}