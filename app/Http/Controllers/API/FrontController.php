<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function categories(){
        return Category::latest()->get()->toArray();
    }
    public function products(){
        return Product ::latest()->get()->toArray();
    }
    public function category(Category $category){
        return $category->with('products')->first()->toArray();
    }
    public function product($slug){
        return Product::whereSlug($slug)->with('category')->first()->toArray();

    }
}