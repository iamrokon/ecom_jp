<?php

namespace App\Services\Product;

use App\ShopifyApi\ProductApiClient;
use Exception;

class ProductCreator
{
    public $productApi;

    public function __construct(ProductApiClient $productApi)
    {
        $this->productApi = $productApi;
    }
    public function process($data)
    {
        try {
            $resource =  $this->productApi->create((new ProductResponseCreate(request()->all()))->make());
            $productId = $resource->product->id;
            $images = request()->document;
            if ($images) {
                foreach ($images as $key =>  $image) {
                    $this->productApi->insertImage($productId, (new ImageResponseCreate($image, $key + 1))->make());
                }
            }
        } catch (Exception $exception) {
            dd($exception);
        }
    }
}
