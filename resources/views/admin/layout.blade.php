<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .admin-sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            color: #ecf0f1;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar-header {
            margin-bottom: 30px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }

        .sidebar-user {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 5px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #ecf0f1;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .nav-link:hover {
            background-color: rgba(52, 152, 219, 0.2);
            padding-left: 20px;
            color: #3498db;
        }

        .nav-link.active {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        .nav-icon {
            margin-right: 12px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .nav-separator {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 20px 0;
        }

        /* MAIN CONTENT */
        .admin-main {
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .admin-topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .topbar-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
        }

        .user-role {
            font-size: 12px;
            color: #7f8c8d;
        }

        .logout-btn {
            padding: 8px 16px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        /* CONTENT AREA */
        .admin-content {
            padding: 30px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-breadcrumb {
            font-size: 13px;
            color: #7f8c8d;
        }

        .breadcrumb-item {
            margin-right: 10px;
        }

        .breadcrumb-item.active {
            color: #3498db;
            font-weight: bold;
        }

        /* CONTENT CARDS */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, #f5f7fa 0%, #eff2f5 100%);
            padding: 20px;
            border-bottom: 1px solid #e0e6ed;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #f9fafb;
            padding: 15px 20px;
            border-top: 1px solid #e0e6ed;
        }

        /* BUTTONS */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-success {
            background-color: #2ecc71;
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-primary {
            background-color: #dfe6e9;
            color: #2c3e50;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* ALERTS */
        .alert {
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-top: 4px solid #3498db;
        }

        .stat-card.primary {
            border-top-color: #3498db;
        }

        .stat-card.success {
            border-top-color: #2ecc71;
        }

        .stat-card.danger {
            border-top-color: #e74c3c;
        }

        .stat-card.warning {
            border-top-color: #f39c12;
        }

        .stat-label {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .stat-change {
            font-size: 12px;
            margin-top: 10px;
            color: #27ae60;
        }

        /* FORMS */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .form-error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        /* TABLES */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table thead {
            background-color: #f5f7fa;
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e0e6ed;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 0;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 200;
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                padding: 15px 20px;
            }

            .topbar-title {
                font-size: 18px;
            }

            .admin-content {
                padding: 15px;
            }

            .page-title {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table {
                font-size: 12px;
            }

            .table th, .table td {
                padding: 10px;
            }

            .topbar-user {
                display: none;
            }
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
            justify-content: center;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #3498db;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: #3498db;
            color: white;
        }

        .pagination .active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        .pagination .disabled {
            color: #ccc;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo"> Login Admin</div>
                <div class="sidebar-user">Logged in as: admin</div>
            </div>

            <nav class="nav-menu">
                <li class="nav-item">
                    <a href="/admin" class="nav-link {{ request()->is('admin') || request()->is('admin/dashboard') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/feedback" class="nav-link {{ request()->is('admin/feedback*') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Feedback</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/categories" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/activity-logs" class="nav-link {{ request()->is('admin/activity-logs*') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Activity Logs</span>
                    </a>
                </li>

                <div class="nav-separator"></div>

                <li class="nav-item">
                    <a href="/admin/settings" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/profile" class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}">
                        <span class="nav-icon"></span>
                        <span>Profile</span>
                    </a>
                </li>
            </nav>
        </div>

        <!-- MAIN CONTENT -->
        <div class="admin-main">
            <!-- TOPBAR -->
            <div class="admin-topbar">
                <div class="topbar-title">@yield('page-title', 'Admin Panel')</div>
                <div class="topbar-actions">
                    <div class="topbar-user">
                        <div class="user-avatar">A</div>
                        <div class="user-info">
                            <div class="user-name">Admin User</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                    <a href="/admin/logout" class="logout-btn">Logout</a>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="admin-content">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
