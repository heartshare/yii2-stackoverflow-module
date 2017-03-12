<?php
return [
    'components' => [
        'stackexchange' => [
            'class' => 'shamanzpua\yii2stackexchange\Stackexchange',
            'apiKey' => null,
            'apis' => [
                'stackoverflow' => [
                    'class' => 'shamanzpua\stackexchange\Stackoverflow'
                ],
            ],
        ]
    ],
    'params' => [
        
    ],
];
