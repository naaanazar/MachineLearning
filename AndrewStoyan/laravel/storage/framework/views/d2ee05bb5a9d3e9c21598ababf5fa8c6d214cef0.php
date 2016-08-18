<?php $__env->startSection('content'); ?>
	<?php foreach($content as $product): ?>
		<div class="col-xs-4 col-md-4">
			<h3 class="text-center"><?php echo e($product->title); ?></h3>
			<hr>
				<div class="text-center">
					<img src="<?php echo e($product->picture); ?>">
					<hr>
				</div>
			<p class="text-justify"><?php echo e($product->description); ?></p>
		</div>
	<?php endforeach; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>