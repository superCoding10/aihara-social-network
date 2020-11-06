<?php

return [
    'validation' => [
        'user_name' => [
            'required' => 'Введите имя'
        ],
        'user_email' => [
            'required' => 'Введите емайл',
            'max' => 'Емайл слишком длинный',
            'email' => 'Емайл не валидный'
        ],
        'user_password' => [
            'required' => 'Введите пароль',
            'min' => 'Пароль слишком короткий',
            'max' => 'Пароль сликом длинный'
        ], 
        'user_password_repeat' => [
            'required' => 'Повторите пароль',
            'same' => 'Пароли не совпадают'
        ]
    ]
];