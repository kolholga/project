<?php


namespace app\controllers;


use system\core\Controller;

class MainController extends Controller
{

    // методы с префиксом Action - публичные методы
    public function indexAction()
    {
        pr($this->route);
        echo 'Main::index';
    }

    public function testAction()
    {
        echo 'Main::test';
    }

    public function check()
    {

    }

    /* например
    public function about()
    {
        echo 'Main::test';
    }

    public function contact()
    {
        echo 'Main::test';
    }
    */
}