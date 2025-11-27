<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Category;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with('category')->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $feedbacks = $query->paginate(10);
        $categories = Category::all();

        return view('admin.feedback.index', compact('feedbacks', 'categories'));
    }

    public function show(Feedback $feedback)
    {
        $feedback->load('category');
        return view('admin.feedback.show', compact('feedback'));
    }

    public function updateStatus(Request $request, Feedback $feedback)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        $feedback->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function addResponse(Request $request, Feedback $feedback)
    {
        $request->validate([
            'admin_response' => 'required|min:10',
        ], [
            'admin_response.required' => 'Tanggapan wajib diisi',
            'admin_response.min' => 'Tanggapan minimal 10 karakter',
        ]);

        $feedback->update([
            'admin_response' => $request->admin_response,
            'status' => 'diproses',
        ]);

        return back()->with('success', 'Tanggapan berhasil ditambahkan');
    }

    public function delete(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedback.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
