<?php

namespace App\Services\Product;

use Illuminate\Support\Facades\Storage;

class ImageResponseCreate
{
    public $url;
    public $positon;

    public function __construct($url, $positon = 1)
    {
        $this->url = $url;
        $this->positon = $positon;
    }

    public function make()
    {

        $url = asset(Storage::url("product/images/$this->url"));
        return [
            'image' => [
                'position' => $this->positon,
                'src' => $url
            ]
        ];
    }
}
