<?php

require_once  '../system/core/functions.php';
require_once '../system/core/Router.php';
require_once '../app/controllers/MainController.php';
require_once '../app/controllers/PageController.php';

$qStr = $_SERVER['QUERY_STRING'];

//Router::add(['news/view' => ['controller' => 'news', 'action' => 'view']]);
//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/about' => ['controller' => 'page', 'action' => 'about']]);

Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]); // ^$ - пустая строка в регулярном выражении ("^"- начало строки, "$" - конец строки)
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]); //разрешаем передавать в адресной строку буквы, цифры и тире ( "+"- один и более)

pr(Router::$routers);

//Router::checkRoute($qStr);
Router::dispatch($qStr);

//pr(Router::$route);