<?php 
ini_set('display_errors',1);


use \vendor\core\Router;



 $query = rtrim($_SERVER['QUERY_STRING'],'/'); 

 define('WWW', __DIR__); //указывает на текущую папку public
 define('CORE', dirname(__DIR__) . '/vendor/core'); // заходит в папку core
 define('ROOT', dirname(__DIR__)); // указывает главную папку проекта destroy
 define('APP', dirname(__DIR__) . '/app'); // заходит в папку app
 define('LAYOUT', 'default');
 
 require '../vendor/libs/functions.php';



 spl_autoload_register(function($class){
  $file= ROOT . '/' . str_replace('\\', '/',$class) . '.php';
  if(is_file($file)){
    require_once $file;
  
  }
 });

 Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller'=>'Page']); 
 Router::add('^page/(?P<alias>[a-z-]+)$', ['controller'=>'Page', 'action'=>'view']); 

//defaults roots 
Router::add('^$', ['controller'=>'Main', 'action'=>'index']); 
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // 1сигмент controller 2 сигмент action


Router::dispatch($query);
















// require '../vendor/core/Router.php';
//require '../app/controllers/Main.php';
 //require '../app/controllers/Posts.php';
 //require '../app/controllers/PostsNew.php';
//Router::add('posts/add', ['controller'=>'Posts', 'action'=>'add']);
//Router::add('posts', ['controller'=>'Posts', 'action'=>'index']);
//Router::add('', ['controller'=>'Main', 'action'=>'index']); 
// $router= new Router(); // создание обьекта класса Router
//if(Router::matchRoute($query)): // если  Router::matchRoute и запрос содердиться в переменной $query то совпадение было найдено расспичитываем текущий маршрут
  //  debug(Router::getRoute()); 
//else:
  //  echo '404'; // если нет то ошибка
//endif;
