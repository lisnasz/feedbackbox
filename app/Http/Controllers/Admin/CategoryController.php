<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:1000',
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
        ]);

        Category::create($request->only('name', 'description'));

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'nullable|max:1000',
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
        ]);

        $category->update($request->only('name', 'description'));

        return back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function delete(Category $category)
    {
        if ($category->feedbacks()->count() > 0) {
            return back()->withErrors(['message' => 'Tidak dapat menghapus kategori yang memiliki pengaduan']);
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
