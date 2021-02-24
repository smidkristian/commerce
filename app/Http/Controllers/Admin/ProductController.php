<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;

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
        $products = Product::orderBy('id', 'desc')->get();

        return Inertia::render('Admin/Products', [
            'brands' => $brands,
            'products' => $products
        ]);
    }


    public function create()
    {
        $brands = Brand::all();

        return Inertia::render('Admin/ProductForm', [
            'brands' => $brands
        ]);
    }

    public function store(Request $request)
    {
        $this->customValidation($request);

        $newProduct = Product::create($request->all());

        return Redirect::route('admin-products', ['message' => 'Created.']);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $images = $product->images()->get();
        $brands = Brand::all();

        return Inertia::render('Admin/ProductForm', [
            'brands' => $brands,
            'product' => $product,
            'images' => $images
        ]);
    }

    public function update(Request $request)
    {
        $this->customValidation($request);

        $target = Product::find($request->id);

        $target->update($request->all());

        return Redirect::route('admin-products', ['message' => 'Updated.']);
    }

    public function destroy(Request $request)
    {
        Product::destroy($request->id);

        return Redirect::route('admin-products', ['message' => 'Deleted.']);
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
