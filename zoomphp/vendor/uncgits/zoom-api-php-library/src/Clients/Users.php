<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/users
 */
class Users implements ZoomApiClientInterface
{
    public function listUsers()
    {
        return [
            'users',
            'get',
            [],
            true
        ];
    }

    public function getUser($userId)
    {
        return [
            'users/' . $userId,
            'get'
        ];
    }

    public function createUser()
    {
        return [
            'users',
            'post',
            // ['action', 'user_info.email', 'user_info.type']
        ];
    }

    public function updateUser($userId)
    {
        return [
            'users/' . $userId,
            'patch',
        ];
    }

    public function deleteUser($userId)
    {
        return [
            'users/' . $userId,
            'delete'
        ];
    }

    public function listUserAssistants($userId)
    {
        return [
            'users/' . $userId . '/assistants',
            'get',
            [],
            true
        ];
    }

    public function addUserAssistants($userId)
    {
        return [
            'users/' . $userId . '/assistants',
            'post',
        ];
    }

    public function deleteUserAssistants($userId)
    {
        return [
            'users/' . $userId . '/assistants',
            'delete',
        ];
    }

    public function deleteUserAssistant($userId, $assistantId)
    {
        return [
            'users/' . $userId . '/assistants/' . $assistantId,
            'delete',
        ];
    }

    public function updateUserAssistants($userId)
    {
        return [
            'users/' . $userId . '/assistants',
            'patch',
        ];
    }

    public function listUserSchedulers($userId)
    {
        return [
            'users/' . $userId . '/schedulers',
            'get',
            [],
            true
        ];
    }

    public function deleteUserSchedulers($userId)
    {
        return [
            'users/' . $userId . '/schedulers',
            'delete',
        ];
    }

    public function deleteUserScheduler($userId, $assistantId)
    {
        return [
            'users/' . $userId . '/schedulers/' . $assistantId,
            'delete',
        ];
    }

    public function getUserSettings($userId)
    {
        return [
            'users/' . $userId . '/settings',
            'get'
        ];
    }

    public function updateUserSettings($userId)
    {
        return [
            'users/' . $userId . '/settings',
            'patch'
        ];
    }

    public function updateUserStatus($userId)
    {
        return [
            'users/' . $userId . '/status',
            'put'
        ];
    }

    public function updateUserPassword($userId)
    {
        return [
            'users/' . $userId . '/password',
            'put'
        ];
    }

    public function getUserPermissions($userId)
    {
        return [
            'users/' . $userId . '/permissions',
            'get'
        ];
    }

    public function getUserToken($userId)
    {
        return [
            'users/' . $userId . '/token',
            'get'
        ];
    }

    public function revokeUserSsoToken($userId)
    {
        return [
            'users/' . $userId . '/token',
            'delete'
        ];
    }

    public function checkUserEmail()
    {
        return [
            'users/email',
            'get'
        ];
    }

    public function updateUserEmail($userId)
    {
        return [
            'users/' . $userId . '/email',
            'put'
        ];
    }

    public function checkUserPmRoomName()
    {
        return [
            'users/vanity_name',
            'get'
        ];
    }

    public function switchUserAccount($accountId, $userId)
    {
        return [
            'accounts/' . $accountId . '/users/' . $userId . '/account',
            'put'
        ];
    }
}
