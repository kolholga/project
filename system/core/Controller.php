<?php


namespace system\core;


abstract class Controller
{
    protected $route;
    protected $layout;
    protected $view;
    public $vars = []; //хранятся данные, которыу мы можем передать в шаблон

    public function __construct($route, $view = '')
    {
        $this->route = $route; // в этом $route получаем controller и action
        //pr($route);
        $this->view = $view ?: $route['action']; // определяем текущее представление(вид)
    }

    /**
     * вызывает(подключает) нужное представление (вид)
     */
    public function getView()
    {
        $objView = new View($this->route, $this->layout, $this->view);
        $objView->render($this->vars);

    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }
}