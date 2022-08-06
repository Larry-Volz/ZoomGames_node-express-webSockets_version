<?php

namespace Uncgits\ZoomApi\Traits;

use Uncgits\ZoomApi\ZoomApiConfig;
use Uncgits\ZoomApi\ZoomApiEndpoint;
use Uncgits\ZoomApi\Exceptions\ZoomApiParameterException;

trait ExecutesZoomApiCalls
{
    /*
    |--------------------------------------------------------------------------
    | Implementation of ZoomApiAdapterInterface
    |--------------------------------------------------------------------------
    */

    /**
     * The ZoomApiConfig object used to make API calls.
     *
     * @var ZoomApiConfig
     */
    protected $config;

    /**
     * Additional headers to send with the call.
     *
     * @var array
     */
    protected $additionalHeaders = [];

    /**
     * Parameters (arguments) to include in the call. For GET requests, these will be sent in the query string.
     *   For POST requests, these will be sent in the body.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * The parameters required by the Zoom API. If these parameters are not set before making the call, a
     *   ZoomApiParameterException will be thrown.
     *
     * @var array
     */
    protected $requiredParameters = [];

    /**
     * Whether to use the Authorization / Bearer header. Default to true but some calls can disable.
     *
     * @var boolean
     */
    protected $withAuthorizationHeader = true;

    /**
     * Override for whether to URL-encode the parameters instead of putting them in the body.
     *
     * @var boolean
     */
    protected $urlEncodeParameters = false;

    /**
     * Entity name to be used to grab relevant content during pagiation
     *
     * @var string
     */
    protected $entity = '';

    public function setAdditionalHeaders(array $additionalHeaders)
    {
        $this->additionalHeaders = $additionalHeaders;
        return $this;
    }

    public function addHeaders(array $headers)
    {
        $this->additionalHeaders = array_merge($this->additionalHeaders, $headers);
        return $this;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function setRequiredParameters(array $requiredParameters)
    {
        $this->requiredParameters = $requiredParameters;
        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function addParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
        return $this;
    }

    public function withoutAuthorizationHeader()
    {
        $this->withAuthorizationHeader = false;
        return $this;
    }

    public function urlEncodeParameters()
    {
        $this->urlEncodeParameters = true;
        return $this;
    }

    public function getParameter($key)
    {
        return $this->parameters[$key] ?? null;
    }

    public function removeParameter($key)
    {
        if (isset($this->parameters[$key])) {
            unset($this->parameters[$key]);
        }
        return $this;
    }

    public function get($endpoint)
    {
        $this->checkConfig();
        return $this->transaction($endpoint, 'get');
    }

    public function post($endpoint)
    {
        $this->checkConfig();
        return $this->transaction($endpoint, 'post');
    }

    public function patch($endpoint)
    {
        $this->checkConfig();
        return $this->transaction($endpoint, 'patch');
    }

    public function put($endpoint)
    {
        $this->checkConfig();
        return $this->transaction($endpoint, 'put');
    }

    public function delete($endpoint)
    {
        $this->checkConfig();
        return $this->transaction($endpoint, 'delete');
    }

    public function validateParameters(ZoomApiEndpoint $endpoint)
    {
        // flatten out params array to dot notation for easy checking
        $missingRequiredParameters = array_diff($endpoint->getRequiredParameters(), array_keys($this->parameters));

        $missingRequiredParametersBracketed = [];
        if (!empty($missingRequiredParameters)) {
            foreach ($missingRequiredParameters as $parameter) {
                $segments = explode('.', $parameter);
                $bracketedName = $segments[0];

                for ($i = 1; $i < count($segments); $i++) {
                    if (isset($segments[$i])) {
                        $bracketedName .= "[{$segments[$i]}]";
                    }
                }
                $missingRequiredParametersBracketed[] = $bracketedName;
            }
            throw new ZoomApiParameterException('Missing required parameter(s) \''
                . implode(',', $missingRequiredParametersBracketed) . '\'');
        }
    }
}
