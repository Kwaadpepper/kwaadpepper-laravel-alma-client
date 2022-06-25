<?php

namespace Kwaadpepper\AlmaClient;

use Alma\API\Client as AlmaClient;
use Alma\API\Entities\FeePlan;
use Alma\API\Entities\Payment;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Kwaadpepper\AlmaClient\Exceptions\AlmaClientException;

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
     *
     * @link https://github.com/alma/alma-php-client#2-check-eligibility
     */
    public function checkForEligibility(array $data): Collection
    {
        try {
            return \collect($this->payments->eligibility($data, true));
        } catch (\Alma\API\RequestError $e) {
            throw new AlmaClientException(sprintf(
                "Could not join Alma Services : {$e->response->errorMessage} \n %s",
                \collect(Arr::dot(optional($e->response)->json ?? []))->map(function ($v, $k) {
                    return "$k : $v";
                })->implode("\n")
            ), 0, $e);
        }
    }

    /**
     * Get Fee plans
     *
     * @param string       $kind
     * @param string|int[] $installmentsCounts
     * @param boolean      $includeDeferred
     * @return \Illuminate\Support\Collection<\Alma\API\Entities\FeePlan>
     * @throws \Kwaadpepper\Enum\Exceptions\AlmaClientException If joining Alma services fails.
     *
     * @link https://github.com/alma/alma-php-client#3-check-available-fee-plans-and-build-payment-form
     */
    public function getFeePlans(
        string $kind = FeePlan::KIND_GENERAL,
        $installmentsCounts = "all",
        bool $includeDeferred = false
    ) {
        try {
            return \collect(
                $this->merchants->feePlans($kind, $installmentsCounts, $includeDeferred)
            );
        } catch (\Alma\API\RequestError $e) {
            throw new AlmaClientException(sprintf(
                "Could not join Alma Services : {$e->response->errorMessage} \n %s",
                \collect(Arr::dot(optional($e->response)->json ?? []))->map(function ($v, $k) {
                    return "$k : $v";
                })->implode("\n")
            ), 0, $e);
        }
    }

    /**
     * Create a payment
     *
     * @param array $data
     * @return \Alma\API\Entities\Payment
     * @throws \Kwaadpepper\Enum\Exceptions\AlmaClientException If joining Alma services fails.
     *
     * @link https://github.com/alma/alma-php-client#5-create-a-payment-and-redirecting-a-customer-to-the-payment-page
     */
    public function createPayment(array $data): Payment
    {
        try {
            return $this->payments->create($data);
        } catch (\Alma\API\RequestError $e) {
            throw new AlmaClientException(sprintf(
                "Could not join Alma Services : {$e->response->errorMessage} \n %s",
                \collect(Arr::dot(optional($e->response)->json ?? []))->map(function ($v, $k) {
                    return "$k : $v";
                })->implode("\n")
            ), 0, $e);
        }
    }

    /**
     * Fetch Payment Status
     *
     * @param string $paymentId The payment Id got from Alma.
     * @return \Alma\API\Entities\Payment
     * @throws \Kwaadpepper\Enum\Exceptions\AlmaClientException If joining Alma services fails.
     */
    public function getPaymentStatus(string $paymentId): Payment
    {
        try {
            return $this->payments->fetch($paymentId);
        } catch (\Alma\API\RequestError $e) {
            throw new AlmaClientException(sprintf(
                "Could not join Alma Services : {$e->response->errorMessage} \n %s",
                \collect(Arr::dot(optional($e->response)->json ?? []))->map(function ($v, $k) {
                    return "$k : $v";
                })->implode("\n")
            ), 0, $e);
        }
    }
}
