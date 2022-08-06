<?php

namespace Uncgits\ZoomApi\Adapters;

use GuzzleHttp\Client;
use Uncgits\ZoomApi\ZoomApiConfig;
use Uncgits\ZoomApi\ZoomApiEndpoint;
use Uncgits\ZoomApi\Traits\ExecutesZoomApiCalls;

class Guzzle implements ZoomApiAdapterInterface
{
    use ExecutesZoomApiCalls;

    /*
    |--------------------------------------------------------------------------
    | Implementing ZoomApiAdapterInterface
    |--------------------------------------------------------------------------
    */

    public function call($endpoint, $method)
    {
        // params / body
        if (count($this->parameters) > 0) {
            if (strtolower($method) === 'get' || $this->urlEncodeParameters) {
                // this is to support include[] and similar...
                $string = http_build_query($this->parameters, null, '&');
                $string = preg_replace('/%5B\d+%5D=/', '%5B%5D=', $string);
                $requestOptions['query'] = $string;

            // GET requests that need pagination will pass params back in the query string of pagination headers.
                // $this->setParameters([]);
            } else {
                $requestOptions['json'] = $this->parameters;
            }
        }

        // set proxy settings. set explicitly to empty string if not being used.
        $requestOptions['proxy'] = $this->config->getProxy();

        // authentication
        $requestOptions['headers'] = [
            'Authorization' => 'Bearer ' . $this->config->getJwt(),
            'Content-Type'  => 'application/json'
        ];

        // additional headers
        if (count($this->additionalHeaders) > 0) {
            $requestOptions['headers'] = array_merge($requestOptions['headers'], $this->additionalHeaders);
        }

        // disable Guzzle exceptions. this class is responsible for providing an account of what happened, so we need
        // to get the response back no matter what.
        $requestOptions['http_errors'] = false;

        // instantiate Guzzle client
        $client = new Client($requestOptions);
        // perform the call
        $response = $client->$method($endpoint, $requestOptions);

        // normalize the result
        return $this->normalizeResult($endpoint, $method, $requestOptions, $response);
    }

    public function usingConfig(ZoomApiConfig $config)
    {
        $this->config = $config;
        return $this;
    }

    public function transaction(ZoomApiEndpoint $endpoint, $calls = [])
    {
        // set up
        $this->validateParameters($endpoint);
        // if not paginated, one call is sufficient.
        if (!$endpoint->paginated()) {
            $calls[] = $result = $this->call($endpoint->getEndpoint(), $endpoint->getMethod());
        } else {
            if (! is_null($endpoint->getEntityKey())) {
                $this->entity = $endpoint->getEntityKey();
            } else {
                $endpointBits = explode('/', $endpoint->getEndpoint());
                $this->entity = end($endpointBits); // for the nested array key
            }

            $perPage = $this->config->getPerPage();
            $currentPage = 1;
            $recordsRetrieved = 0;
            $maxRecords = $this->config->getMaxResults();
            $nextPageToken = null; // this is an alternate method of pagination that we need to be ready for...

            // otherwise we paginate, starting at 0 and getting $perPage records, and then we reset and do it again.
            do {
                $this->addParameters(['page_size' => $perPage]);

                // which page? depends on what method of pagination we are dealing with.
                if (is_null($nextPageToken)) {
                    $this->addParameters(['page_number' => $currentPage]);
                } else {
                    $this->removeParameter('page_number');
                    $this->addParameters(['next_page_token' => $nextPageToken]);
                }
                $calls[] = $result = $this->call($endpoint->getEndpoint(), $endpoint->getMethod());
                if ($result['response']['code'] >= 400) {
                    $continue = false;
                } else {
                    $recordsRetrieved += count($result['response']['body']->{$this->entity});
                    if (isset($result['response']['body']->next_page_token)) {
                        $nextPageToken = $result['response']['body']->next_page_token;
                        $continue = $nextPageToken !== '';
                    } else {
                        $currentPage++;
                        $continue = isset($result['response']['body']->page_count) && ($currentPage <= $result['response']['body']->page_count);
                        if ($maxRecords !== 0) {
                            $continue = $continue && $recordsRetrieved < $maxRecords;
                        }
                    }
                }
            } while ($continue);
        }

        // clean up
        $this->setParameters([]);
        $this->setRequiredParameters([]);
        $this->urlEncodeParameters = false;
        $this->withAuthorizationHeader = true;
        $this->entity = '';

        return $calls;
    }

    /**
     * Normalizes and formats API call information into an array for convenience
     *
     * @param string $endpoint
     * @param string $method
     * @param array $requestOptions
     * @param GuzzleHttp\Psr7\Response $response
     * @return void
     */
    public function normalizeResult($endpoint, $method, $requestOptions, $response)
    {
        return [
            'request' => [
                'endpoint'   => $endpoint,
                'query'      => $requestOptions['query'] ?? '',
                'method'     => $method,
                'headers'    => $requestOptions['headers'] ?? [],
                'proxy'      => $this->config->getProxy(),
                'parameters' => $this->parameters,
                'entity'     => $this->entity,
            ],
            'response' => [
                'headers'              => $response->getHeaders(),
                'code'                 => $response->getStatusCode(),
                'reason'               => $response->getReasonPhrase(),
                'body'                 => json_decode($response->getBody()->getContents())
            ],
        ];
    }
}
