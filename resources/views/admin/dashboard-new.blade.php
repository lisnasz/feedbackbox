@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<style>
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .chart-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .chart-card h3 {
        margin-bottom: 15px;
        color: #2c3e50;
        font-size: 16px;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .filter-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .export-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Dashboard Analytics</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card primary">
        <div class="stat-label">Total Feedback</div>
        <div class="stat-value">{{ $totalFeedback }}</div>
        <div class="stat-change">+{{ $newFeedback }} new this month</div>
    </div>

    <div class="stat-card success">
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $completedFeedback }}</div>
        <div class="stat-change">{{ round($completionRate, 1) }}% completion rate</div>
    </div>

    <div class="stat-card warning">
        <div class="stat-label">Processing</div>
        <div class="stat-value">{{ $processingFeedback }}</div>
        <div class="stat-change">{{ $pendingCount }} pending</div>
    </div>

    <div class="stat-card danger">
        <div class="stat-label">New Feedback</div>
        <div class="stat-value">{{ $newFeedback }}</div>
        <div class="stat-change">Awaiting review</div>
    </div>
</div>

<!-- Charts -->
<div class="charts-grid">
    <div class="chart-card">
        <h3>Feedback by Status</h3>
        <div class="chart-container">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <h3>Feedback by Category</h3>
        <div class="chart-container">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<div class="charts-grid">
    <div class="chart-card">
        <h3>7-Day Feedback Trend</h3>
        <div class="chart-container">
            <canvas id="trendChart"></canvas>
        </div>
    </div>
</div>

<!-- Category Statistics -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Category Statistics</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total</th>
                    <th>Completed</th>
                    <th>Processing</th>
                    <th>New</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categoryStats as $cat)
                    <tr>
                        <td><strong>{{ $cat['name'] }}</strong></td>
                        <td>{{ $cat['total'] }}</td>
                        <td><span class="badge badge-success">{{ $cat['completed'] }}</span></td>
                        <td><span class="badge badge-warning">{{ $cat['processing'] }}</span></td>
                        <td><span class="badge badge-info">{{ $cat['new'] }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #7f8c8d;">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Feedback -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Feedback</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Category</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentFeedback as $feedback)
                    <tr>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->category->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($feedback->message, 50) }}</td>
                        <td>
                            @if($feedback->status == 'baru')
                                <span class="badge badge-info">Baru</span>
                            @elseif($feedback->status == 'diproses')
                                <span class="badge badge-warning">Diproses</span>
                            @else
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $feedback->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #7f8c8d;">No feedback available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Export Data Section -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">📥 Export Data</h3>
    </div>
    <div class="card-body">
        <form method="GET" style="margin-bottom: 20px;">
            <div class="filter-group">
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="baru">Baru</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach($categoryStats as $cat)
                            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">From Date</label>
                    <input type="date" name="date_from" class="form-control">
                </div>
                <div>
                    <label class="form-label">To Date</label>
                    <input type="date" name="date_to" class="form-control">
                </div>
            </div>

            <div class="export-buttons">
                <button type="submit" formaction="/admin/export/csv" class="btn btn-primary">
                    Export CSV
                </button>
                <button type="submit" formaction="/admin/export/pdf" class="btn btn-success">
                    Export PDF
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data from controller
    const feedbackByStatus = {!! json_encode($feedbackByStatus) !!};
    const feedbackByCategory = {!! json_encode($feedbackByCategory) !!};
    const feedbackTrend = {!! json_encode($feedbackTrend) !!};

    // Status Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(feedbackByStatus),
                datasets: [{
                    data: Object.values(feedbackByStatus),
                    backgroundColor: [
                        '#3498db',
                        '#f39c12',
                        '#2ecc71'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx) {
        const categoryNames = feedbackByCategory.map(c => c.name);
        const categoryValues = feedbackByCategory.map(c => c.count);

        new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: categoryNames,
                datasets: [{
                    label: 'Feedback Count',
                    data: categoryValues,
                    backgroundColor: '#3498db',
                    borderColor: '#2980b9',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Trend Chart
    const trendCtx = document.getElementById('trendChart');
    if (trendCtx) {
        const days = Object.keys(feedbackTrend);
        const values = Object.values(feedbackTrend);

        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: 'Daily Feedback',
                    data: values,
                    borderColor: '#2ecc71',
                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: '#2ecc71'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

@endsection
