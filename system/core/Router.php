<?php

namespace system\core;

class Router
{
    public static $routers = []; //массив с маршрутами (таблица маршрутов)
    public static $route = []; //текущий маршрут

    /**
     * Добавляет маршрут в таблицу маршрутов
     * @param $route
     */
    public static function add($route)
    {
        foreach ($route as $k => $val) {
            self::$routers[$k] = $val;
        }
    }


    /**
     *  Метод проверяет совпадение с таблицей маршрутов
     * @param $url - адресная строка
     * @return bool
     */
    public static function checkRoute($url)
    {
        $url = self::removeQueryString($url); //очищенный $url
        foreach (self::$routers as $k => $val) {
            if (preg_match("#$k#i", $url, $matches)) {
                //pr($val);
                $route = $val;
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $route[$key] = $match;
                    }
                }

                $route['controller'] = self::uStr($route['controller']); // перезапишет
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                self::$route = $route;
                return true;
            }
        }

        return false;
    }

    public static function dispatch($path)
    {
        if (self::checkRoute($path)) {
            $controller = '\app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {

                $obj = new $controller(self::$route);
                $action = self::lStr(self::$route['action']) . 'Action';
                //r($action);
                if (method_exists($obj, $action)) { // method_exists — Проверяет, существует ли метод в данном классе
                    $obj->$action();
                } else {
                    echo 'Метод ' . $action . ' не найден';
                }
            } else {
                echo 'Контроллер ' . $controller . ' не найден';
            }
        } else {
            http_response_code(404); // http_response_code — Получает или устанавливает код ответа HTTP
            include '404.html';
        }
    }

    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);
        //pr($str);
        return $str;
    }

    private static function lStr($str)
    {
        return lcfirst(self::uStr($str)); // lcfirst — Преобразует первый символ строки в нижний регистр
    }

//удаляет из адресной строки явные GET-параметры (то, что в адресной строке посе знака ?)
    private static function removeQueryString($url)
    {
        if ($url != '') {
            $params = explode('&', $url); // теперь $params - это массив
            if (strpos($params[0], '=') === false) {  //strpos — Возвращает позицию первого вхождения подстроки
                return $params[0];
            } else {
                return '';
            }
            //pr($params);
        }
        //pr($url);
        return $url;
    }
}