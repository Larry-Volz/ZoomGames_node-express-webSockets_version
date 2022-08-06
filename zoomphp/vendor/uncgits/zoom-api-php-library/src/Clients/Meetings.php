<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings
 */
class Meetings implements ZoomApiClientInterface
{
    public function listMeetings($userId)
    {
        return [
            'users/' . $userId . '/meetings',
            'get',
            [],
            true
        ];
    }

    public function createMeeting($userId)
    {
        // note: rate limit of 100 requests per day for a user

        return [
            'users/' . $userId . '/meetings',
            'post',
        ];
    }

    public function getMeeting($meetingId)
    {
        return [
            'meetings/' . $meetingId,
            'get'
        ];
    }

    public function updateMeeting($meetingId)
    {
        // note: rate limit of 100 requests per day.

        return [
            'meetings/' . $meetingId,
            'patch'
        ];
    }

    public function deleteMeeting($meetingId)
    {
        return [
            'meetings/' . $meetingId,
            'delete'
        ];
    }

    public function updateMeetingStatus($meetingId)
    {
        return [
            'meetings/' . $meetingId,
            'put'
        ];
    }

    public function listMeetingRegistrants($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/registrants',
            'get',
            [],
            true
        ];
    }

    public function addMeetingRegistrant($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/registrants',
            'post'
        ];
    }

    public function updateMeetingRegistrantStatus($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/registrants',
            'put'
        ];
    }

    public function getPastMeetingDetails($meetingUUID)
    {
        // note: double-encode UUID if it begins with '/' or contains '//'

        return [
            'past_meetings/' . $meetingUUID,
            'get'
        ];
    }

    public function getPastMeetingParticipants($meetingUUID)
    {
        // note: double-encode UUID if it begins with '/' or contains '//'

        return [
            'past_meetings/' . $meetingUUID . '/participants',
            'get',
            [],
            true
        ];
    }

    public function listEndedMeetingInstances($meetingId)
    {
        return [
            'past_meetings/' . $meetingId . '/instances',
            'get',
            [],
            true
        ];
    }

    public function listMeetingPolls($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/polls',
            'get',
            [],
            true
        ];
    }

    public function createMeetingPoll($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/polls',
            'post'
        ];
    }

    public function getMeetingPoll($meetingId, $pollId)
    {
        return [
            'meetings/' . $meetingId . '/polls/' . $pollId,
            'get'
        ];
    }

    public function updateMeetingPoll($meetingId, $pollId)
    {
        return [
            'meetings/' . $meetingId . '/polls/' . $pollId,
            'put'
        ];
    }

    public function deleteMeetingPoll($meetingId, $pollId)
    {
        return [
            'meetings/' . $meetingId . '/polls/' . $pollId,
            'delete'
        ];
    }

    public function listRegistrationQuestions($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/registrants/questions',
            'get',
            [],
            true
        ];
    }

    public function updateRegistrationQuestions($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/registrants/questions',
            'patch'
        ];
    }

    public function getMeetingInvitation($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/invitation',
            'get'
        ];
    }

    public function updateLiveStream($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/livestream',
            'patch'
        ];
    }

    public function updateLiveStreamStatus($meetingId)
    {
        return [
            'meetings/' . $meetingId . '/livestream/status',
            'patch'
        ];
    }

    public function listPastMeetingPollResults($meetingId)
    {
        return [
            'past_meetings/' . $meetingId . '/polls',
            'get'
        ];
    }

    public function listPastMeetingFiles($meetingId)
    {
        return [
            'past_meetings/' . $meetingId . '/files',
            'get',
            [],
            true
        ];
    }
}
