<?php

namespace App\ShopifyApi;

class ProductApiClient extends ApiClient
{
    /**
     * Create Product.
     *
     * @param array $product Product details
     *
     * @see https://shopify.dev/docs/admin-api/rest/reference/products/product  Product
     *
     * @return object Response of shopify
     */
    public function create($product)
    {
        return $this->apiRequest('POST', 'products.json', [], [], $product);
    }

    /**
     * Update Product.
     *
     * @param string $productId product id of related product
     * @param array  $product      Product details
     *
     * @see https://shopify.dev/docs/admin-api/rest/reference/products/product  Product
     *
     * @return object Response of shopify
     */
    public function update($productId, $product)
    {
        return $this->apiRequest('PUT', "products/$productId.json", $product);
    }

    /**
     * Get products list.
     *
     * @param array $parameters Query parameters
     *
     * @return object Response of shopify
     */

    public function get($parameters = [])
    {
        return $this->apiRequest('GET', 'products.json', $parameters, [], []);
    }

    /**
     * Get a Single Product.
     *
     * @param array $parameters Query parameters
     *
     * @return object Response of shopify
     * example = find('6669138165966', ['fields' => 'id,title'])
     */

    public function find($productId, $parameters)
    {
        return $this->apiRequest('GET', "products/$productId.json", $parameters, [], []);
    }

    /**
     * Insert image to specific product.
     *
     * @param array $parameters Query parameters
     *
     * @return object Response of shopify
     * example = find('6669138165966', ['fields' => 'id,title'])
     */

    public function insertImage($productId, $parameters = [])
    {
        return $this->apiRequest("POST", "products/$productId/images.json", $parameters, [], []);
    }
}
