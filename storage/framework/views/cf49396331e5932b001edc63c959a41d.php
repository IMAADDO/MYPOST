<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome, <?php echo e(auth()->user()->name); ?>!</p>
        <a href="<?php echo e(route('posts.index')); ?>" class="btn btn-primary">View Posts</a>
        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success">Create New Post</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\mypost\resources\views/dashboard.blade.php ENDPATH**/ ?>