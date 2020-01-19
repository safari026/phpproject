<?php

namespace vendor\core\base;

ini_set('display_errors',1);
class View{
    //Текущий маршрут ($controller,$action, $params)
   // $var array
   
   public $route =[];


     //Текущий вид
   // $var string
   
   public $view;


     //Текущий шаблон
   // $var string
   
   public $layout;

   public function __construct($route,$layout = '',$view = ''){  
        $this->route=$route;
        if($layout === false){
          $this->layout = false;
        }
        else{
          $this->layout = $layout ?: LAYOUT; // усли $layout(шаблон)  был передан тогда будем использовать его 
        }
        
        $this->view = $view;
       
    }

    public function render($vars){
  
   extract($vars);
       $file_view= APP . "/views/{$this->route['controller']}/{$this->view }.php";
       ob_start(); // складываетв буфер обмена и на экран не выводиться
       if(is_file($file_view)){
         require $file_view;
       }else{
          echo "<p>Не найден вид <b>$file_view </b></p>";
       }
      $content = ob_get_clean(); // очищает буфер обмена и складывает все в переменную $content

    if(false !== $this->layout){
      $file_layout = APP . "/views/layouts/{$this->layout}.php";
        if(is_file($file_layout)){
          require $file_layout;
        }else{
    echo "<p>Не найден шаблон <b>$file_layout </b></p>";
          }
    }

     }
}