<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Blog') }} - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .dashboard-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }
        .dashboard-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        .dashboard-stat {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>
    <!-- Navbar (ساكنة من index.blade.php) -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(90deg, #4b6cb7, #182848); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('posts.index') }}" style="color: #fff !important;">Laravel Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="background-color: #fff;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="{{ route('posts.index') }}" style="color: #fff !important;">Posts</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" style="color: #fff !important;">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('posts/create') ? 'active' : '' }}" href="{{ route('posts.create') }}" style="color: #fff !important;">Create Post</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: #fff !important;">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: #fff !important;">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mt-5">
        <h1 class="dashboard-title mb-4">Welcome, {{ auth()->user()->name }}!</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Your Posts</h4>
                    <p class="dashboard-stat">{{ \App\Models\Post::where('user_id', auth()->id())->count() }} Posts</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Last Post</h4>
                    <p class="dashboard-stat">
                        @php
                            $lastPost = \App\Models\Post::where('user_id', auth()->id())->latest()->first();
                        @endphp
                        {{ $lastPost ? $lastPost->title : 'No posts yet' }}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Account Created</h4>
                    <p class="dashboard-stat">{{ auth()->user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">View All Posts</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>