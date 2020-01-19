<?php  

namespace vendor\core;
ini_set('display_errors',1);

class Router{
       //таблица маршрутов
        protected static   $routes =[]; // свойство статично это массив в нем будет содержаться весь массив наших маршрутов по умолчанию их 2. Таблица маршрутов. 
        protected static   $route = [];  //  свойство статично это массив один маршрут который вызывается по текущему url адресу содержиться папка вид 
        //добовляем маршрут в таблицу маршрутов
        public static function add($regexp, $route=[]){
             self::$routes[$regexp]= $route; //заполняем массив routes  ключ  $regexp значение $route
        }
        // метод для получения таблицы маршрутов $routes
        // return array
        public static function getRoutes() 
        {
           return self::$routes;
        }
        // метод возвращает текущий маршрут $route
        //return array
    
        public static function getRoute() {
        return self::$route; 
    }
// метод сравнивает регулярное выражение(запрос ) текущем путем и выводит его на экран.  С помощью цикла перебираем массив  $routes  и сравниваем 
//param string $url 
//return boolean
    public static function matchRoute($url) 
    {
          foreach(self::$routes as $pattern => $route):
            if(preg_match("#$pattern#i",$url,$matches)):
                foreach($matches as $k=>$v):
                    if(is_string($k)):
                        $route[$k] = $v;
                    endif;
                endforeach;
                if(!isset($route['action'])){
                     $route['action']='index';
                }
                $route['controller' ]=self::upperCamelCase($route['controller']);
                self::$route=$route;
                return true;
            endif;
        endforeach;  
        return false;
    }

    // перенаправляет url  по коректному маршруту
    //param str url входящий url
    // return void   
    public static function dispatch($url){ 
            $url = self::removeQueryString($url);
            if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
           // debug(self::$route);
            if(class_exists($controller)){
                $cObj = new $controller(self::$route); // обьект controller
                $action= self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($cObj,$action)): //усли есть у обьекта есть метод action  то мы его и запустим
                    $cObj->$action();
                    $cObj->getView();
                else:
                    echo "Метод <b>$controller::$action</b> не найден";
                endif;
            } 
            else{
                echo "Контроллер <b>$controller</b> не найден";
            }
            }else{
                    http_response_code(404);
                    include '404.html';
                }
    }
    
    protected static function upperCamelCase($name){   
        return str_replace(' ','',ucwords(str_replace('-',' ',$name))); 
    }

    //Преобразует к виду camelCase
    //param string $name для преобразования
    protected static function lowerCamelCase($name){   
        return lcfirst(self::upperCamelCase($name)); 
    }

    protected static function removeQueryString($url){
        if($url){
             $params= explode('&',$url,2);
             if(false === strpos($params[0],'=')){
                 return rtrim($params[0],'/');
             }
             else{
                 return ''; 
             }
        }    
        

}


    }