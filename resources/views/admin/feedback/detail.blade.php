@extends('admin.layout')

@section('title', 'Feedback Detail')
@section('page-title', 'Feedback Detail')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Feedback Detail</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item"><a href="/admin/feedback" style="color: #3498db; text-decoration: none;">Feedback</a></span>
        <span class="breadcrumb-item active">{{ $feedback->name ?? 'Detail' }}</span>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 350px; gap: 20px;">
    <!-- Main Content -->
    <div>
        <!-- Feedback Info Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feedback Information</h3>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: 150px 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <div class="form-label">From:</div>
                        <div style="font-size: 16px; font-weight: bold; color: #2c3e50;">{{ $feedback->name }}</div>
                    </div>
                    <div>
                        <div class="form-label">Email:</div>
                        <div><a href="mailto:{{ $feedback->email }}" style="color: #3498db;">{{ $feedback->email }}</a></div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 150px 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <div class="form-label">Category:</div>
                        <span class="badge badge-primary">{{ $feedback->category->name ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <div class="form-label">Date:</div>
                        <div>{{ $feedback->created_at->format('d MMMM Y, H:i') }}</div>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <div class="form-label">Status:</div>
                    @if($feedback->status == 'baru')
                        <span class="badge badge-info" style="padding: 6px 12px; font-size: 13px;">Baru</span>
                    @elseif($feedback->status == 'diproses')
                        <span class="badge badge-warning" style="padding: 6px 12px; font-size: 13px;">Diproses</span>
                    @else
                        <span class="badge badge-success" style="padding: 6px 12px; font-size: 13px;">Selesai</span>
                    @endif
                </div>

                <div style="margin-bottom: 20px;">
                    <div class="form-label">IP Address:</div>
                    <div style="font-family: monospace; color: #7f8c8d;">{{ $feedback->ip_address ?? 'N/A' }}</div>
                </div>

                <hr style="border: 1px solid #e0e6ed; margin: 20px 0;">

                <div>
                    <div class="form-label" style="margin-bottom: 10px;">Message:</div>
                    <div style="background-color: #f9fafb; padding: 15px; border-radius: 6px; line-height: 1.6; color: #2c3e50;">
                        {{ $feedback->message }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">💬 Response</h3>
            </div>
            <div class="card-body">
                @if($feedback->admin_response)
                    <div style="background-color: #d4edda; padding: 15px; border-radius: 6px; border-left: 4px solid #28a745;">
                        {{ $feedback->admin_response }}
                    </div>
                @else
                    <div style="text-align: center; color: #7f8c8d; padding: 20px;">
                        No response yet
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <form method="POST" action="/admin/feedback/{{ $feedback->id }}/respond">
                    @csrf
                    <textarea name="admin_response" class="form-control" placeholder="Type your response..." rows="5" style="margin-bottom: 10px;">{{ $feedback->admin_response }}</textarea>
                    <button type="submit" class="btn btn-success">💬 Send Response</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Status Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Status</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/feedback/{{ $feedback->id }}/status">
                    @csrf
                    <select name="status" class="form-control" onchange="this.form.submit();">
                        <option value="baru" {{ $feedback->status == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ $feedback->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $feedback->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actions</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/feedback/{{ $feedback->id }}/delete" style="margin-bottom: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width: 100%; margin-bottom: 10px;" onclick="return confirm('Are you sure?');">
                        🗑️ Delete
                    </button>
                </form>

                <a href="/admin/feedback" class="btn btn-secondary" style="width: 100%; text-align: center;">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Info</h3>
            </div>
            <div class="card-body" style="font-size: 12px;">
                <div style="margin-bottom: 15px;">
                    <div class="form-label" style="font-size: 11px; margin-bottom: 5px;">Created:</div>
                    <div>{{ $feedback->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div>
                    <div class="form-label" style="font-size: 11px; margin-bottom: 5px;">Updated:</div>
                    <div>{{ $feedback->updated_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
