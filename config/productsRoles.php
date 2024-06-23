<?php
return [
    'role' => 'user',
    'roles' => [
        'admin' => [
            'can_edit_article' => true,
        ],
        'user' => [
            'can_edit_article' => false,
        ],
    ],
];
