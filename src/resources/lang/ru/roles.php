<?php


return [
    'menu' => [
        'list' => [
            'name' => 'Группы пользователей',
            'description' => 'Отображение списка пользователей',
        ],
        'create' => [
            'name' => 'Добавить группу',
            'description' => 'Создать новую группу пользователей и определить права доступа ее членов',
        ],
        'update' => [
            'name' => 'Редактировать группу',
            'description' => 'Изменить права пользователей принадлежащих к группе',
        ],
        'delete' => [
            'name' => 'Удалить группу',
            'description' => 'Замечание: невозможно удалить группу в которой есть пользователи',
        ],
    ],
    'form' => [
        'main' => 'Редактировать',
        'permissions' => 'Разрешить доступ',
        'name' => [
            'label' => 'Название',
            'placeholder' => 'Модератор',
        ],
    ],
    'table' => [
        'name' => 'Название',
        'users' => 'Кол-во пользователей',
    ],
    'permission' => [
        'name' => 'Раздел',
        'description' => 'Описание',
    ],
];
