<?php

namespace App\Services\Product;

class ProductResponseCreate
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function make()
    {
        $productData = $this->data;

        $variants = [
            'price' => $productData->selling_price ?? null,
            'compare_at_price' => $productData->retail_price  ?? null,
            'weight' => $productData->weight ?? null,
            'weight_unit' => $productData->weight ? 'g' : null
        ];

        return [
            'product' => [
                'title' => $productData->title ?? null,
                'body_html' => $productData->description ?? null,
                'vendor' => $productData->brand ?? null,
                'product_type' => $productData->category ?? null,
                'variants' => [
                    $variants
                ]
            ]
        ];
    }
}
