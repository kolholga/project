<?php


namespace app\controllers;


use app\models\News;
use system\core\Controller;

class MainController extends Controller
{

    //public $layout = 'default';

    // методы с префиксом Action - публичные методы

    public function indexAction()
    {
        $news = new News();
        $arNews = $news->findAll();

        $this->setVars(['news' => $arNews]);


        /*
        $news = new NewsController();
        //echo $news->table;
        //$arNews = $news->query("SELECT * FROM {$news->table}");

        //$arNews = $news->findAll(); // сейчас хранится массив как ассоциативный, так и числовой -> прописали настройки в классе Db, чтобы был только ассотиативный

        //$arNews = $news->findOne(2);
        //$arNews = $news->findOne('Новость 1', 'title');
        //$arNews = $news->findOne(3);
        $arNews = $news->findOne("Текст новости 1", 'text');
        pr($arNews);

        $this->view = 'test';
        $arr = [
            'n1' => 1,
            'n2' => 2
        ];
        //pr($this->route);
        //echo 'Main::index';
        //$this->view = 'test';
        $this->setVars(['name' => 'Vasya', 'arArray' => $arr]);
        */
    }

    /*
    public function testAction()
    {
        //echo 'Main::test';
    }

    public function check()
    {

    }
    */
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