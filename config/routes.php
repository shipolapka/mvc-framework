<?php

return array(
    'account/login' => array(               /*'account/login' - ключ, array - значение,
                                            а внутри array еще массив, где тоже есть ключ-значение?*/
        'controller' => 'account',
        'action' => 'login'
    ),

    'account/register' => array(
        'controller' => 'account',
        'action' => 'register'
    ),

    '' => array(
        'controller' => 'main',
        'action' => 'index'
    )
);