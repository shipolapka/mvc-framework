<?php

namespace controllers;

use core\Controller;
use lib\Db;

class MainController extends Controller
{
    public function indexAction()
    {
        $db = new Db;

        $form = '2; DELETE FROM mvc.users';

        $params = [
            'id' => $form,
        ];

        $data = $db->column('SELECT name FROM mvc.users WHERE id = :id', $params);

        $result = $this->model->getNews();
        $vars = [
            'news' => $result
        ];
        $this->view->render('Главная страница', $vars);
    }

}