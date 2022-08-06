<?php

namespace Uncgits\ZoomApi\Clients;

use Uncgits\ZoomApi\Clients\ZoomApiClientInterface;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/billing
 */
class Billing implements ZoomApiClientInterface
{
    public function getBillingInformation($accountId)
    {
        return [
            'accounts/' . $accountId . '/billing',
            'get',
        ];
    }

    public function updateBillingInformation($accountId)
    {
        return [
            'accounts/' . $accountId . '/billing',
            'patch',
        ];
    }

    public function getPlanInformation($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans',
            'get',
        ];
    }

    public function subscribeToPlans($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans',
            'post',
        ];
    }

    public function updateBasePlan($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/base',
            'put',
        ];
    }

    public function addAdditionalPlan($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/addons',
            'post',
        ];
    }

    public function updateAdditionalPlan($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/addons',
            'put',
        ];
    }

    public function cancelBasePlan($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/base/status',
            'patch',
        ];
    }

    public function cancelAdditionalPlans($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/addons/status',
            'patch',
        ];
    }

    public function getPlanUsage($accountId)
    {
        return [
            'accounts/' . $accountId . '/plans/usage',
            'get',
        ];
    }
}
