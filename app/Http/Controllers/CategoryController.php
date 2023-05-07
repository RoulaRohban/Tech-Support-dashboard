<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index' , compact('categories'));
    }
    public function create(){
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request){
        $validated_date = $request->validated();
        Category::create($validated_date);
        return redirect(route('categories.index'))->with('message', 'Created!');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request,$id){
        $category = Category::findOrFail($id);
        $validated_date = $request->validated();
        $category->update($validated_date);
        return redirect(route('categories.index'))->with('message', 'Updated!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $category = Category::findOrFail($id);
            $deleted =  $category->delete();
            if ($deleted) {
                return response()->json(['status' => 'success', 'message' => 'deleted_successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'fail_while_delete']);
            }
        }
        return redirect()->route('categories.index');
    }
}

