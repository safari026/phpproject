<?php

namespace app\controllers;
use vendor\libs\UserSession;

class AppController extends \vendor\core\base\Controller{
     public function __construct($route){
         UserSession::startSession();
         parent::__construct($route);
     }
 }