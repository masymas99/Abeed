<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield( '3BEED')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
        }

        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            margin: 0 auto;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #800080 !important;
        }

        .navbar-brand {
            color: #800080 !important;
            font-weight: bold;
        }

        .card {
            background-color: #ffffff;
            border: 10px solid #B05476;
            border-radius: 35px;
            width: 300px;
            height: 300px;
        }

        .card i {
            color: #800080;
        }

        .btn-primary {
            background-color: #40366D;
            border-color: #40366D;
        }

        .btn-primary:hover {
            background-color: #660066;
            border-color: #660066;
        }

        .text-primary {
            color: #800080 !important;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #333;
        }

        .user-profile i {
            color: #800080;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('Jhome.index') }}">3 B E E D</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Jhome.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('applications.my') }}">My Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('applications.accepted') }}">Accepted</a>
                    </li>

                </ul>
                <a href="{{ route('profile.edit') }}" style="text-decoration: none;" class=" user-profile">
                    <i class="fas fa-user-circle fa-lg"></i>
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
