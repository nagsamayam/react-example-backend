<?php

declare(strict_types=1);

namespace Domain\Products\V1\Dtos;

use App\Http\Requests\Products\V1\ProductRequest;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public string $image,
        public float $price,
    ) {
    }

    public static function fromRequest(ProductRequest $request): self
    {
        return new self(
            title: $request->input('title'),
            description: $request->input('description'),
            image: $request->input('image'),
            price: (float) $request->input('price'),
        );
    }
}
