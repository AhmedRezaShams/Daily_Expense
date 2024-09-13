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

        Category::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id
        ]);

        return response()->json([
            'success' => 'Category created successfully.'
        ]);
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
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|max:255'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => 'Category updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete a category
    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json([
            'success' => 'Category deleted successfully.'
        ]);
    }
}
