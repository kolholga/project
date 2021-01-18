<?php


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
                $obj = new $controller;
            } else {
                echo 'Контроллер ' . $controller . ' не найден';
            }
        } else {
            echo '404';
        }
    }

    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);
        pr($str);
        return $str;
    }
}