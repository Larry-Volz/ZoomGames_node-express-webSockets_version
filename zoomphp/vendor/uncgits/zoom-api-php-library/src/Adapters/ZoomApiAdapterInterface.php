<?php

namespace Uncgits\ZoomApi\Adapters;

use Uncgits\ZoomApi\ZoomApiEndpoint;
use Uncgits\ZoomApi\Exceptions\ZoomApiParameterException;

interface ZoomApiAdapterInterface
{
    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     * Set $additionalHeaders
     *
     * @param  array  $additionalHeaders  Additional headers to send with the call.
     * @return  self
     */
    public function setAdditionalHeaders(array $additionalHeaders);

    /**
     * Set $parameters
     *
     * @param  array  $parameters - refer to the API documentation for the requirements of each call
     * @return  self
     */
    public function setParameters(array $parameters);

    /**
     * Set $requiredParameters
     *
     * @param  array  $requiredParameters - refer to the API documentation for the requirements of each call
     * @return  self
     */
    public function setRequiredParameters(array $requiredParameters);

    /**
     * How to tell the Adapter to not add the Authorization / Bearer header
     *
     * @return self
     */
    public function withoutAuthorizationHeader();

    /**
     * Method for telling the Adapter to URL-encode parameters
     *
     * @return self
     */
    public function urlEncodeParameters();

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    /**
     * Get current parameter set
     *
     * @return  array
     */
    public function getParameters();

    /**
     * Get current config
     *
     * @return  ZoomApiConfig
     */
    public function getConfig();

    /*
    |--------------------------------------------------------------------------
    | User-callable methods
    |--------------------------------------------------------------------------
    */

    /**
     * Adds a parameter to the current call stack, without completely overwriting existing parameters
     *
     * @param array $parameters
     * @return self
     */
    public function addParameters(array $parameters);

    /**
     * Gets one single parameter, if it exists
     *
     * @param mixed $key
     * @return mixed
     */
    public function getParameter($key);

    /**
     * Removes one single parameter, if it exists
     *
     * @param mixed $key
     * @return mixed
     */
    public function removeParameter($key);

    /*
    |--------------------------------------------------------------------------
    | API Call methods
    |--------------------------------------------------------------------------
    */

    /**
     * Make a single API call. Responsible for returning results of normalizeResult(), to pass back call result as array
     *
     * @param mixed $endpoint
     * @param mixed $method
     * @return array
     */
    public function call($endpoint, $method);

    /**
     * Performs an API transaction (one or more calls). Responsible for setup, pagination, and teardown. Returns an
     *   array of normalized calls.
     *
     * @param ZoomApiEndpoint $endpoint
     * @param mixed $calls
     * @return array
     */
    public function transaction(ZoomApiEndpoint $endpoint, $calls = []);

    /**
     * Fluent alias for calling transaction() for a GET operation
     *
     * @param mixed $endpoint
     * @return array
     */
    public function get($endpoint);

    /**
     * Fluent alias for calling transaction() for a POST operation
     *
     * @param mixed $endpoint
     * @return array
     */
    public function post($endpoint);

    /**
     * Fluent alias for calling transaction() for a PATCH operation
     *
     * @param mixed $endpoint
     * @return array
     */
    public function patch($endpoint);

    /**
     * Fluent alias for calling transaction() for a PUT operation
     *
     * @param mixed $endpoint
     * @return array
     */
    public function put($endpoint);

    /**
     * Fluent alias for calling transaction() for a DELETE operation
     *
     * @param mixed $endpoint
     * @return array
     */
    public function delete($endpoint);

    /**
     * Normalizes and formats API call information into an array for convenience
     *
     * @param string $endpoint
     * @param string $method
     * @param array $requestOptions
     * @param mixed $response
     * @return array
     */
    public function normalizeResult($endpoint, $method, $requestOptions, $response);

    /**
     * Validates the parameters for the call, ensuring all required parameters are set in $parameters property
     *
     * @param ZoomApiEndpoint $endpoint
     * @throws ZoomApiParameterException
     * @return void
     */
    public function validateParameters(ZoomApiEndpoint $endpoint);
}
