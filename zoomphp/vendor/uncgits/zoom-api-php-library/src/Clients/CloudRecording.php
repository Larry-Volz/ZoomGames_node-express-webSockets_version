<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/cloud-recording
 */
class CloudRecording implements ZoomApiClientInterface
{
    public function listAllRecordings($userId)
    {
        return [
            'users/' . $userId . '/recordings',
            'get',
            [],
            true,
            'meetings'
        ];
    }

    public function getMeetingRecordings($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/recordings',
            'get',
            [],
            false,
            'recording_files'
        ];
    }

    public function listRecordingsOfAccount($accountId = 'me')
    {
        return [
            'accounts/' . $accountId . '/recordings',
            'get',
            [],
            true,
            'meetings',
        ];
    }
}
