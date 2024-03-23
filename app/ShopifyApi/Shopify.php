<?php

namespace App\ShopifyApi;

class Shopify
{
    /**
     * Instance of Shopify class.
     *
     * @var array
     */
    public static $instance;

    /**
     * It is not useful to construct this Shopify class everytime.
     * This helps to construct this class with the current config.
     */
    public static function __callStatic($method, $parameters)
    {
        // if there is not any constructed instance
        // construct and save it to self::$instance
        if (!self::$instance) {
            $apiKey = env('SHOPIFY_API_KEY') ? env('SHOPIFY_API_KEY') :  config('services.shopify.api_key');
            $apiPassword = env('SHOPIFY_API_PASSWORD') ? env('SHOPIFY_API_PASSWORD') :  config('services.shopify.api_password');
            $apiSharedSecret =  env('SHOPIFY_API_SHARED_SECRET')  ? env('SHOPIFY_API_SHARED_SECRET') :  config('services.shopify.api_shared_secret');
            $apiVersion = env('SHOPIFY_API_VERSION') ? env('SHOPIFY_API_VERSION') :  config('services.shopify.api_version');
            $shopHost = env('SHOPIFY_API_HOST') ? env('SHOPIFY_API_HOST') :  config('services.shopify.api_host');

            self::$instance = new ApiClient($apiKey, $apiPassword, $apiSharedSecret, $apiVersion, $shopHost);
        }

        return call_user_func_array([self::$instance, $method], $parameters);
    }
}
