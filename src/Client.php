<?php

namespace Kwaadpepper\AlmaClient;

use Alma\API\Client as AlmaClient;
use Illuminate\Support\Collection;
use Kwaadpepper\Enum\Exceptions\AlmaClientException;

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
            config('alma-client.api.key'),
            ['mode' => config('alma-client.api.mode')]
        );
    }

    /**
     * Check Payment eligibility
     *
     * @param array $data Payment data to check the eligibility for same data format as payment creation,
     * except that only payment.purchase_amount is mandatory and payment.installments_count can be an
     *  array of integers, to test for multiple eligible plans at once.
     * @return \Illuminate\Support\Collection<\Alma\API\Endpoints\Results\Eligibility>
     * @throws \Kwaadpepper\Enum\Exceptions\AlmaClientException If joining Alma services fails.
     */
    public function checkForEligibility(array $data): Collection
    {
        try {
            return \collect($this->client->payments->eligibility($data, true));
        } catch (\Alma\API\RequestError $e) {
            throw new AlmaClientException("Could not join Alma Services", 0, 1, __FILE__, __LINE__, $e);
        }
    }
}
