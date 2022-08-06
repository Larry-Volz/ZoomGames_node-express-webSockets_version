<?php

namespace Uncgits\ZoomApi;

/**
 * Represents a set of results from the API, obtained via one or more API calls
 */
class ZoomApiResult
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    /**
     * The API calls that were made to get this resultset
     *
     * @var array
     */
    protected $calls = [];

    /**
     * The overall status of the API resultset
     *
     * @var string
     */
    protected $status = '';

    /**
     * Longer message representing the status of the API resultset
     *
     * @var string
     */
    protected $message = '';

    /**
     * The record count for paginated calls
     *
     * @var null
     */
    protected $recordCount = null;

    /**
     * A collection of Zoom Resources obtained in this resultset
     *
     * @var array
     */
    protected $content = [];

    /**
     * The pagination keys found in the body of a response. This will be used for both parsing and collecting results.
     *
     * @var array
     */
    protected $paginationParameters = [
        'page_count',
        'page_number',
        'page_size',
        'total_records'
    ];

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    /**
     * Get the API calls that were made to get this resultset
     *
     * @return  array
     */
    public function getCalls()
    {
        return $this->calls;
    }

    /**
     * Fluent alias for getCalls()
     *
     * @return array
     */
    public function calls()
    {
        return $this->getCalls();
    }

    /**
     * Get the last API call made for this resultset
     *
     * @return  array
     */
    public function getLastCall()
    {
        return $this->calls[] = array_pop($this->calls);
    }

    /**
     * Fluent alias for getLastCall()
     *
     * @return array
     */
    public function lastCall()
    {
        return $this->getLastCall();
    }

    /**
     * Get the first API call made for this resultset
     *
     * @return  array
     */
    public function getFirstCall()
    {
        return $this->calls[0];
    }

    /**
     * Fluent alias for getFirstCall()
     *
     * @return array
     */
    public function firstCall()
    {
        return $this->getFirstCall();
    }

    /**
     * Get the overall status of the API resultset
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Fluent alias for getStatus()
     *
     * @return array
     */
    public function status()
    {
        return $this->getStatus();
    }

    /**
     * Get longer message representing the status of the API resultset
     *
     * @return  string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Fluent alias for getMessage()
     *
     * @return array
     */
    public function message()
    {
        return $this->getMessage();
    }

    /**
     * Get content of the resultset
     *
     * @return  array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Fluent alias for getContent()
     *
     * @return array
     */
    public function content()
    {
        return $this->getContent();
    }

    /**
     * Gets the last code and message.
     *
     * @return array
     */
    public function getLastResult()
    {
        return [
            'code'   => $this->getLastCall()['response']['code'],
            'reason' => $this->getLastCall()['response']['reason']
        ];
    }

    /**
     * Fluent alias for getLastResult()
     *
     * @return array
     */
    public function lastResult()
    {
        return $this->getLastResult();
    }

    /**
     * Fluent shortcut to get last response code
     *
     * @return array
     */
    public function lastCode()
    {
        return $this->getLastResult()['code'];
    }

    /**
     * Fluent shortcut to get last response reason
     *
     * @return array
     */
    public function lastReason()
    {
        return $this->getLastResult()['reason'];
    }

    /**
     * Gets the record count (for paginated calls)
     *
     * @return void
     */
    public function getRecordCount()
    {
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     * Set the API calls that were made to get this resultset
     *
     * @param  array  $calls  The API calls that were made to get this resultset
     *
     * @return  self
     */
    public function setCalls(array $calls)
    {
        $this->calls = $calls;
        return $this;
    }

    /**
     * Set the overall status of the API resultset
     *
     * @param  string  $status  The overall status of the API resultset
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set longer message representing the status of the API resultset
     *
     * @param  string  $message  Longer message representing the status of the API resultset
     *
     * @return  self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function __construct(array $calls)
    {
        // set the calls
        $this->setCalls($calls);
        // parse calls to get results and content
        $this->parseCalls($calls);
    }

    public function parseCalls()
    {
        // parse content
        $failedCalls = [];

        foreach ($this->calls as $call) {
            if ($call['response']['code'] >= 400) {
                $failedCalls[] = $call;
                $this->content = $call['response']['body'];
            } else {
                if (isset($call['response']['body'])) {
                    $bodyContent = (array) $call['response']['body'];
                    $entity = $call['request']['entity'];
                    if (isset($bodyContent[$entity])) {
                        $this->content = array_merge($this->content, $bodyContent[$entity]);
                    } else {
                        $this->content = $bodyContent;
                    }
                }
            }
        }

        $this->status = empty($failedCalls) ? 'success' : 'error';
        $this->message = empty($failedCalls) ?
                count($this->calls) . ' call(s) successful.' :
                count($failedCalls) . ' call(s) had errors.';

        return $this;
    }
}
