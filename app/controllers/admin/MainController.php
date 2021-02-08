<?php


namespace app\controllers\admin;


use app\models\News;
use app\models\User;

class MainController extends AppController
{
    public function indexAction()
    {
        //echo password_hash('123456', PASSWORD_DEFAULT);
        $news = new News();
        $arNews = $news->findAll();

        $this->setVars(['arNews' => $arNews]);
    }

    public function loginAction()
    {
        $this->layout = 'login';
        $user = new User();
        if (isset($_POST['login'], $_POST['password'])) {

            if ($_POST['login'] != '' && $_POST['password'] != '') {
                $id = $user->auth($_POST['login'], $_POST['password']);
                if (false !== $id) {
                    $user->login($id);
                    header("Location: /admin");
                    die();
                } else {
                    $_SESSION['error'] = 'не верно указаны логин/пароль';
                }
            } else {
                $_SESSION['error'] = 'не указаны логин/пароль';
            }
        }
    }
}