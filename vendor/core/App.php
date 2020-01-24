<?php
namespace vendor\core;

use vendor\core\ErrorHandler;


class App{
    public static $app;

    public function __construct(){
        new ErrorHandler(); 
    }
}