<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function edit(Category $category)
    {
        // Display a form to edit a category
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('dashboard.show', $category->dashboard_id)->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.show', $category->dashboard_id)->with('success', 'Category deleted successfully!');
    }
}
