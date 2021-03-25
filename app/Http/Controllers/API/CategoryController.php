<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // all categorys
    public function index()
    {
        $categorys = Category::all()->toArray();
        return array_reverse($categorys);
    }

    // add category
    public function store(Request $request)
    {
        $category = new Category([
            'name' => $request->name,
        ]);
        $category->save();

        return response()->json('The Category successfully added');
    }

    // edit category
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    // update category
    public function update(Category $category, Request $request)
    {
        $category->update($request->all());

        return response()->json('The Category successfully updated');
    }

    // delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json('The Category successfully deleted');
    }
}
