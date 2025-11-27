<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan - Admin</title>
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

        .logout-btn {
            background-color: var(--danger);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Dashboard Container */
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

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: #f8f9fa;
            border-left-color: var(--secondary);
            padding-left: 1.25rem;
            color: var(--secondary);
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

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Filters Section */
        .filters-section {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .filter-group input,
        .filter-group select {
            padding: 0.5rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .filter-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
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

        .btn-secondary {
            background: #95a5a6;
            color: var(--white);
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        /* Table */
        .table-section {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
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

        .action-links {
            display: flex;
            gap: 0.5rem;
        }

        .action-links a {
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .action-links .view-btn {
            background: var(--secondary);
            color: var(--white);
        }

        .action-links .view-btn:hover {
            background: #2980b9;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            text-decoration: none;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .pagination a:hover {
            background: var(--secondary);
            color: var(--white);
        }

        .pagination .active {
            background: var(--secondary);
            color: var(--white);
            border-color: var(--secondary);
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .filter-row {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.5rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-title">Admin Panel</div>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="dashboard-container">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.feedback.index') }}" class="active">Daftar Pengaduan</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Kelola Kategori</a></li>
                <li><a href="{{ route('admin.activity-logs') }}">Activity Log</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1>Daftar Pengaduan/Saran</h1>
                    <p>Total: {{ $feedbacks->total() }} pengaduan</p>
                </div>

                <!-- Export Section -->
                <div style="background: var(--white); padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <h3 style="margin-bottom: 1rem; color: var(--dark);">📥 Export Data</h3>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <form method="GET" action="{{ route('admin.export.csv') }}" style="display: inline;">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                            <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                            <button type="submit" style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, var(--secondary), var(--primary)); color: var(--white); border: none; border-radius: 5px; cursor: pointer; font-weight: 600; transition: all 0.3s;">Export CSV</button>
                        </form>
                        <form method="GET" action="{{ route('admin.export.pdf') }}" style="display: inline;">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                            <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                            <button type="submit" style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, var(--secondary), var(--primary)); color: var(--white); border: none; border-radius: 5px; cursor: pointer; font-weight: 600; transition: all 0.3s;">Export PDF</button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Filters -->
                <div class="filters-section">
                    <form method="GET" action="{{ route('admin.feedback.index') }}">
                        <div class="filter-row">
                            <div class="filter-group">
                                <label>Cari (Nama/Email/Pesan)</label>
                                <input 
                                    type="text" 
                                    name="search" 
                                    placeholder="Masukkan kata kunci"
                                    value="{{ request('search') }}"
                                >
                            </div>
                            
                            <div class="filter-group">
                                <label>Status</label>
                                <select name="status">
                                    <option value="">-- Semua Status --</option>
                                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Kategori</label>
                                <select name="category">
                                    <option value="">-- Semua Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Dari Tanggal</label>
                                <input 
                                    type="date" 
                                    name="date_from"
                                    value="{{ request('date_from') }}"
                                >
                            </div>

                            <div class="filter-group">
                                <label>Hingga Tanggal</label>
                                <input 
                                    type="date" 
                                    name="date_to"
                                    value="{{ request('date_to') }}"
                                >
                            </div>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary">🔍 Filter</button>
                            <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">↻ Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="table-section">
                    @if($feedbacks->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbacks as $feedback)
                                    <tr>
                                        <td><strong>{{ $feedback->name }}</strong></td>
                                        <td>{{ $feedback->email }}</td>
                                        <td>
                                            @if($feedback->category)
                                                {{ $feedback->category->name }}
                                            @else
                                                <span style="color: #7f8c8d;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $feedback->status }}">
                                                @if($feedback->status == 'baru')
                                                    Baru
                                                @elseif($feedback->status == 'diproses')
                                                    Diproses
                                                @else
                                                    Selesai
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="action-links">
                                                <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="view-btn">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div style="padding: 2rem;">
                            {{ $feedbacks->links() }}
                        </div>
                    @else
                        <div class="no-data">
                            <p>📭 Tidak ada pengaduan yang ditemukan</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
