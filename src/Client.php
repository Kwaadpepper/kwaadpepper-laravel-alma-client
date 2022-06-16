<?php

namespace Kwaadpepper\AlmaClient;

use Alma\API\Client as AlmaClient;

/**
 * @inheritDoc
 */
class Client extends AlmaClient
{
    /**
     * Alama client
     *
     * @var \Alma\API\Client
     */
    protected static $client;

    /**
     * AlmaClient function
     */
    public function __construct()
    {
        parent::__construct(
            config('alma.api.key'),
            ['mode' => config('alma.api.mode')]
        );
    }
}
