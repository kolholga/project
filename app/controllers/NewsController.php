<?php


namespace app\controllers;

use app\models\News;


class NewsController extends AppController
{
    public function viewAction()
    {
        $id = intval($this->route['id']);
        $news = new News();

        $result = $news->findOne($id);
        if (!empty($result)) {
            $this->setVars(['oneNews' => $result[0]]);
        }

    }
}