<?php

namespace App\Http\Controllers\Landings;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingProductController extends Controller
{
    //

    public function index($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('landings.military.pages.product.index')->with('product', $product);
    }
}
