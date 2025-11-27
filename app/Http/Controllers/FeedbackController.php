<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Category;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Show the feedback form on the home page.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Store feedback in database.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'category.required' => 'Kategori harus dipilih',
            'category.max' => 'Kategori tidak valid',
            'message.required' => 'Pesan harus diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 5000 karakter',
        ]);

        // Check if category is numeric (category_id) or string (category name)
        if (is_numeric($request->category)) {
            // Find category by ID
            $category = Category::find($request->category);
            if ($category) {
                $validated['category_id'] = $request->category;
                unset($validated['category']);
            }
        } else {
            // Old format - find or create category by name
            $category = Category::firstOrCreate(
                ['name' => $request->category],
                ['description' => null]
            );
            $validated['category_id'] = $category->id;
            unset($validated['category']);
        }

        // Add IP address
        $validated['ip_address'] = $request->ip();

        // Save to database
        Feedback::create($validated);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Terima kasih, saran Anda telah diterima.'
        ]);
    }

    /**
     * Get all categories (for frontend form)
     */
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    /**
     * Get all feedbacks (for admin panel - optional)
     */
    public function all()
    {
        return response()->json(Feedback::latest()->get());
    }
}
