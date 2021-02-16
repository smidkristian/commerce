<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductImage;
use App\Models\Product;
use App\Traits\UploadAble;

class ProductImageController extends Controller
{
    use UploadAble;

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $image = $this->uploadOne($request->file, 'product-images');

        $productImage = new ProductImage([
            'url'      =>  $image,
        ]);

        $product->images()->save($productImage);

        return 'Testing';
    }

    public function load(Request $request)
    {
        $product = Product::find($request->id);

        $images = $product->images;

        return $images;
    }
}
