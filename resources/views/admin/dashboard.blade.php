<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dinas Ketahanan Pangan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2ecc71;
            --secondary: #3498db;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --white: #ffffff;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            color: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .user-info {
            font-size: 0.9rem;
        }

        .logout-btn {
            background-color: var(--danger);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Sidebar */
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: calc(100vh - 80px);
        }

        .sidebar {
            background: var(--white);
            border-right: 1px solid #bdc3c7;
            padding: 2rem 0;
            position: sticky;
            top: 0;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .main-content {
            overflow-y: auto;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            border-bottom: 1px solid #ecf0f1;
        }

        .sidebar-menu a {
            display: block;
            padding: 1rem 1.5rem;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover {
            background-color: #f8f9fa;
            border-left-color: var(--secondary);
            padding-left: 1.25rem;
        }

        .sidebar-menu a.active {
            background-color: #ecf0f1;
            border-left-color: var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Page Title */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #7f8c8d;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--secondary);
        }

        .stat-card.success {
            border-top-color: var(--success);
        }

        .stat-card.warning {
            border-top-color: var(--warning);
        }

        .stat-card.danger {
            border-top-color: var(--danger);
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-sub {
            color: #7f8c8d;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .chart-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chart-card h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            color: var(--dark);
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 1rem;
        }

        /* Recent Feedback */
        .recent-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .recent-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }

        .recent-item {
            padding: 1rem;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .recent-item:last-child {
            border-bottom: none;
        }

        .recent-info h4 {
            margin-bottom: 0.3rem;
        }

        .recent-info small {
            color: #7f8c8d;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-baru {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .status-diproses {
            background-color: #fff3e0;
            color: #e65100;
        }

        .status-selesai {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        /* Export Section */
        .export-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .export-section h2 {
            margin-bottom: 1.5rem;
        }

        .export-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            padding: 0.5rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }

        .export-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        /* Quick Links */
        .quick-links {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .quick-links h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }

        .link-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .link-button {
            display: inline-block;
            padding: 1rem;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .link-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.4);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-title">Login Admin</div>
            <div class="header-actions">
                <div class="user-info">
                    Admin: <strong>{{ session('admin_username', 'admin') }}</strong>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a></li>
                <li><a href="{{ route('admin.feedback.index') }}">Daftar Pengaduan</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Kelola Kategori</a></li>
                <li><a href="{{ route('admin.activity-logs') }}">Activity Log</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1> Dashboard Analytics</h1>
                    <p>Ringkasan statistik dan analisis pengaduan secara real-time</p>
                </div>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card success">
                        <div class="stat-label">Total Pengaduan</div>
                        <div class="stat-value">{{ $totalFeedback }}</div>
                        <div class="stat-sub">Seluruh pengaduan yang masuk</div>
                    </div>

                    <div class="stat-card" style="border-top-color: #e74c3c;">
                        <div class="stat-label">Pengaduan Baru</div>
                        <div class="stat-value">{{ $newFeedback }}</div>
                        <div class="stat-sub">Belum dibaca/diproses</div>
                    </div>

                    <div class="stat-card warning">
                        <div class="stat-label">Sedang Diproses</div>
                        <div class="stat-value">{{ $processingFeedback }}</div>
                        <div class="stat-sub">Dalam penanganan</div>
                    </div>

                    <div class="stat-card success">
                        <div class="stat-label">Selesai</div>
                        <div class="stat-value">{{ $completedFeedback }}</div>
                        <div class="stat-sub">Sudah ditangani</div>
                    </div>

                    <div class="stat-card" style="border-top-color: #9b59b6;">
                        <div class="stat-label">Tingkat Penyelesaian</div>
                        <div class="stat-value">{{ $completionRate }}%</div>
                        <div class="stat-sub">Dari total pengaduan</div>
                    </div>

                    <div class="stat-card" style="border-top-color: #1abc9c;">
                        <div class="stat-label">Rata-rata Waktu Respon</div>
                        <div class="stat-value">{{ $avgResponseTime }} hari</div>
                        <div class="stat-sub">Dari pengajuan ke respon</div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="charts-section">
                    <div class="chart-card">
                        <h3> Pengaduan Berdasarkan Status</h3>
                        <div class="chart-container">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <h3> Pengaduan Berdasarkan Kategori</h3>
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- 7-Day Trend -->
                <div class="chart-card" style="margin-bottom: 2rem;">
                    <h3> Tren Pengaduan 7 Hari Terakhir</h3>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

                <!-- Category Statistics Table -->
                <div class="recent-section">
                    <h2> Statistik Pengaduan Per Kategori</h2>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f8f9fa;">
                                <th style="padding: 1rem; text-align: left; border: 1px solid #ddd;">Kategori</th>
                                <th style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Total</th>
                                <th style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Baru</th>
                                <th style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Diproses</th>
                                <th style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Selesai</th>
                                <th style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categoryStats as $category)
                                @php
                                    $total = $category->feedbacks_count;
                                    $percentage = $totalFeedback > 0 ? round(($total / $totalFeedback) * 100, 1) : 0;
                                    $categoryNew = \App\Models\Feedback::where('category_id', $category->id)->where('status', 'baru')->count();
                                    $categoryProcess = \App\Models\Feedback::where('category_id', $category->id)->where('status', 'diproses')->count();
                                    $categoryDone = \App\Models\Feedback::where('category_id', $category->id)->where('status', 'selesai')->count();
                                @endphp
                                <tr>
                                    <td style="padding: 1rem; border: 1px solid #ddd;"><strong>{{ $category->name }}</strong></td>
                                    <td style="padding: 1rem; text-align: center; border: 1px solid #ddd;">{{ $total }}</td>
                                    <td style="padding: 1rem; text-align: center; border: 1px solid #ddd;">{{ $categoryNew }}</td>
                                    <td style="padding: 1rem; text-align: center; border: 1px solid #ddd;">{{ $categoryProcess }}</td>
                                    <td style="padding: 1rem; text-align: center; border: 1px solid #ddd;">{{ $categoryDone }}</td>
                                    <td style="padding: 1rem; text-align: center; border: 1px solid #ddd;">{{ $percentage }}%</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 1rem; text-align: center; border: 1px solid #ddd;">Tidak ada data kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Recent Feedback -->
                <div class="recent-section">
                    <h2> Pengaduan Terbaru (5 Data)</h2>
                    @forelse($recentFeedback as $feedback)
                        <div class="recent-item">
                            <div class="recent-info">
                                <h4>{{ $feedback->name }}</h4>
                                <small>{{ $feedback->email }} | {{ $feedback->category ? $feedback->category->name : 'No Category' }}</small>
                                <small style="display: block; margin-top: 0.3rem;">{{ $feedback->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <span class="status-badge status-{{ $feedback->status }}">
                                @if($feedback->status == 'baru') Baru
                                @elseif($feedback->status == 'diproses') Diproses
                                @else Selesai
                                @endif
                            </span>
                        </div>
                    @empty
                        <p style="text-align: center; padding: 2rem; color: #7f8c8d;">Belum ada pengaduan</p>
                    @endforelse
                </div>

                <!-- Export Section -->
                <div class="export-section">
                    <h2> Export Data Pengaduan</h2>
                    <p style="color: #7f8c8d; margin-bottom: 1.5rem;">Ekspor data pengaduan dalam format CSV atau PDF untuk analisis lebih lanjut</p>
                    
                    <form method="GET" class="export-form">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="">Semua Status</option>
                                <option value="baru">Baru</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category">
                                <option value="">Semua Kategori</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Dari Tanggal</label>
                            <input type="date" name="date_from">
                        </div>

                        <div class="form-group">
                            <label>Hingga Tanggal</label>
                            <input type="date" name="date_to">
                        </div>
                    </form>

                    <div class="export-buttons">
                        <form method="GET" action="{{ route('admin.export.csv') }}" style="display: inline;">
                            <select name="status" style="display: none;">
                                <option value="">Semua</option>
                            </select>
                            <button type="submit" class="btn btn-primary"> Export CSV</button>
                        </form>

                        <form method="GET" action="{{ route('admin.export.pdf') }}" style="display: inline;">
                            <select name="status" style="display: none;">
                                <option value="">Semua</option>
                            </select>
                            <button type="submit" class="btn btn-primary"> Export PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Status Chart (Pie Chart)
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Baru', 'Diproses', 'Selesai'],
                    datasets: [{
                        data: [
                            {{ $feedbackByStatus['baru'] ?? 0 }},
                            {{ $feedbackByStatus['diproses'] ?? 0 }},
                            {{ $feedbackByStatus['selesai'] ?? 0 }}
                        ],
                        backgroundColor: ['#e74c3c', '#f39c12', '#2ecc71'],
                        borderColor: ['#ffffff', '#ffffff', '#ffffff'],
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

        // Category Chart (Bar Chart)
        const categoryCtx = document.getElementById('categoryChart');
        if (categoryCtx) {
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($feedbackByCategory->pluck('category')) !!},
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: {!! json_encode($feedbackByCategory->pluck('count')) !!},
                        backgroundColor: '#3498db',
                        borderColor: '#2980b9',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }

        // Trend Chart (Line Chart)
        const trendCtx = document.getElementById('trendChart');
        if (trendCtx) {
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($feedbackTrend->pluck('date')) !!},
                    datasets: [{
                        label: 'Pengaduan Per Hari',
                        data: {!! json_encode($feedbackTrend->pluck('count')) !!},
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        tension: 0.1,
                        fill: true,
                        borderWidth: 2,
                        pointBackgroundColor: '#3498db',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }
    </script>
