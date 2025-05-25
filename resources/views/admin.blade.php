<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? config('app.name') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <style>
        body {
            min-height: 100vh;
            padding-top: 70px;
            /* Add padding to account for fixed navbar */
        }

        /* Fixed header */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            height: 60px;
            background-color: var(--bs-body-bg);
        }

        .app-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s ease;
        }

        .app-brand:hover {
            opacity: 0.8;
            color: inherit;
        }

        .app-logo {
            width: 36px;
            height: 36px;
            background: #712cf9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.45rem;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .app-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
        }

        .btn-icon-theme {
            background: transparent;
            border: none;
            color: var(--bs-secondary-color);
            /* warna teks pudar adaptif */
            width: 2.5rem;
            height: 2.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s, background-color 0.2s;
            padding: 10px 25px;
        }

        .btn-icon-theme:hover {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
            /* jadi lebih jelas saat hover */
            border-radius: 0.375rem;
        }


        .sidebar {
            position: fixed;
            top: 60px;
            /* Start below the navbar */
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.05);
            background-color: #212529;
            width: 250px;
            transition: transform 0.3s ease;
        }

        /* When sidebar is collapsed, translate it off-screen */
        .sidebar-collapsed {
            transform: translateX(-100%);
        }

        .sidebar-sticky {
            height: calc(100vh - 60px);
            /* Adjusted for navbar height */
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.6);
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin: 0.2rem 0;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, 0.9);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: 600;
        }

        .nav-link i {
            margin-right: 10px;
        }

        .sidebar-header {
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-logo {
            max-height: 40px;
        }

        .main-content {
            margin-left: 250px;
            padding: 1rem 2rem;
            transition: margin-left 0.3s ease;
        }

        .main-content-expanded {
            margin-left: 0;
        }

        .toggle-btn {
            background-color: transparent;
            border: none;
            color: var(--bs-body-color);
            /* warna teks/icon sesuai tema */
            padding: 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            transition: color 0.2s, background-color 0.2s;
        }

        .toggle-btn:hover {
            background-color: var(--bs-secondary-bg);
            color: var(--bs-body-color);
        }

        .brand-text {
            display: inline;
            transition: all 0.3s;
        }

        /* In mobile/tablet view, sidebar overlays content instead of pushing it */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1040;
                /* Higher than navbar */
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-expanded {
                transform: translateX(0) !important;
                /* Add overlay effect */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            }

            /* For mobile, when sidebar is open, add overlay behind it */
            .sidebar-backdrop {
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1035;
                display: none;
            }

            .sidebar-backdrop.show {
                display: block;
            }
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 500;
        }

        .dropdown-menu {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .stat-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        /* Dashboard content */
        .dashboard-content {
            padding-top: 1rem;
        }

        .stat-cards {
            margin-bottom: 1.5rem;
        }

        /* Footer */
        footer {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <!-- Navbar (Fixed at top) -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Left side: Toggle button and brand -->
            <div class="d-flex align-items-center">
                <button class="toggle-btn me-2 rounded-circle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <a href="/" class="app-brand">
                    <div class="app-logo">
                        {{ substr(config('app.name', 'L'), 0, 1) }}
                    </div>
                    <h1 class="app-name">{{ config('app.name', 'Laravel') }}</h1>
                </a>
            </div>

            <!-- Right side: Theme and user dropdown -->
            <div class="d-flex align-items-center ms-auto">

                <div class="dropdown me-3">
                    <button class="btn-icon-theme dropdown-toggle" type="button" id="themeToggleBtn"
                        data-bs-toggle="dropdown" aria-expanded="false" aria-label="Toggle theme">
                        <i id="currentThemeIcon" class="bi "></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeToggleBtn">
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                                data-theme-value="light">
                                <i class="bi bi-sun-fill text-warning"></i> Light
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                                data-theme-value="dark">
                                <i class="bi bi-moon-fill text-primary"></i> Dark
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                                data-theme-value="auto">
                                <i class="bi bi-circle-half text-info"></i> Auto
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- User dropdown -->
                @php
                    $user = Auth::user();
                    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                @endphp

                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#"
                        role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $avatarUrl }}" alt="User" class="rounded-circle me-2" width="32"
                            height="32" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-circle me-2 text-primary"></i> Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar backdrop (for mobile) -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column mt-2">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-people me-2"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>

            <hr class="text-light my-3" />

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-question-circle me-2"></i>
                        <span>Help</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="main-content" id="main">
        <!-- Page header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Dashboard</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <!-- Dashboard content -->
        <div class="dashboard-content">
            <!-- Stat Cards -->
            <div class="row stat-cards">
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white h-100 stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Sales</h6>
                                    <h2 class="mb-0">$24,500</h2>
                                </div>
                                <i class="bi bi-cart3 fs-1 opacity-50"></i>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-primary">+12% from last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white h-100 stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">New Users</h6>
                                    <h2 class="mb-0">145</h2>
                                </div>
                                <i class="bi bi-people fs-1 opacity-50"></i>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-success">+5% from last week</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white h-100 stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Pending Orders</h6>
                                    <h2 class="mb-0">32</h2>
                                </div>
                                <i class="bi bi-clock-history fs-1 opacity-50"></i>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-warning">-3% from yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white h-100 stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Products</h6>
                                    <h2 class="mb-0">548</h2>
                                </div>
                                <i class="bi bi-box fs-1 opacity-50"></i>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-info">+24 new products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <button class="btn btn-sm btn-primary">View All</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-001</td>
                                    <td>John Smith</td>
                                    <td>Product A</td>
                                    <td>$150.00</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>May 20, 2025</td>
                                </tr>
                                <tr>
                                    <td>#ORD-002</td>
                                    <td>Lisa Wong</td>
                                    <td>Product B</td>
                                    <td>$75.50</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    </td>
                                    <td>May 19, 2025</td>
                                </tr>
                                <tr>
                                    <td>#ORD-003</td>
                                    <td>Michael Johnson</td>
                                    <td>Product C</td>
                                    <td>$225.99</td>
                                    <td><span class="badge bg-info">Processing</span></td>
                                    <td>May 19, 2025</td>
                                </tr>
                                <tr>
                                    <td>#ORD-004</td>
                                    <td>Amanda Lee</td>
                                    <td>Product D</td>
                                    <td>$49.99</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>May 18, 2025</td>
                                </tr>
                                <tr>
                                    <td>#ORD-005</td>
                                    <td>Robert Davis</td>
                                    <td>Product E</td>
                                    <td>$199.00</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                    <td>May 18, 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Cards -->
        <div class="row">
            <div class="col-12 col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Activity</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                This Week
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/api/placeholder/32/32" alt="User"
                                                    class="rounded-circle me-2" width="32" height="32" />
                                                <div>John Smith</div>
                                            </div>
                                        </td>
                                        <td>Created a new order</td>
                                        <td>2 mins ago</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/api/placeholder/32/32" alt="User"
                                                    class="rounded-circle me-2" width="32" height="32" />
                                                <div>Emily Davis</div>
                                            </div>
                                        </td>
                                        <td>Updated product #45</td>
                                        <td>10 mins ago</td>
                                        <td><span class="badge bg-primary">In Progress</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/api/placeholder/32/32" alt="User"
                                                    class="rounded-circle me-2" width="32" height="32" />
                                                <div>Michael Johnson</div>
                                            </div>
                                        </td>
                                        <td>Added new product</td>
                                        <td>25 mins ago</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/api/placeholder/32/32" alt="User"
                                                    class="rounded-circle me-2" width="32" height="32" />
                                                <div>Sarah Williams</div>
                                            </div>
                                        </td>
                                        <td>Commented on post #23</td>
                                        <td>1 hour ago</td>
                                        <td><span class="badge bg-info">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/api/placeholder/32/32" alt="User"
                                                    class="rounded-circle me-2" width="32" height="32" />
                                                <div>David Brown</div>
                                            </div>
                                        </td>
                                        <td>Deleted a user</td>
                                        <td>3 hours ago</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Notifications</h5>
                        <button class="btn btn-sm btn-outline-secondary">View All</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px">
                                            <i class="bi bi-people text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">New User Registration</h6>
                                        <p class="mb-0 text-muted small">5 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px">
                                            <i class="bi bi-cart text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">New Order Received</h6>
                                        <p class="mb-0 text-muted small">10 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px">
                                            <i class="bi bi-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Server Warning</h6>
                                        <p class="mb-0 text-muted small">30 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px">
                                            <i class="bi bi-envelope text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">New Email Received</h6>
                                        <p class="mb-0 text-muted small">1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item border-0 p-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-danger rounded-circle p-2 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px">
                                            <i class="bi bi-bell text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">System Update</h6>
                                        <p class="mb-0 text-muted small">2 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="rounded p-3 mt-4">
            <div class="text-center text-muted">
                © 2025 Admin Panel. All rights reserved.
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarBackdrop = document.getElementById("sidebarBackdrop");
            let sidebarOpen = true;

            // Function to close sidebar (for mobile)
            function closeSidebar() {
                sidebar.classList.remove("sidebar-expanded");
                sidebarBackdrop.classList.remove("show");
            }

            // Toggle sidebar on button click
            sidebarToggle.addEventListener("click", function() {
                if (window.innerWidth < 992) {
                    // Mobile behavior - overlay mode
                    sidebar.classList.toggle("sidebar-expanded");
                    sidebarBackdrop.classList.toggle("show");
                } else {
                    // Desktop behavior
                    sidebarOpen = !sidebarOpen;
                    if (sidebarOpen) {
                        sidebar.classList.remove("sidebar-collapsed");
                        main.classList.remove("main-content-expanded");
                    } else {
                        sidebar.classList.add("sidebar-collapsed");
                        main.classList.add("main-content-expanded");
                    }
                }
            });

            // Close sidebar when clicking outside (mobile)
            sidebarBackdrop.addEventListener("click", closeSidebar);

            // Handle responsive behavior
            function checkWidth() {
                if (window.innerWidth < 992) {
                    // Mobile layout
                    sidebarOpen = false;
                    sidebar.classList.remove("sidebar-collapsed");
                    sidebar.classList.remove("sidebar-expanded");
                    main.classList.remove("main-content-expanded");
                    sidebarBackdrop.classList.remove("show");
                } else {
                    // Desktop layout - respect current toggle state
                    if (sidebarOpen) {
                        sidebar.classList.remove("sidebar-collapsed");
                        main.classList.remove("main-content-expanded");
                    } else {
                        sidebar.classList.add("sidebar-collapsed");
                        main.classList.add("main-content-expanded");
                    }
                    // Always hide backdrop in desktop
                    sidebarBackdrop.classList.remove("show");
                }
            }

            // Initial check
            checkWidth();

            // Check on resize
            window.addEventListener("resize", checkWidth);
        });
    </script>

    <script>
        const themeIcons = {
            light: "bi-sun-fill fs-5 text-warning",
            dark: "bi-moon-fill fs-5 text-primary",
            auto: "bi-circle-half fs-5 text-info"
        };

        const themeMap = {
            light: "light",
            dark: "dark",
            auto: window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
        };

        const currentThemeIcon = document.getElementById("currentThemeIcon");
        const themeToggleButtons = document.querySelectorAll('[data-theme-value]');
        const html = document.documentElement;

        function setThemeIcon(theme) {
            currentThemeIcon.className = "bi " + themeIcons[theme];
        }

        function applyTheme(theme) {
            const resolved = theme === "auto" ? themeMap.auto : theme;
            html.setAttribute("data-bs-theme", resolved);
            setThemeIcon(theme);
        }

        function storeTheme(theme) {
            localStorage.setItem("theme", theme);
            applyTheme(theme);
        }

        // Load stored theme or default to auto
        const savedTheme = localStorage.getItem("theme") || "auto";
        applyTheme(savedTheme);

        // Event listeners for buttons
        themeToggleButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                const theme = btn.getAttribute("data-theme-value");
                storeTheme(theme);
            });
        });

        // Reapply if OS theme changes (auto mode)
        window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => {
            if (localStorage.getItem("theme") === "auto") {
                applyTheme("auto");
            }
        });
    </script>

</body>

</html>
