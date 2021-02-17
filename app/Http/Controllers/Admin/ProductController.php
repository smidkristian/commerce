<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Traits\UploadAble;
use Inertia\Inertia;

class ProductController extends Controller
{
    use UploadAble;

    public function index()
    {
        $brands = Brand::all();
        $products = Product::all();

        return Inertia::render('Admin/Products', [
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $this->customValidation($request);

        Product::create($request->except('id'));

        return Redirect::route('admin/products', ['message' => 'Saved.']);
    }

    public function update(Request $request)
    {
        $this->customValidation($request);

        $target = Product::find($request->id);

        $target->update($request->all());

        return Redirect::route('admin/products', ['message' => 'Updated.']);
    }

    public function destroy(Request $request)
    {
        Product::destroy($request->id);

        return Redirect::route('admin/products');
    }

    public function customValidation($product)
    {
        $product->validate([
            'name' => ['required'],
            'sku' => ['required'],
            'brand_id' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);
    }
}