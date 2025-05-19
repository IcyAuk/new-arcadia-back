<?php
return [
    'allowed_origins' => [
        'http://new-arcadia-front.test',
        'http://new-arcadia-front.test:3000',
    ],
    'allowed_methods' => ['GET','POST','PUT','DELETE','PATCH','OPTIONS'],
    'allowed_headers' => ['Content-Type','X-CSRF-Token'],
    'allow_credentials' => true,
];