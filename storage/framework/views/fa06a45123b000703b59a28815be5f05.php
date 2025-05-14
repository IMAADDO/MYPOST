

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">All Posts</h1>

    <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary mb-3">Add New Post</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-3">
            <div class="card-header"><?php echo e($post->title); ?></div>
            <div class="card-body">
                <p><strong>Content:</strong> <?php echo e($post->content); ?></p>
                <p><strong>Body:</strong> <?php echo e($post->body); ?></p>
                <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="btn btn-info btn-sm">View</a>
                <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\mypost\resources\views/posts//index.blade.php ENDPATH**/ ?>