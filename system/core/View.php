<?php


namespace system\core;


class View
{
    public $route = []; // текущий маршрут
    public $view; // вид - меняемая часть
    public $layout; // единый шаблон для всех страниц - неменяемая часть (фон)

    public function __construct($route, $layout = "", $view = "")
    {
        $this->route = $route;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT; //короткая запись if
        }
        $this->view = $view;

        //подробная запись if
        /*
        if($layout != ''){
            $this->layout = $layout;
        }else{
            $this->layout = LAYOUT;
        }
        */
        //var_dump(LAYOUT);
        //var_dump($this->layout);
    }

    /**
     * формирует путь к нашему представлению
     */
    public function render($vars)
    {
        extract($vars); //extract — Импортирует переменные из массива в текущую таблицу символов

        ob_start(); // включаем буферизацию // все перехватит

        // н-р, /app/views/Main/index.php
        $path_view = ROOT . '/app/views/' . $this->route['controller'] . '/' . $this->view . '.php';
        if(file_exists($path_view)){
            require $path_view;
        }else{
            echo 'представление ' . $path_view . ' не найдено';
        }

        $content = ob_get_clean(); // достает содержимое буфера и возвращает (и все записал в переменную и очистил)
        //echo $content;
        if($this->layout !== false){
            // н-р, /app/views/layouts/default.php
            $path_layout = ROOT . '/app/views/layouts/' . $this->layout . '.php';
            if(is_file($path_layout)){
                require $path_layout;
            }else{
                echo 'шаблон ' . $this->layout . ' не найден';
            }
        }else{
            echo $content;
        }
    }
}