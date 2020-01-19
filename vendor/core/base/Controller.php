<?php 
namespace vendor\core\base;

abstract class Controller {
   
   //Текущий маршрут ($controller,$action, $params)
   // $var array
   
    public $route =[];
   
   
   // вид
   // var string
    public $view;

      //Текущий шаблон
   // $var string
   
   public $layout;

  //пользовательские данные
   // $var array
   
   public $vars = [];

    public function __construct($route){
        
      $this->route=$route;
        $this->view = $route['action'];
        // $this->view = $route['action'];
      //  include APP . "/views/{$route['controller']}/{$this->view}.php";
    }


    public function getView(){ //метод создания обьекта вида $vObj
      $vObj= new View($this->route,$this->layout,$this->view);
      $vObj->render($this->vars);
    }
     
    public function set($vars){
       $this->vars = $vars;
    }
    
}