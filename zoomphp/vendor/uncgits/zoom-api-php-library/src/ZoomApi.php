<?php

namespace Uncgits\ZoomApi;

use Uncgits\ZoomApi\Traits\SetsCallParameters;
use Uncgits\ZoomApi\Clients\ZoomApiClientInterface;
use Uncgits\ZoomApi\Adapters\ZoomApiAdapterInterface;
use Uncgits\ZoomApi\Exceptions\ZoomApiClientException;
use Uncgits\ZoomApi\Exceptions\ZoomApiConfigException;
use Uncgits\ZoomApi\Exceptions\ZoomApiAdapterException;

class ZoomApi
{
    use SetsCallParameters;

    protected $client;
    protected $adapter;
    protected $config;

    protected $tempClient;

    public function __construct(array $setup = [])
    {
        $this->setClient($setup['client'] ?: null);
        $this->setAdapter($setup['adapter'] ?: null);
        $this->setConfig($setup['config'] ?: null);
    }

    public function setClient($client)
    {
        if (is_null($client)) {
            return;
        }

        if (is_string($client) && class_exists($client)) {
            $client = new $client;
        }

        if ($client instanceof ZoomApiClientInterface) {
            $this->client = $client;
            return $this;
        }

        throw new ZoomApiClientException('Unknown or invalid Zoom API Client class.');
    }

    public function setAdapter($adapter)
    {
        if (is_null($adapter)) {
            return;
        }


        if (is_string($adapter) && class_exists($adapter)) {
            $adapter = new $adapter;
        }

        if ($adapter instanceof ZoomApiAdapterInterface) {
            $this->adapter = $adapter;
            return $this;
        }

        throw new ZoomApiAdapterException('Unknown or invalid Zoom API Adapter.');
    }

    public function setConfig($config)
    {
        if (is_null($config)) {
            return;
        }

        if (is_string($config) && class_exists($config)) {
            $config = new $config;
        }

        if (is_a($config, ZoomApiConfig::class)) {
            $this->config = $config;
            return $this;
        }

        throw new ZoomApiConfigException('Client class must receive ZoomApiConfig object or class name in constructor');
    }

    public function using($client)
    {
        // assume default client location in package unless we were given something that looks namespaced
        if (strpos($client, '\\') === false) {
            $client = '\\Uncgits\\ZoomApi\\Clients\\' . str_replace(' ', '', ucwords($client));
        }

        if (!class_exists($client)) {
            throw new \Exception('Client class ' . $client . ' not found');
        }

        $this->tempClient = new $client;
        return $this;
    }

    public function refreshToken()
    {
        // implementation of this should reside with caller
    }

    public function __call($method, $arguments)
    {
        // determine active client
        $activeClient = $this->tempClient ?: $this->client;

        // do we have a valid client set?
        if (is_null($activeClient)) {
            throw new ZoomApiClientException('Client is not set on API class');
        }

        $this->tempClient = null; // reset

        $endpointParameters = $activeClient->$method(...$arguments);
        $endpoint = (new ZoomApiEndpoint(...$endpointParameters))
        ->setFinalEndpoint($this->config);

        return $this->execute($activeClient, $endpoint, $method, $arguments);
    }

    public function execute(ZoomApiClientInterface $client, ZoomApiEndpoint $endpoint, $method, $arguments)
    {
        return new ZoomApiResult($this->adapter->usingConfig($this->config)->transaction($endpoint));
    }
}
