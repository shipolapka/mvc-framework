<?php

namespace controllers;

use core\Controller;

class AccountController extends Controller
{
    public function before()
    {
        $this->view->layout = 'custom';
    }

    public function loginAction()
    {
        $this->view->render(' Вход');
    }

    public function registerAction()
    {
        $this->view->render(' Регистрация');
    }
}