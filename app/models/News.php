<?php


namespace app\models;


use system\core\Model;

class News extends Model
{
    public $table = 'news'; //переопределяем $table с null в 'news'

    public function getNewsByCategory($categoryId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE `categoty_id` = ?";
        return $this->db->query($sql, [$categoryId]);
    }
}