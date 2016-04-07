<?php

return [
    'menu' => [
        'name' => 'Управление модулями',
    ],
    'table' => [
        'info' => 'Список модулей',
        'reloadtrans' => [
            'title' => 'Перезагрузить языковые файлы',
            'content' => 'Запустите, если переводы в системе отображаются не корректно',
        ],
        'reloadtransprocess' => 'Идет сканирование языковых файлов..',
        'uninstall' => [
            'process' => 'Идет удаление..',
            'info' => 'Удалить модуль, включая все его данные',
            'modal' => [
                'title' => 'Удалить модуль?',
                'content' => 'Внимание! Удаление модуля подразумевает удаление всех файлов модуля, а так же всей информации в базе данных. Вы уверены что хотите продолжить?',
                'cancel' => 'Отменить',
                'uninstall' => 'Удалить',
            ],
        ],
        'install' => [
            'process' => 'Идет установка..',
            'info' => 'Установить модуль',
        ],
        'extend' => [
            'process' => 'Идет расширение..',
            'custom' => '',
            'extended' => '',
            'base' => '',
        ],
        'buttons' => [
            'uninstall' => 'Удалить',
            'install' => 'Установить',
            'extend' => 'Расширить',
        ],
    ],
];
