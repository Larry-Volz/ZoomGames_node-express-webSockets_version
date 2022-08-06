<?php

namespace Uncgits\ZoomApi;

class ZoomApiEndpoint
{
    /**
     * The assembled endpoint to be called
     *
     * @var string
     */
    protected $endpoint;

    /**
     * The HTTP method to use (get, post, etc.)
     *
     * @var string
     */
    protected $method;


    /**
     * Any required properties for this endpoint, in dot notation
     *
     * @var array
     */
    protected $requiredParameters;

    /**
     * Whether the call requires pagination
     *
     * @var bool
     */
    protected $paginated;

    /**
     * The key where the records are located in the response. Default will attempt to infer it from the endpoint.
     *
     * @var string | null
     */
    protected $entityKey;

    public function __construct(string $endpoint, string $method, array $requiredParameters = [], bool $paginated = false, string $entityKey = null)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->requiredParameters = $requiredParameters;
        $this->paginated = $paginated;
        $this->entityKey = $entityKey;
    }

    /**
     * Get the value of endpoint
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Get the value of method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the value of requiredParameters
     */
    public function getRequiredParameters()
    {
        return $this->requiredParameters;
    }

    public function getPaginated()
    {
        return $this->paginated;
    }

    // alias
    public function paginated()
    {
        return $this->getPaginated();
    }

    public function getEntityKey()
    {
        return $this->entityKey;
    }

    public function setFinalEndpoint(ZoomApiConfig $config)
    {
        // assemble the final request URI from host and endpoint
        // if (!$this->rawEndpoint) {
        $this->endpoint = 'https://' . $config->getApiHost() . $config->getPrefix() . $this->endpoint;
        // }

        return $this;
    }
}
