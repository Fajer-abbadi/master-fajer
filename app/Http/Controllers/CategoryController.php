<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // عرض كل التصنيفات
    public function index()
    {
        $categories = Category::all(); // تأكد من وجود بيانات
        // dd($categories); // اعرض البيانات للتأكد من وجودها
        return view('categories.index', compact('categories'));
    }


    // عرض صفحة إنشاء تصنيف جديد
    public function create()
    {
        return view('categories.create');
    }

    // تخزين التصنيف الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // عرض تفاصيل تصنيف معين
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // عرض صفحة تعديل تصنيف
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // تحديث تصنيف معين
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // حذف تصنيف معين
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

