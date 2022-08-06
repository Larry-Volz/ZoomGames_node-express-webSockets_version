<?php

namespace Uncgits\ZoomApi\Clients;

/**
 * https://marketplace.zoom.us/docs/api-reference/zoom-api/reports
 */
class Reports implements ZoomApiClientInterface
{
    public function getDailyUsageReport()
    {
        return [
            'report/daily',
            'get'
        ];
    }

    public function getActiveInactiveHostReport()
    {
        return [
            'report/users',
            'get',
            [],
            true,
            'users'
        ];
    }

    public function getMeetingReports($userId)
    {
        return [
            'report/users/' . $userId . '/meeting/',
            'get'
        ];
    }

    public function getMeetingDetailReports($meetingId)
    {
        return [
            'report/meetings/' . $meetingId,
            'get'
        ];
    }

    public function getMeetingParticipantReports($meetingId)
    {
        return [
            'report/meetings/' . $meetingId . '/participants',
            'get',
            [],
            true,
            'participants'
        ];
    }

    public function getMeetingPollReports($meetingId)
    {
        return [
            'report/meetings/' . $meetingId . '/polls',
            'get'
        ];
    }

    public function getWebinarDetailReports($webinarId)
    {
        return [
            'report/webinars/' . $webinarId,
            'get'
        ];
    }

    public function getWebinarParticipantReports($webinarId)
    {
        return [
            'report/webinars/' . $webinarId . '/participants',
            'get',
            [],
            true,
            'participants'
        ];
    }

    public function getWebinarPollReports($webinarId)
    {
        return [
            'report/webinars/' . $webinarId . '/polls',
            'get'
        ];
    }

    public function getWebinarQaReport($webinarId)
    {
        return [
            'report/webinars/' . $webinarId . '/qa',
            'get'
        ];
    }

    public function getTelephoneReports()
    {
        return [
            'report/telephone',
            'get'
        ];
    }

    public function getCloudRecordingUsageReport()
    {
        return [
            'report/cloud_recording',
            'get'
        ];
    }

    public function getOperationLogsReport()
    {
        return [
            'report/operationlogs',
            'get'
        ];
    }

    public function getSignInSignOutActivityReport()
    {
        return [
            'report/activities',
            'get',
            [],
            true,
            'activity_logs'
        ];
    }

    public function getBillingReports()
    {
        return [
            'report/billing',
            'get'
        ];
    }

    public function getBillingInvoiceReports()
    {
        return [
            'report/billing/invoices',
            'get'
        ];
    }
}
