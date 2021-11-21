<?php

declare(strict_types=1);

namespace Domain\Products\V1\Actions;

use Domain\Products\Models\Product;
use Domain\Products\V1\Dtos\ProductData;

class UpdateProductAction
{

    public function __invoke(Product $product, ProductData $productData): Product
    {
        $product->update([
            'title' => $productData->title,
            'description' => $productData->description,
            'image' => $productData->image,
            'price' => $productData->price,
        ]);

        return $product;
    }
}
