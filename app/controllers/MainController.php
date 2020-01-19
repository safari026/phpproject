<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController {
   
  // public $layout = 'main';
    public function indexAction(){
      $model = new Main;
  //    $res = $model->query("CREATE TABLE users SELECT * FROM test_1.users");
     $users=$model->findAll();
    // $users= $model->findOne(2);
     //debug($users);
      $data = $model->findBySql("SELECT * FROM {$model->table} ORDER BY id  DESC LIMIT 2");
      debug($data);
      $title = 'PAGE TITLE';
      $this->set(compact('title','users'));
   }
}
 



 // $this->layout =false;
       //$this->view='test';
      // $this->layout='main';