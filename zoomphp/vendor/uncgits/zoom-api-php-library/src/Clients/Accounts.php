<?php

namespace Uncgits\ZoomApi\Clients;

use Uncgits\ZoomApi\Clients\ZoomApiClientInterface;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/accounts
 */
class Accounts implements ZoomApiClientInterface
{
    public function listSubAccounts()
    {
        return [
            'accounts',
            'get',
            [],
            true
        ];
    }

    public function createSubAccount()
    {
        return [
            'accounts',
            'post'
        ];
    }

    public function getSubAccount($accountId)
    {
        return [
            'accounts/' . $accountId,
            'get',
        ];
    }

    public function dissociateSubAccount($accountId)
    {
        return [
            'accounts/' . $accountId,
            'delete',
        ];
    }

    public function updateOptions($accountId)
    {
        return [
            'accounts/' . $accountId . '/options',
            'patch'
        ];
    }

    public function getSettings($accountId = 'me')
    {
        return [
            'accounts/' . $accountId . '/settings',
            'get',
        ];
    }

    public function updateSettings($accountId = 'me')
    {
        return [
            'accounts/' . $accountId . '/settings',
            'patch',
        ];
    }

    public function getManagedDomains($accountId = 'me')
    {
        return [
            'accounts/' . $accountId . '/managed_domains',
            'get',
        ];
    }

    public function getTrustedDomains($accountId = 'me')
    {
        return [
            'accounts/' . $accountId . '/trusted_domains',
            'get',
        ];
    }

    public function getLockedSettings($accountId)
    {
        return [
            'accounts/' . $accountId . '/lock_settings',
            'get',
        ];
    }

    public function updateLockedSettings($accountId)
    {
        return [
            'accounts/' . $accountId . '/lock_settings',
            'patch',
        ];
    }

    public function updateAccountOwner($accountId)
    {
        return [
            'accounts/' . $accountId . '/owner',
            'put',
        ];
    }
}
