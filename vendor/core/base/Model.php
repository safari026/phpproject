<?php
namespace vendor\core\base;

use vendor\core\Db;
use vendor\core\base\Model;

abstract class Model{
    protected $pdo;
    protected $table; // имя таблицы с которой будет работать та или иная модель
    protected $pk = 'id'; // первичный ключ
    public function __construct(){
        $this->pdo = Db::instance();
        }
// обертка над методом execute class Db
        public function query($sql){ // который выполняет sql запрос при этом этом данные не важны
            return $this->pdo->execute($sql);
        }
        //возвращает все данные из некой таблицы из той таблицы с которой работает модель (для текущей модели)
    public function findAll(){
    $sql = "SELECT * FROM {$this->table}";
    return $this->pdo->query($sql);
    
    }

    public function findOne($id, $field = ''){
         $field = $field ? : $this->pk;
    $sql= "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
    return $this->pdo->query($sql,['id']);
    }
    public function findBySql($sql, $params=[]){
        return $this->pdo->query($sql,$params);
    }
    // 1 params  строка которую мы ищем
    // 2 params поле по которому осущ поиск 
    // 3 params таблица если она отличается от текущей модели
    public function findLike($str,$field,$table=''){
    $table   =$table ?: $this->table;
    $sql= "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}