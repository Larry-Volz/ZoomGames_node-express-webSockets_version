<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/webinars
 */
class Webinars implements ZoomApiClientInterface
{
    public function listWebinars($userId)
    {
        return [
            'users/' . $userId . '/webinars',
            'get',
            [],
            true
        ];
    }

    public function createWebinar($userId)
    {
        // note: rate limit of 100 requests per day for a user

        return [
            'users/' . $userId . '/webinars',
            'post',
        ];
    }

    public function getWebinar($webinarId)
    {
        return [
            'webinars/' . $webinarId,
            'get'
        ];
    }

    public function updateWebinar($webinarId)
    {
        // note: rate limit of 100 requests per day.

        return [
            'webinars/' . $webinarId,
            'patch'
        ];
    }

    public function deleteWebinar($webinarId)
    {
        return [
            'webinars/' . $webinarId,
            'delete'
        ];
    }

    public function updateWebinarStatus($webinarId)
    {
        return [
            'webinars/' . $webinarId,
            'put'
        ];
    }

    public function listPanelists($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/panelists',
            'get',
            [],
            true
        ];
    }

    public function addPanelists($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/panelists',
            'post'
        ];
    }

    public function removePanelists($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/panelists',
            'delete'
        ];
    }

    public function removePanelist($webinarId, $panelistId)
    {
        return [
            'webinars/' . $webinarId . '/panelists/' . $panelistId,
            'delete'
        ];
    }

    public function listWebinarRegistrants($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/registrants',
            'get',
            [],
            true
        ];
    }

    public function addWebinarRegistrant($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/registrants',
            'post'
        ];
    }

    public function updateWebinarRegistrantStatus($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/registrants',
            'put'
        ];
    }

    public function listPastWebinarInstances($webinarId)
    {
        return [
            'past_webinars/' . $webinarId . '/instances',
            'get',
            [],
            true
        ];
    }

    public function listWebinarPolls($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/polls',
            'get',
            [],
            true
        ];
    }

    public function createWebinarPoll($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/polls',
            'post'
        ];
    }

    public function getWebinarPoll($webinarId, $pollId)
    {
        return [
            'webinars/' . $webinarId . '/polls/' . $pollId,
            'get'
        ];
    }

    public function updateWebinarPoll($webinarId, $pollId)
    {
        return [
            'webinars/' . $webinarId . '/polls/' . $pollId,
            'put'
        ];
    }

    public function deleteWebinarPoll($webinarId, $pollId)
    {
        return [
            'webinars/' . $webinarId . '/polls/' . $pollId,
            'delete'
        ];
    }

    public function listRegistrationQuestions($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/registrants/questions',
            'get',
            [],
            true
        ];
    }

    public function updateRegistrationQuestions($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/registrants/questions',
            'patch'
        ];
    }

    public function getWebinarRegistrant($webinarId, $registrantId)
    {
        return [
            'webinars/' . $webinarId . '/registrants/' . $registrantId,
            'get',
        ];
    }

    public function getWebinarAbsentees($webinarUUID)
    {
        return [
            'past_webinars/' . $webinarUUID . '/absentees',
            'get',
            [],
            true
        ];
    }

    public function getWebinarTrackingSoureces($webinarId)
    {
        return [
            'webinars/' . $webinarId . '/tracking_sources',
            'get'
        ];
    }


    public function listPastWebinarPollResults($webinarId)
    {
        return [
            'past_webinars/' . $webinarId . '/polls',
            'get'
        ];
    }

    public function listQaOfPastWebinar($webinarId)
    {
        return [
            'past_webinars/' . $webinarId . '/qa',
            'get'
        ];
    }

    public function listPastWebinarFiles($webinarId)
    {
        return [
            'past_webinars/' . $webinarId . '/files',
            'get',
            [],
            true
        ];
    }
}
