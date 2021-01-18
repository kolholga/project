<?php


class Router
{
    public static $routers = []; //массив с маршрутами (таблица маршрутов)
    public $rout; //текущий маршрут

    public function __construct()
    {
        //echo 'Router';
    }

    public static function getRouts($pattern, $path) //правило на вход получает
    {
        self::$routers[$pattern] = $path;
        self::dispatch($path);
    }

    public static function dispatch($path) //на вход принимет из адресной строки, н-р news/index
    {
        foreach (self::$routers as $pattern => $item){
            preg_match("#".$pattern."#", $item, $matches); //preg_match — Выполняет проверку на соответствие регулярному выражению
            pr($matches);
        }
    }
}