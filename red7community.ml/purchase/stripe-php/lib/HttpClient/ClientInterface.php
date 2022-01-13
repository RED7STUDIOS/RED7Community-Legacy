<?php

namespace Stripe\HttpClient;

use Stripe\Error\Api;
use Stripe\Error\ApiConnection;

interface ClientInterface
{
    /**
     * @param string $method The HTTP method being used
     * @param string $absUrl The URL being requested, including domain and protocol
     * @param array $headers Headers to be used in the request (full strings, not KV pairs)
     * @param array $params KV pairs for parameters. Can be nested for arrays and hashes
     * @param boolean $hasFile Whether or not $params references a file (via an @ prefix or
     *                         CurlFile)
     * @return [$rawBody, $httpStatusCode, $httpHeader]
     * @throws Api & ApiConnection
     */
    public function request($method, $absUrl, $headers, $params, $hasFile);
}
