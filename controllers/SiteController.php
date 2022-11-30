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

    public function errorAction($code)
    {
        switch ($code)
        {
            case 404:
                echo "Error 404. Not found";
                break;
        }
    }
}