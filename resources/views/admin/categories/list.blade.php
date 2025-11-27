@extends('admin.layout')

@section('title', 'Category Management')
@section('page-title', 'Category Management')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Manage Categories</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item">Dashboard</span>
        <span class="breadcrumb-item active">Categories</span>
    </div>
</div>

<!-- Add Category Card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">➕ Add New Category</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/categories/store">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g., Saran, Kritik, Pengaduan" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Brief description">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
    </div>
</div>

<!-- Categories List -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Categories List</h3>
    </div>
    <div class="card-body">
        @if($categories && count($categories) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Feedback Count</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ $category->feedbacks_count ?? 0 }}
                                </span>
                            </td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                            <td>
                                <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" 
                                        onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')">
                                    ✏️ Edit
                                </button>
                                <form method="POST" action="/admin/categories/{{ $category->id }}/delete" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Are you sure?');">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 40px; color: #7f8c8d;">
                <p>No categories found</p>
            </div>
        @endif
    </div>
</div>

<!-- Edit Modal (Hidden by default) -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="width: 500px;">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <form method="POST" id="editForm">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" id="editDescription" class="form-control">
                </div>
            </div>
            <div class="card-footer" style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-success">💾 Save</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function editCategory(id, name, description) {
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editForm').action = '/admin/categories/' + id + '/update';
    document.getElementById('editForm').method = 'POST';
    document.getElementById('editModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

@endsection
