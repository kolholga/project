<?php
error_reporting(E_ALL); // ошибки // error_reporting — Задаёт, какие ошибки PHP попадут в отчёт
session_start();

require_once '../system/core/functions.php'; //подключаем файл с функциями

// так подключали до написания функции автозагрузки
/*
//require_once '../system/core/Router.php';
//require_once '../app/controllers/MainController.php';
//require_once '../app/controllers/PageController.php';
*/

use system\core\Router;  //пространство имен
$qStr = $_SERVER['QUERY_STRING'];

define("ROOT", '../');  //define — Определяет именованную константу (ROOT - обозначает корневую папку)
//echo dirname(__DIR__); // аналогично '../'
define('LAYOUT', 'default'); // создали константу LAYOUT

// ФУНКЦИЯ АВТОЗАГРУЗКИ:
////////////////////////
spl_autoload_register(function ($class) {  //spl_autoload_register — Регистрирует заданную функцию в качестве реализации метода __autoload()
    $class = ROOT . str_replace('\\', '/', $class) . '.php';  //str_replace — Заменяет все вхождения строки поиска на строку замены
    if(file_exists($class)){  //file_exists — Проверяет существование указанного файла или каталога
        include $class;
    }
});
///////////////////////

// сначала маршруты прописали вручную
/*
//Router::add(['news/view' => ['controller' => 'news', 'action' => 'view']]);
//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['Page/about' => ['controller' => 'Page', 'action' => 'about']]);
*/

// маршруты (правила):
//Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)/(?P<alias>[a-z0-9-]+)$' => []]); //для примера

// свои правила (пишем до дефолтных правил)
Router::add(['^news/view/(?P<id>[0-9]+/?)$' => ['controller' => 'News', 'action' => 'view']]);

// правила по умолчанию - default admin
Router::add(['^admin$' => ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin\\']]);
Router::add(['^admin/(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => ['prefix' => 'admin\\']]);

// правила по умолчанию - default rules
Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]); // ^$ - пустая строка в регулярном выражении ("^"- начало строки, "$" - конец строки)
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]); //разрешаем передавать в адресную строку буквы, цифры и тире ( "+"- один и более)

//pr(Router::$routers);

//Router::checkRoute($qStr);
Router::dispatch($qStr);

//pr(Router::$route);

//pr(\system\core\Db::$queries);