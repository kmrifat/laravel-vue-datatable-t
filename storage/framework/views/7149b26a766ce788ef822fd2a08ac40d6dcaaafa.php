<?php $__env->startSection('content'); ?>
    <div class="container-fluid app-body">
        <div class="row">
            <div class="col-md-12">

                <div id="app">
                    <historyapp></historyapp>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/history.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>