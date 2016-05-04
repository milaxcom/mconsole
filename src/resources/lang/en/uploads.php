<?php

return [
    'menu' => [
        'list' => [
            'name' => 'Uploads',
            'description' => 'List of uploaded files',
        ],
        'delete' => [
            'name' => 'Delete file',
            'description' => '',
        ],
    ],
    'table' => [
        'type' => 'Type',
        'path' => 'Path',
        'filename' => 'File name',
        'copies' => 'Copies',
        'related' => 'Related object',
    ],
    'filter' => [
        'filename' => 'File name',
        'type' => 'Type',
    ],
    'acl' => [
        'index' => 'Uploads: show list',
        'create' => 'Uploads: show create form',
        'store' => 'Uploads: saving',
        'edit' => 'Uploads: show edit form',
        'update' => 'Uploads: updating',
        'show' => 'Uploads: view',
        'destroy' => 'Uploads: delete',
    ],
];
