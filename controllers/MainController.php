<?php

namespace controllers;

use core\Controller;
use lib\Db;

class MainController extends Controller
{
    public function indexAction()
    {

        $db = new Db;

        $data = $db->column('SELECT name FROM user WHERE id=1');
        debug($data);
//        $vars = [
//            'name' => 'Остя',
//            'age' => 30,
//        ];
        $this->view->render('Главная страница');
    }

}