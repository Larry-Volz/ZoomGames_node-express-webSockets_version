<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/groups
 */
class Groups implements ZoomApiClientInterface
{
    public function listGroups()
    {
        return [
            'groups',
            'get',
            [],
            true
        ];
    }

    public function createGroup()
    {
        return [
            'groups',
            'post',
        ];
    }

    public function getGroup($groupId)
    {
        return [
            'groups/' . $groupId,
            'get'
        ];
    }

    public function updateGroup($groupId)
    {
        return [
            'groups/' . $groupId,
            'patch'
        ];
    }

    public function deleteGroup($groupId)
    {
        return [
            'groups/' . $groupId,
            'delete'
        ];
    }

    public function listGroupMembers($groupId)
    {
        return [
            'groups/' . $groupId . '/members',
            'get',
            [],
            true
        ];
    }

    // alias
    public function listMembers($groupId)
    {
        return $this->listGroupMembers($groupId);
    }

    public function addGroupMembers($groupId)
    {
        return [
            'groups/' . $groupId . '/members',
            'post',
            // ['member_ids']
        ];
    }

    public function deleteGroupMember($groupId, $memberId)
    {
        return [
            'groups/' . $groupId . '/members/' . $memberId,
            'delete',
            // ['member_ids']
        ];
    }

    public function getGroupSettings($groupId)
    {
        return [
            'groups/' . $groupId . '/settings',
            'get'
        ];
    }

    public function updateGroupSettings($groupId)
    {
        return [
            'groups/' . $groupId . '/settings',
            'patch',
        ];
    }

    public function getLockedSettings($groupId)
    {
        return [
            'groups/' . $groupId . '/lock_settings',
            'get'
        ];
    }

    public function updateLockedSettings($groupId)
    {
        return [
            'groups/' . $groupId . '/lock_settings',
            'patch',
        ];
    }
}
