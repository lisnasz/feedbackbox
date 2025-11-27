@extends('admin.layout')

@section('title', 'Feedback Management')
@section('page-title', 'Feedback Management')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Manage Feedback</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item">Dashboard</span>
        <span class="breadcrumb-item active">Feedback</span>
    </div>
</div>

<!-- Filters -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">🔍 Filter & Search</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="form-row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <div class="form-group">
                <label class="form-label">Search by Name/Email</label>
                <input type="text" name="search" class="form-control" placeholder="Enter name or email..." value="{{ request('search') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    🔍 Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Feedback List -->
<div class="card">
    <div class="card-header" style="justify-content: space-between;">
        <h3 class="card-title">Feedback List ({{ $feedbacks->count() ?? 0 }})</h3>
        <div>
            <form method="GET" style="display: inline;">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                
                <button type="submit" formaction="/admin/export/csv" class="btn btn-primary" style="margin-right: 5px;">
                    CSV
                </button>
                <button type="submit" formaction="/admin/export/pdf" class="btn btn-success">
                    PDF
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        @if($feedbacks && $feedbacks->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Email</th>
                        <th>Category</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td><strong>{{ $feedback->name }}</strong></td>
                            <td><a href="mailto:{{ $feedback->email }}">{{ $feedback->email }}</a></td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ $feedback->category->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>{{ Str::limit($feedback->message, 40) }}</td>
                            <td>
                                @if($feedback->status == 'baru')
                                    <span class="badge badge-info">Baru</span>
                                @elseif($feedback->status == 'diproses')
                                    <span class="badge badge-warning">Diproses</span>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="/admin/feedback/{{ $feedback->id }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($feedbacks instanceof \Illuminate\Pagination\Paginator)
                <div class="pagination" style="margin-top: 20px;">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 40px; color: #7f8c8d;">
                <p style="font-size: 16px;">No feedback found</p>
            </div>
        @endif
    </div>
</div>

@endsection
