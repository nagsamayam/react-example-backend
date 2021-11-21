<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\V1\ImageUploadRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $file = $request->file('image');
        $name = Str::random(10);
        $url = Storage::disk('public')->putFileAs('images', $file, $name . '.' . $file->extension());

        return response([
            'url' => asset('storage/' . $url)
        ], Response::HTTP_CREATED);
    }
}
