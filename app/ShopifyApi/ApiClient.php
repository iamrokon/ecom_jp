<?php

namespace App\ShopifyApi;

use GuzzleHttp\Client;

/**
 * ApiClient is a simple class for sending requests to Shopify API.
 *
 * This class aims to handle some APIs of ShopifyApi
 *
 * Note: This class does not cover whole Shopify API, it covers just a couple of things
 * in Shopify API like products and orders.
 *
 * @author   Maruf Islam <marufislam7424@gmail.com>
 *
 * @version  0.1
 *
 * @see https://shopify.dev/docs/admin-api/rest/reference
 */
class ApiClient
{


    /**
     * The Shopify API key.
     *
     * @var string
     */
    public $apiKey;

    /**
     * The Shopify API password.
     *
     * @var string
     */
    public $apiPassword;

    /**
     * The Shopify API Generated Url.
     *
     * @var string
     */
    public $apiUrl;

    /**
     * The Shopify API version.
     *
     * @var string
     */
    public $apiVersion;


    /**
     * The Shopify API Shared Secret.
     *
     * @var string
     */
    public $apiSharedSecret;

    /**
     * The Shopify API Shop Host.
     *
     * @var string
     */
    public $shopHost;

    /**
     * Global queries to apply every requests.
     *
     * @var array
     */
    public $globalQuery = [];
    /**
     * Guzzle client options.
     * Can be used to test class or process.
     *
     * @var array
     */
    public $clientOptions = [];

    /**
     * Create a new Shopify API interface instance.
     *
     * @param string $apiKey
     * @param string $apiPassword
     * @param string $apiVersion
     * @param string $apiSharedSecret
     * @param string $shopHost
     *
     * @return void
     */
    public function __construct($apiKey = null, $apiPassword = null, $apiVersion = null, $apiSharedSecret = null, $shopHost = null)
    {
        $this->apiKey = $apiKey ? env('SHOPIFY_API_KEY') :  config('services.shopify.api_key');
        $this->apiPassword = $apiPassword ? env('SHOPIFY_API_PASSWORD') :  config('services.shopify.api_password');
        $this->apiSharedSecret = $apiSharedSecret ? env('SHOPIFY_API_SHARED_SECRET') :  config('services.shopify.api_shared_secret');
        $this->apiVersion = $apiVersion ? env('SHOPIFY_API_VERSION') :  config('services.shopify.api_version');
        $this->shopHost = $shopHost ? env('SHOPIFY_API_HOST') :  config('services.shopify.api_host');
        $this->apiUrl = "https://" . $this->apiKey . ":" . $this->apiPassword . "@" . $this->shopHost . "/admin/api/" . $this->apiVersion . "/";
    }

    /**
     * Send a request to Shopify API with given parameters.
     *
     * @param string $method         Method of HTTP request like PUT, GET, POST etc.
     * @param string $path           Path of API
     * @param string $query          Query parameters
     * @param string $formParameters Form parameters
     * @param string $jsonPayload    Json payload
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function apiRequest($method, $path, $query = [], $formParameters = [], $jsonPayload = [])
    {
        // prepare guzzle options
        $clientOptions = $this->clientOptions ?:  ['base_uri' => $this->apiUrl];

        // create guzzle instance
        $client = new Client($clientOptions);

        // delete first slash character
        $path = ltrim($path, '/');

        // prepare options
        $options = [
            'query' => $this->globalQuery
        ];

        // set parameters
        $options['query'] = array_merge($options['query'], $query);

        if ($formParameters) {
            $options['form_params'] = $formParameters;
        }

        if ($jsonPayload) {
            $options['json'] = $jsonPayload;
        }
        // send request and get response
        $response = $client->request($method, $path, $options);

        // convert it to object
        return $this->handleResponse($response);
    }

    /**
     * Set guzzle client options.
     *
     * @param array $options Guzzle client options
     *
     * @see http://docs.guzzlephp.org/en/latest/quickstart.html Quickstart
     * @see http://docs.guzzlephp.org/en/latest/testing.html Testing
     *
     * @return void
     */
    public function setClientOptions($options)
    {
        return $this->clientOptions = $options;
    }

    /**
     * Set global query items.
     *
     * @param array $query Queries like ['mode' => 'test']
     *
     * @return void
     */
    public function setGlobalQuery($query)
    {
        return $this->globalQuery = $query;
    }

    /**
     * Handle JSON response and convert it to array.
     *
     * @param \GuzzleHttp\Psr7\Response $response Guzzle response
     *
     * @return object
     */
    protected function handleResponse($response)
    {
        $message = $response->getBody()->getContents();
        // json decode
        // we assume shopify sends always json
        return json_decode($message);
    }

    // API methods

    /**
     * Get the shop with the given id.
     *
     * @param array      $parameters Query Parameters
     *
     * @return object Response of shopify
     */
    public function getShop($parameters = [])
    {
        return $this->apiRequest('GET', 'shop.json', $parameters, [], []);
    }

    public function registerWebHook($parameters)
    {
        return $this->apiRequest("POST", "webhook.json", $parameters, [], []);
    }
}
