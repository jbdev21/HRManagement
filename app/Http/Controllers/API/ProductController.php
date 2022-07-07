<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function search(Request $request){
        $products = Product::where("name", 'LIKE', "%$request->keyword%")->limit(10)->get();
        return ProductResource::collection($products);
    }
}
