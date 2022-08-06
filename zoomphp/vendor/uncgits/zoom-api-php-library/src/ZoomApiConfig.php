<?php

namespace Uncgits\ZoomApi;

use Firebase\JWT\JWT;
use Uncgits\ZoomApi\Exceptions\ZoomApiConfigException;

abstract class ZoomApiConfig
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    |
    | Environment, Authentication, and Configuration information for the client.
    | Set these values in a script or a wrapper for whatever framework you're
    | using.
    |
    */

    /**
     * The host domain for the API, without protocols (default is api.zoom.us/v2)
     *
     * @var string
     */
    private $apiHost = 'api.zoom.us/';

    /**
     * The API prefix (default is none for current version of the Zoom REST API)
     *
     * @var string
     */
    private $prefix = 'v2/';

    /**
     * The API key to be used in calling the API
     *
     * @var string
     */
    private $apiKey = null;

    /**
     * The API secret to be used in calling the API
     *
     * @var string
     */
    private $apiSecret = null;

    /**
     * The JWT token to be used in calling the API - can be set directly or retrieved
     *
     * @var string
     */
    private $jwt = null;


    /**
     * The host for the HTTP proxy to be used
     *
     * @var string
     */
    private $proxyHost = null;

    /**
     * The port for the HTTP proxy to be used
     *
     * @var string
     */
    private $proxyPort = null;

    /**
     * Whether to use the HTTP proxy when calling the API
     *
     * @var boolean
     */
    private $useProxy = false;

    /**
     * Fixed limit on the number of results to return from the API. 0 is unlimited.
     *
     * @var integer
     */
    private $maxResults = 0;


    /**
     * Number of results to return per page. Default from Zoom is 500.
     *
     * @var integer
     */
    private $perPage = 500;


    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     * @param string $apiHost
     * @return self
     */
    public function setApiHost($apiHost)
    {
        // strip protocol if provided
        $this->apiHost = preg_replace("(^https?://)", "", $apiHost);
        return $this;
    }
    /**
     * @param  string  $prefix
     * @return  self
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return self
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @param string $apiSecret
     * @return self
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    /**
     * @param string $jwt
     * @return self
     */
    public function setJwt($jwt)
    {
        $this->jwt = $jwt;
        return $this;
    }

    /**
     * @param mixed $proxyHost
     * @return self
     */
    public function setProxyHost($proxyHost)
    {
        // strip protocol if provided
        $this->proxyHost = preg_replace("(^https?://)", "", $proxyHost);
        return $this;
    }

    /**
     * @param string $proxyPort
     * @return self
     */
    public function setProxyPort(string $proxyPort)
    {
        $this->proxyPort = $proxyPort;
        return $this;
    }

    /**
     * @param boolean $useProxy
     * @return self
     */
    public function setUseProxy(bool $useProxy)
    {
        $this->useProxy = ($useProxy === true);
        return $this;
    }

    /**
     * @param int $maxResults
     * @return self
     */
    public function setMaxResults(int $maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * Set number of results to return per page. Default is 500.
     *
     * @param  integer  $perPage  Number of results to return per page. Default is 500.
     *
     * @return  self
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    /**
     * Get the host domain for the API, without protocols (default is api.zoom.us/v2)
     *
     * @return  string
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }

    /**
     * Get the API prefix (default is for V1 of the Zoom REST API)
     *
     * @return  string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get the API key to be used in calling the API
     *
     * @return  string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get the API private key to be used in calling the API
     *
     * @return  string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Get the JWT to be used in calling the API
     *
     * @return  string
     */
    public function getJwt()
    {
        return $this->jwt;
    }

    /**
     * Get the host for the HTTP proxy to be used
     *
     * @return  string
     */
    public function getProxyHost()
    {
        return $this->proxyHost;
    }

    /**
     * Get whether to use the HTTP proxy when calling the API
     *
     * @return  boolean
     */
    public function getUseProxy()
    {
        return $this->useProxy;
    }

    /**
     * Shortcut to get the formatted proxy string
     *
     * @return  string
     */
    public function getProxy()
    {
        return $this->useProxy ?
            $this->proxyHost . ':' . $this->proxyPort :
            '';
    }

    /**
     * Get fixed limit on the number of results to return from the API. 0 is unlimited.
     *
     * @return  integer
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * Get number of results to return per page. Default from Zoom is 500.
     *
     * @return  integer
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * fetches and stores a new JWT API Token based on the key/secret
     *
     * @return void
     */
    public function refreshToken($ttlSeconds = 3600)
    {
        if (is_null($this->apiKey) || is_null($this->apiSecret)) {
            throw new ZoomApiConfigException('Cannot generate a JWT without a key/secret');
        }

        $tokenExpirationTimestamp = time() + $ttlSeconds;

        $payload = [
            'iss' => $this->apiKey,
            'exp' => $tokenExpirationTimestamp
        ];

        $jwt = JWT::encode($payload, $this->apiSecret);

        $this->setJwt($jwt);

        return $jwt;
    }
}
