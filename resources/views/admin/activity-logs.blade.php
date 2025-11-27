<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log - Admin</title>
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

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: calc(100vh - 80px);
        }

        .sidebar {
            background: var(--white);
            border-right: 1px solid #bdc3c7;
            padding: 2rem 0;
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
        }

        .sidebar-menu a.active {
            background-color: #ecf0f1;
            border-left-color: var(--primary);
            color: var(--primary);
            font-weight: 600;
        }

        .main-content {
            padding: 2rem;
            overflow-y: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

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

        .table-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8f9fa;
        }

        th {
            padding: 1rem;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: 600;
        }

        td {
            padding: 1rem;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-failed {
            background-color: #ffebee;
            color: #c62828;
        }

        .status-error {
            background-color: #fff3e0;
            color: #e65100;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            margin-top: 2rem;
            justify-content: center;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            text-decoration: none;
            color: var(--dark);
        }

        .pagination a:hover {
            background-color: var(--light);
        }

        .pagination .active {
            background-color: var(--primary);
            color: var(--white);
            border-color: var(--primary);
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
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-title">Admin Panel</div>
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
                <li><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                <li><a href="{{ route('admin.feedback.index') }}"> Daftar Pengaduan</a></li>
                <li><a href="{{ route('admin.categories.index') }}"> Kelola Kategori</a></li>
                <li><a href="{{ route('admin.activity-logs') }}" class="active"> Activity Log</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1> Activity Log</h1>
                    <p>Catatan lengkap aktivitas admin untuk audit dan keamanan</p>
                </div>

                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card success">
                        <div class="stat-label">Total Login Sukses</div>
                        <div class="stat-value">{{ $stats['total_logins'] }}</div>
                    </div>

                    <div class="stat-card danger">
                        <div class="stat-label">Login Gagal</div>
                        <div class="stat-value">{{ $stats['failed_logins'] }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Total Aktivitas</div>
                        <div class="stat-value">{{ $stats['total_actions'] }}</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-label">Admin Unik</div>
                        <div class="stat-value">{{ $stats['unique_users'] }}</div>
                    </div>
                </div>

                <!-- Activity Logs Table -->
                <div class="table-section">
                    <h2> Riwayat Aktivitas</h2>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 120px;">Tanggal</th>
                                <th style="width: 150px;">Admin</th>
                                <th style="width: 120px;">Aksi</th>
                                <th>Deskripsi</th>
                                <th style="width: 150px;">IP Address</th>
                                <th style="width: 100px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td><strong>{{ $log->admin_username }}</strong></td>
                                    <td>{{ ucfirst($log->action) }}</td>
                                    <td style="font-size: 0.9rem; color: #7f8c8d;">{{ $log->description ?? '-' }}</td>
                                    <td style="font-family: monospace; font-size: 0.85rem;">{{ $log->ip_address ?? 'N/A' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $log->status }}">
                                            @if($log->status == 'success') Sukses
                                            @elseif($log->status == 'failed') Gagal
                                            @else Error
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #7f8c8d;">Tidak ada log aktivitas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($logs->hasPages())
                        <div class="pagination">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
