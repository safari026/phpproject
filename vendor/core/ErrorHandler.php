<?php

namespace vendor\core;









class ErrorHandler { // класс обработки ошибок

    public function __construct(){ 
        if(DEBUG){
            ini_set('display_errors',1);
        }else{
            ini_set('display_errors');
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start(); //  буферизация
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']); // обработчик исключений
    }


    public function errorHandler($errno, $errstr, $errfile, $errline){ //метод обработки ошибок
       $this->logErrors($errstr,$errfile,$errline);
        // error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки:{$errstr} | Файл:{$errfile},  | Строка:{$errline}\n=======================================================\n", 3, __DIR__ . '/errors.log');
       
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;

    }

    public function fatalErrorHandler(){
        $error=error_get_last();
       if(!empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR) ){
        $this->logErrors($error['message'],$error['file'],$error['line']);
        ob_end_clean(); //показать ошибку и очистить буфер обмена
        $this->displayError($error['type'],$error['message'],$error['file'],$error['line']); // показываем ошибку буферезируется вывод и ошибка не показывается
       }else{
           ob_end_flush();
       }
    }


    public function exceptionHandler($e){ // метод обработки исключение в качестве param принимает обьект нашего исключения
        $this->logErrors($e->getMessage(),$e->getFile(),$e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
       
    }

    protected function logErrors($message = '',$file = '',$line = ''){
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки:{$message} | Файл:{$file},  | Строка:{$line}\n=======================================================\n", 3, ROOT . '/tmp/errors.log');
    }
    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500){ //закрытй метод который выводит ошибки на экран разработчику
            http_response_code($response);
            if($response == 404){
                require WWW .'/errors/404.html';
                die;
            }
            if(DEBUG){
                 require WWW .'/errors/dev.php';
            }else{
                require 'errors/prod.php';
            }
            die;
    }

}

//echo $test;
//test();
//try{
  //  if(empty($test)){
      // throw new Exception('Упс, исключение');
   // }
//}catch(Exception $e){
//    var_dump($e);
//}


//class NotFoundException extends Exception{
   // public function __construct($message = '', $code='404'){
      //  parent::__construct($message,$code);
   // }
//}