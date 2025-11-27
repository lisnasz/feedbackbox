<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - Admin</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .back-link {
            background: var(--secondary);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            background: #2980b9;
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

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Content Cards */
        .card {
            background: var(--white);
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card h2 {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--dark);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            max-width: fit-content;
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

        .message-box {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-left: 4px solid var(--secondary);
            border-radius: 5px;
            margin: 1rem 0;
            line-height: 1.8;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 1rem;
            font-family: inherit;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .response-item {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .response-time {
            color: #7f8c8d;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
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
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1>Detail Pengaduan</h1>
                    <a href="{{ route('admin.feedback.index') }}" class="back-link">← Kembali</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Pengaduan Info -->
                <div class="card">
                    <h2>Informasi Pengaduan</h2>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nama Pengirim</div>
                            <div class="info-value">{{ $feedback->name }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <a href="mailto:{{ $feedback->email }}" style="color: var(--secondary); text-decoration: none;">
                                    {{ $feedback->email }}
                                </a>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Kategori</div>
                            <div class="info-value">
                                @if($feedback->category)
                                    {{ $feedback->category->name }}
                                @else
                                    <span style="color: #7f8c8d;">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <span class="status-badge status-{{ $feedback->status }}">
                                @if($feedback->status == 'baru')
                                    Baru
                                @elseif($feedback->status == 'diproses')
                                    Sedang Diproses
                                @else
                                    Selesai
                                @endif
                            </span>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Tanggal Diterima</div>
                            <div class="info-value">{{ $feedback->created_at->format('d/m/Y H:i:s') }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">IP Address</div>
                            <div class="info-value" style="font-family: monospace;">{{ $feedback->ip_address ?: '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Pesan Pengaduan -->
                <div class="card">
                    <h2>Isi Pengaduan/Saran</h2>
                    <div class="message-box">
                        {{ $feedback->message }}
                    </div>
                </div>

                <!-- Tanggapan Admin -->
                <div class="card">
                    <h2>Tanggapan Admin</h2>

                    @if($feedback->admin_response)
                        <div class="response-item">
                            <div class="response-time">
                                Tanggapan pada {{ $feedback->updated_at->format('d/m/Y H:i:s') }}
                            </div>
                            <div class="message-box">
                                {{ $feedback->admin_response }}
                            </div>
                        </div>
                    @else
                        <p style="color: #7f8c8d; text-align: center; padding: 2rem;">
                            Belum ada tanggapan dari admin
                        </p>
                    @endif

                    <!-- Form Tambah/Edit Tanggapan -->
                    <form method="POST" action="{{ route('admin.feedback.addResponse', $feedback->id) }}" style="margin-top: 2rem;">
                        @csrf
                        
                        <div class="form-group">
                            <label for="admin_response">Tambah/Edit Tanggapan</label>
                            <textarea 
                                id="admin_response" 
                                name="admin_response" 
                                placeholder="Tulis tanggapan admin di sini..."
                            >{{ $feedback->admin_response }}</textarea>
                            @error('admin_response')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">💾 Simpan Tanggapan</button>
                    </form>
                </div>

                <!-- Ubah Status -->
                <div class="card">
                    <h2>Ubah Status Pengaduan</h2>

                    <form method="POST" action="{{ route('admin.feedback.updateStatus', $feedback->id) }}">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" required>
                                    <option value="baru" {{ $feedback->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="diproses" {{ $feedback->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ $feedback->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>

                <!-- Aksi Berbahaya -->
                <div class="card">
                    <h2>Aksi Lainnya</h2>
                    
                    <form method="POST" action="{{ route('admin.feedback.delete', $feedback->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        <button type="submit" class="btn btn-danger">🗑️ Hapus Pengaduan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
