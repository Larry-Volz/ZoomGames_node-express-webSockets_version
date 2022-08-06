<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/dashboards
 */
class Dashboards implements ZoomApiClientInterface
{
    public function listMeetings()
    {
        return [
            'metrics/meetings',
            'get',
            [],
            true
        ];
    }

    public function getMeetingDetails($meetingId)
    {
        return [
            'metrics/meetings/' . $meetingId,
            'get',
        ];
    }

    // alias
    public function getMeeting($meetingId)
    {
        return $this->getMeetingDetails($meetingId);
    }

    public function listMeetingParticipants($meetingId)
    {
        return [
            'metrics/meetings/' . $meetingId . '/participants',
            'get',
            [],
            true
        ];
    }

    public function getMeetingParticipantQos($meetingId, $participantId)
    {
        return [
            'metrics/meetings/' . $meetingId . '/participants/' . $participantId . '/qos',
            'get'
        ];
    }

    public function listMeetingParticipantQos($meetingId)
    {
        return [
            'metrics/meetings/' . $meetingId . '/participants/qos',
            'get',
            [],
            true,
            'participants'
        ];
    }

    public function getMeetingSharingRecordingDetails($meetingId)
    {
        return [
            'metrics/meetings/' . $meetingId . '/participants/sharing',
            'get',
            [],
            true,
            'participants'
        ];
    }

    public function listWebinars()
    {
        return [
            'metrics/webinars',
            'get',
            [],
            true
        ];
    }

    public function getWebinarDetails($webinarId)
    {
        return [
            'metrics/webinars/' . $webinarId,
            'get',
        ];
    }

    // alias
    public function getWebinar($webinarId)
    {
        return $this->getWebinarDetails($webinarId);
    }

    public function listWebinarParticipants($webinarId)
    {
        return [
            'metrics/webinars/' . $webinarId . '/participants',
            'get',
            [],
            true
        ];
    }

    public function getWebinarParticipantQos($webinarId, $participantId)
    {
        return [
            'metrics/webinars/' . $webinarId . '/participants/' . $participantId . '/qos',
            'get'
        ];
    }

    public function listWebinarParticipantQos($webinarId)
    {
        return [
            'metrics/webinars/' . $webinarId . '/participants/qos',
            'get',
            [],
            true
        ];
    }

    public function getWebinarSharingRecordingDetails($webinarId)
    {
        return [
            'metrics/webinars/' . $webinarId . '/participants/sharing',
            'get',
            [],
            true
        ];
    }

    public function listZoomRooms()
    {
        return [
            'metrics/zoomrooms',
            'get',
            [],
            true,
            'zoom_rooms'
        ];
    }

    public function getZoomRoomsDetails($zoomroomId)
    {
        return [
            'metrics/zoomrooms/' . $zoomroomId,
            'get',
        ];
    }

    // alias
    public function getZoomRoomDetails($zoomroomId)
    {
        return $this->getZoomRoomsDetails($zoomroomId);
    }

    public function getCrcPortUsage()
    {
        return [
            'metrics/crc',
            'get',
        ];
    }

    public function getImMetrics()
    {
        return [
            'metrics/im',
            'get',
        ];
    }

    public function listZoomMeetingsClientFeedbacks()
    {
        return [
            'metrics/client/feedback',
            'get',
        ];
    }

    public function getTop25IssuesOfZoomRooms()
    {
        return [
            'metrics/zoomrooms/issues',
            'get',
        ];
    }

    public function getTop25ZoomRoomsWithIssues()
    {
        return [
            'metrics/issues/zoomrooms',
            'get',
        ];
    }

    public function getIssuesOfZoomRooms($zoomroomId)
    {
        return [
            'metrics/issues/zoomrooms/' . $zoomroomId,
            'get',
            [],
            true,
        ];
    }

    // alias
    public function getIssuesOfZoomRoom($zoomroomId)
    {
        return $this->getIssuesOfZoomRooms($zoomroomId);
    }

    public function getZoomMeetingsClientFeedbackDetail($feedbackId)
    {
        return [
            'metrics/client/feedback/' . $feedbackId,
            'get',
            [],
            true
        ];
    }

    public function listClientMeetingSatisfaction()
    {
        return [
            'metrics/client/satisfaction',
            'get'
        ];
    }
}
