<?php

return array(
    'urlFormat' => 'path',
    'showScriptName' => false,
    'caseSensitive' => false,
    'rules' => array(
        'gii' => 'gii',
        'gii/<controller:\w+>' => 'gii/<controller>',
        'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
        'test' => 'test',
        'test/<controller:\w+>' => 'test/<controller>',
        'test/<controller:\w+>/<action:\w+>' => 'test/<controller>/<action>',
        '/robots.txt' => '/default/robots',
    ),
);
