<?php

//класс реализует подключение к БД
namespace system\core;


class Db
{
    protected $pdo;
    protected static $instance;
    public static $queries = []; // запросы

    protected function __construct()
    {
        $db = require ROOT . '/config/db.php'; // теперь $db - это массив
        $option = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // все ошибки должны выбрасываться как исключение
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC // получаем только ассоциативный массив
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $option);
    }

    public static function instance() //паттерн Singleton
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * метод выполняет простые запросы
     * @param $sql
     * @return bool
     */
    public function exec($sql) // передаем строку с запросом $sgl
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    /**
     * метод для получения данных // возвращает массив
     * @param $sql
     * @param array $param
     * @return array
     */
    public function query($sql, $param = [])
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($param); //$res хранится готовый ответ от БД
        if ($res !== false) {
            return $stmt->fetchAll();
        }else{
            return [];
        }
    }
}