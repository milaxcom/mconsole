<?php

return [
    'menu' => [
        'name' => 'Настройки',
        'description' => 'Просмотр списка настроек',
        'update' => [
            'name' => 'Редактирование настроек',
            'description' => 'Сохранение настроек',
        ],
    ],
    'main' => 'Настройки',
    'saved' => 'Настройки сохранены',
    'labels' => [
        'name' => 'Название проекта',
        'url' => 'Адрес сайта',
        'notifications' => 'Уведомления',
        'editredirect' => 'Переадресация на редактирование после сохранения',
        'editor' => 'Тип HTML редактора',
    ],
    'options' => [
        'enabled' => 'Состояние',
        'group' => [
            'name' => 'Основные',
            'other' => 'Остальные',
        ],
        'on' => 'Включено',
        'off' => 'Отключено',
        'textarea' => 'Textarea',
        'ckeditor' => 'CKEditor',
    ],
    'additional' => [
        'name' => 'Дополнительно',
        'cache' => [
            'clear' => 'Очистить кеш',
            'popover' => 'Запустите, если новые элементы не появляются в определнных частях системы',
            'cleared' => 'Кеш был очищен',
        ],
        'translations' => [
            'reload' => 'Перезагрузить языковые файлы',
            'popover' => 'Запустите, если переводы в системе отображаются не корректно',
            'reloaded' => 'Языковые файлы были перезагружены',
        ],
    ],
    'acl' => [
        'index' => 'Настройки: посмотр настроек',
        'store' => 'Настройки: сохранение',
        'clearcache' => 'Настройки: очистка кеша',
        'reloadtrans' => 'Настройки: перезагрузка языковых файлов',
    ],
];
