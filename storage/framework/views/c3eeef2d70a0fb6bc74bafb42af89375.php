<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Laravel Blog')); ?> - Post Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background: rgba(24, 40, 72, 0.9);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #ffdd57 !important;
        }
        .navbar-nav .nav-link.active {
            color: #ffdd57 !important;
            font-weight: 700;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
        .navbar-toggler {
            border-color: #fff;
        }
        .navbar-toggler-icon {
            background-color: #fff;
        }

        .hero-section {
            background: url('https://source.unsplash.com/random/1600x400?nature,blog') no-repeat center center;
            background-size: cover;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
        .hero-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .post-card {
            border: none;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }
        .post-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .post-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .post-content, .post-body {
            color: #7f8c8d;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .post-meta {
            font-size: 0.9rem;
            color: #95a5a6;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Laravel Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('posts*') ? 'active' : ''); ?>" href="<?php echo e(route('posts.index')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <form class="d-flex search-bar" role="search" style="max-width: 400px; margin: 0 20px;">
                    <input class="form-control me-2" type="search" placeholder="Search posts..." aria-label="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::is('posts/create') ? 'active' : ''); ?>" href="<?php echo e(route('posts.create')); ?>">Create Post</a>
                        </li>
                        <li class="nav-item">
                            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="nav-link btn btn-link text-danger">Logout</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <h1 class="hero-title"><?php echo e($post->title); ?></h1>
    </div>

    <!-- Post Details -->
    <div class="container mt-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <div class="post-card">
            <?php if($post->image): ?>
                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="<?php echo e($post->title); ?>" class="post-image img-fluid">
            <?php endif; ?>
            <p class="post-content"><strong>Content:</strong> <?php echo e($post->content); ?></p>
            <p class="post-body"><strong>Body:</strong> <?php echo e($post->body); ?></p>
            <p class="post-meta">Posted on <?php echo e($post->created_at->format('d M Y, H:i')); ?> by <?php echo e($post->user ? $post->user->name : 'Unknown'); ?></p>
            <?php if(auth()->guard()->check()): ?>
                <div class="mt-4">
                    <?php if($post->user_id === auth()->id()): ?>
                        <a href="<?php echo e(route('posts.edit', $post)); ?>" class="btn btn-warning btn-custom me-2">Edit</a>
                    <?php endif; ?>
                    <?php if($post->user_id === auth()->id() || auth()->user()->is_admin): ?>
                        <form action="<?php echo e(route('posts.destroy', $post)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="mt-4">
                <a href="<?php echo e(route('posts.index')); ?>" class="btn btn-custom">Back to Posts</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html><?php /**PATH C:\Users\dell\mypost\resources\views/posts/show.blade.php ENDPATH**/ ?>