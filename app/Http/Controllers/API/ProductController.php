<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // all products
    public function index()
    {
        $products = Product::where('user_id',auth()->user()->id)->with('category')->latest()->get()->toArray();
        return $products;;
    }

    // add product
    public function store(Request $request)
    {
        $image = $request->file('image');
   
        $imageName = rand(1,99).time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);
        $slug=Str::slug($request->name);
        if(Product::whereSlug($slug)->first()){
            $slug=$slug.rand(100,999);
        }
        $product = new Product([
            'name' => $request->name,
            "user_id"=>auth()->user()->id,
            "category_id"=>$request->category_id,
            "description"=>$request->description,
            "short_description"=>$request->short_description,
            "price"=>$request->price,
            "image"=>$imageName,
            "slug"=>$slug

        ]);
        $product->save();

        return response()->json('The Product successfully added');
    }

    // edit product
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    // update product
    public function update(Product $product, Request $request)
    {
       $imageName=$product->image;
        if($request->file('image')){
            $image = $request->file('image');
            $imageName = rand(1,99).time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);
        }
        $product->update([
            'name' => $request->name,
            "category_id"=>$request->category_id,
            "description"=>$request->description,
            "short_description"=>$request->short_description,
            "price"=>$request->price,
            "image"=>$imageName,

        ]);
        return response()->json('The Product successfully updated');
    }

    // delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json('The Product successfully deleted');
    }
}
