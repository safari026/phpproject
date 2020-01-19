<?php
namespace vendor\core;




class Db{
    protected $pdo; // защищенное свойство pdo
    protected static $instance;
    public static $countSql=0; // количество выполненных sql  запросов
    public static $queries = [];  // пустой массив в котором мы будем сохранять и записывать наши запросы
    protected function __construct(){
         $db = require ROOT . '/config/config_db.php';
         $options=[
             \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //
             \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
         ];
         $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }
    public static function instance (){
        if(self::$instance === null){
            self::$instance= new self;
        }
            return self::$instance;
    }
    // метод для выполнения sql  запроса даже если его нет
    // $param $sql 
    public function execute($sql, $params = []){
        self::$countSql++;
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    //метод необходим для запроса ти  select  которые осуществляют выборку данных из базы
    //
    public function query($sql, $params = []){
        self::$countSql++; // увеличиваем счетчик
        self::$queries[]=$sql; // запишем очередной sql  запрос который передается параметром
        $stmt=$this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res !==false){
            return $stmt->fetchAll();
        } 
        return[];
        
    }

}