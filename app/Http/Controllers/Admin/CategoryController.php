<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('updated_at','desc')->get();
        $subCatsIds = Category::where('type','!=',0)->pluck('type')->toArray();
        $subCategories = Category::whereIn('id',$subCatsIds)->get();
//        dd($subCategories);
        return view('admin.categories.categories', compact('categories', 'subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.createCategory', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type = $request->parent;
        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Category Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $allCategories = Category::all();
        return view('admin.categories.editCategory', compact('allCategories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type = $request->parent;
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Category Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $category_id = $request->id;
            Category::destroy($category_id);
            return redirect()->route('admin.categories.index')->with('delete', 'Category /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
