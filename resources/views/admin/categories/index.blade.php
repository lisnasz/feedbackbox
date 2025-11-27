<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin</title>
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

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Cards */
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
            min-height: 100px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
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
            margin-top: 2rem;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons button {
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .edit-btn {
            background: var(--secondary);
            color: var(--white);
        }

        .edit-btn:hover {
            background: #2980b9;
        }

        .delete-btn {
            background: var(--danger);
            color: var(--white);
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 1rem;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
        }

        .close-modal:hover {
            color: var(--dark);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.5rem;
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
                <li><a href="{{ route('admin.feedback.index') }}">Daftar Pengaduan</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="active">Kelola Kategori</a></li>
                <li><a href="{{ route('admin.activity-logs') }}">Activity Log</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="container">
                <div class="page-header">
                    <h1>Kelola Kategori Pengaduan</h1>
                    <p>Tambah, edit, atau hapus kategori pengaduan/saran</p>
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

                <!-- Form Tambah Kategori -->
                <div class="card">
                    <h2>Tambah Kategori Baru</h2>

                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="new_name">Nama Kategori</label>
                            <input 
                                type="text" 
                                id="new_name" 
                                name="name" 
                                placeholder="Masukkan nama kategori"
                                required
                            >
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_description">Deskripsi (Opsional)</label>
                            <textarea 
                                id="new_description" 
                                name="description" 
                                placeholder="Masukkan deskripsi kategori"
                            ></textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">➕ Tambah Kategori</button>
                    </form>
                </div>

                <!-- Daftar Kategori -->
                <div class="card">
                    <h2>Daftar Kategori ({{ $categories->count() }})</h2>

                    @if($categories->count() > 0)
                        <div class="table-section">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah Pengaduan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td><strong>{{ $category->name }}</strong></td>
                                            <td>
                                                @if($category->description)
                                                    {{ Str::limit($category->description, 50) }}
                                                @else
                                                    <span style="color: #7f8c8d;">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span style="background: #ecf0f1; padding: 0.25rem 0.5rem; border-radius: 5px;">
                                                    {{ $category->feedbacks()->count() }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button 
                                                        type="button" 
                                                        class="edit-btn"
                                                        onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')"
                                                    >
                                                        ✏️ Edit
                                                    </button>
                                                    
                                                    <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                        @csrf
                                                        <button type="submit" class="delete-btn">🗑️ Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="no-data">
                            <p>📭 Belum ada kategori yang dibuat</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Kategori</h2>
                <button type="button" class="close-modal" onclick="closeEditModal()">✕</button>
            </div>

            <form method="POST" id="editForm">
                @csrf

                <div class="form-group">
                    <label for="edit_name">Nama Kategori</label>
                    <input 
                        type="text" 
                        id="edit_name" 
                        name="name" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="edit_description">Deskripsi (Opsional)</label>
                    <textarea 
                        id="edit_description" 
                        name="description"
                    ></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, description) {
            document.getElementById('editForm').action = `/admin/categories/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>
