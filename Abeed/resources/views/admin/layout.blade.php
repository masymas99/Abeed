<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #222; color: white; font-family: Arial, sans-serif; }

        /* تصميم الناف بار */
        .navbar { background-color: white; padding: 10px 0; display: flex; justify-content: center; }
        .navbar .container { display: flex; justify-content: space-between; align-items: center; width: 80%; }
        .navbar-brand { font-weight: bold; color: #805664; font-size: 24px; }
        .nav-item { margin: 0 10px; }
        .nav-link { color: #5d3b45; font-weight: bold; }
        .nav-link:hover { color: #3d7d4e; }
        .active-link { background-color: #6EC6FF; color: white !important; border-radius: 20px; padding: 5px 15px; }

        /* تصميم أيقونة الأدمن */
        .admin-info { display: flex; align-items: center; gap: 10px; }
        .admin-icon { background-color: #ddd; padding: 10px; border-radius: 50%; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; }
        .admin-text { font-weight: bold; color: #5d3b45; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.home') }}" style="color: #5d3b45;">3BEED</a>
        <ul class="nav">
            <!-- رابط الصفحة الرئيسية مع تفعيل الصف عند الضغط -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/home') ? 'active-link' : '' }}" href="{{ route('admin.home') }}">Home</a>
            </li>
            <!-- رابط صفحة الوظائف المقبولة مع تفعيل الصف عند الضغط -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/all-jobs') ? 'active-link' : '' }}" href="{{ route('admin.allJobs') }}">All jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users') ? 'active-link' : '' }}" href="{{ route('admin.users') }}">users</a>
            </li>
            <!-- <li class="nav-item"><a class="nav-link" href="#">Users</a></li> -->
        </ul>
        <div class="admin-info">
            <div class="admin-icon">👤</div>
            <span class="admin-text">ADMIN</span>
        </div>
    </div>
</nav>


<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
