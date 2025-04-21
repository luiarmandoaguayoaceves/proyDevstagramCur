<?php $__env->startSection('titulo'); ?>
    <?php echo e($post->titulo); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="<?php echo e(asset('uploads') . '/' . $post->imagen); ?>" alt="Imagen del post<?php echo e($post->titulo); ?>">
            <div class="p-3">
                <p>
                    0 Likes
                </p>
            </div>

            <div>
                <p class="font-bold">
                    <?php echo e($post->user->username); ?>

                </p>
                <p class="text-sm text-gray-500">
                    <?php echo e($post->created_at->diffForHumans()); ?>

                </p>
                <p class="mt-5">
                    <?php echo e($post->descripcion); ?>

                </p>
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                <?php if(auth()->guard()->check()): ?>

                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    <form action="">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                        <textarea name="comentario" id="comentario" placeholder="Agrega un comentario"
                            class="border p-3 w-full rounded-lg <?php $__errorArgs = ['comentario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"></textarea>
                        <?php $__errorArgs = ['comentario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                <?php echo e($message); ?>

                            </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="submit" value="Comentar"
                            class="bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer font-bold text-white uppercase w-full p-3 mt-5 rounded-lg">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/posts/show.blade.php ENDPATH**/ ?>