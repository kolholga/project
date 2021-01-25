<?php


namespace app\controllers;


use system\core\Controller;

class PageController extends Controller
{

    public function indexAction()
    {
        //echo 'Page::index';
        $this->view = 'test';
    }

    public function testNewAction()
    {
        //echo 'Page::testNew';
    }

    public function testAction()
    {
        //echo 'Page::test';
    }
}