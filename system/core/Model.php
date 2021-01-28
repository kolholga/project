<?php


namespace system\core;


abstract class Model
{
    protected $db; //хранится объект класса Db
    protected $table; //хранится таблица, с которой мы будем работать
    protected $pk = 'id'; //$pk - PRIMARY KEY

    public function __construct()
    {
        $this->db = Db::instance();
    }

    //переопределяем методы класса Db

    /**
     * @param $sgl
     * @return bool
     */
    public function query($sgl)
    {
        return $this->db->exec($sgl); //exec() - из класса Db
    }

    /**
     * метод выбирает все
     * @return array
     */
    public function findAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        return $this->db->query($sql);
    }

    /**
     * метод для получения единичного значения
     * @param $id
     * @param string $pk
     * @return array
     */
    public function findOne($id, $pk = '')
    {
        if ($pk !== '') { //если первичный ключ....
            $this->pk = $pk;
        }
        $sql = "SELECT * FROM {$this->table} WHERE {$this->pk} = ? LIMIT 1";
        return $this->db->query($sql, [$id]);
    }


}