<?php

use Alma\API\Client as AlmaClient;

return [
    'api' => [
        'key' => env('ALMA_API_KEY'),
        /**
         * LIVE_MODE 'live'
         * TEST_MODE 'test'
         */
        'mode' => env('ALMA_API_MODE', AlmaClient::TEST_MODE)
    ]
];
