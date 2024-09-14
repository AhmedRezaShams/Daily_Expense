<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Display the categories page
    public function index(Request $request)
    {
        $categories = Category::where('created_by', Auth::user()->id)->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $existingCategory = Category::where('name', $request->name)->where('created_by', Auth::user()->id)->get()->first();
        if(isset($existingCategory)){
            return redirect()->back()->with('error', 'Category already exists!');
        }
        Category::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', "Category created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Catagory $catagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Edit a category (you can expand this later)
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $existingCategory = Category::where('id', '!=', $id)->where('name', $request->name)->where('created_by', Auth::user()->id)->get()->first();
        if(isset($existingCategory)){
            return redirect()->back()->with('error', 'Category already exists!');
        }
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', "Category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete a category
    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with('success', "Category deleted successfully.");
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $existingCategory = Category::where('id', '!=', $id)
                                    ->where('name', $category->name)
                                    ->where('created_by', Auth::user()->id)
                                    ->get()->first();
        if(isset($existingCategory)){
            return redirect()->back()->with('error', "Can't restore this category as same name already exists.");
        } else{
            $category->restore();
            return redirect()->back()->with('success', "Category restored successfully.");
        }
    }
    public function hardDelete($id)
    {
        Category::onlyTrashed()->find($id)->delete();
        return redirect()->back()->with('success', "Category permanently deleted successfully.");
    }
}
