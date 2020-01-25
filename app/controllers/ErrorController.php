<?php

namespace app\controllers;


    class ErrorController extends \vendor\core\base\Controller{
     
        public function __construct($e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "<h1>$code <b>$msg</b></h1>";
        }
 }