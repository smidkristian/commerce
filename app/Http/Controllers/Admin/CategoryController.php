<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Categories', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/CategoryForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        Category::create($request->all());

        return Redirect::route('admin-categories');
    }

    public function edit($id)
    {
        $Category = Category::find($id);

        return Inertia::render('Admin/CategoryForm', [
            'category' => $Category
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'name' => ['required'],
        ]);

        $target = Category::find($request->id);

        $target->update($request->all());

        return Redirect::route('admin-categories');
    }

    public function destroy(Request $request)
    {
        Category::destroy($request->id);

        return Redirect::route('admin-categories');
    }
}
