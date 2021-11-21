<?php

declare(strict_types=1);

namespace Domain\Products\V1\Actions;

use Domain\Products\Models\Product;
use Domain\Products\V1\Dtos\ProductData;

class CreateNewProductAction
{

    public function __invoke(ProductData $productData): Product
    {
        $product = Product::create([
            'title' => $productData->title,
            'description' => $productData->description,
            'image' => $productData->image,
            'price' => $productData->price,
        ]);

        return $product;
    }
}
