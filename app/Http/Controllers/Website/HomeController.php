<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {

        $products = Product::with('images')->get();

        return Inertia::render('Home', [
            'products' => $products,
        ]);
    }
}
