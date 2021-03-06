<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();

        return Inertia::render('Admin/Brands', [
            'brands' => $brands,
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/BrandForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        Brand::create($request->all());

        return Redirect::route('admin-brands');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);

        return Inertia::render('Admin/BrandForm', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'name' => ['required'],
        ]);

        $target = Brand::find($request->id);

        $target->update($request->all());

        return Redirect::route('admin-brands');
    }

    public function destroy(Request $request)
    {
        Brand::destroy($request->id);

        return Redirect::route('admin-brands');
    }
}
