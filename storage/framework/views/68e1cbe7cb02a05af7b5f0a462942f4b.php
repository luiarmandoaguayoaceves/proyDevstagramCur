<?php $__env->startSection('titulo'); ?>
    Perfil: <?php echo e($user->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="<?php echo e($user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg')); ?>"
                    alt="imagen usuario" class="rounded-full ">
            </div>
            <div class="sm:w-8/12 lg:w-6/12 px-5 lex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">

                    <p class="text-gray-700 text-2xl"><?php echo e($user->username); ?></p>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->id === $user->id): ?>
                            <a href="<?php echo e(route('perfil.index')); ?>" class="text-gray-500 hover:text-gray-700 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <p class="to-gray-800 text-sm mb-3 font-bold mt-5">
                    <?php echo e($user->followers->count()); ?>

                    <span class="font-normal"> <?php echo app('translator')->choice('Seguidor|Seguidores', $user->followers->count()); ?></span>
                </p>
                <p class="to-gray-800 text-sm mb-3 font-bold">
                    <?php echo e($user->followings->count()); ?>

                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="to-gray-800 text-sm mb-3 font-bold">
                    <?php echo e($posts->count()); ?>

                    <span class="font-normal">Post</span>
                </p>

                <?php if(auth()->guard()->check()): ?>
                    <?php if($user->id !== auth()->user()->id): ?>
                        <?php if($user->siguiendo(auth()->user())): ?>
                            <form action="<?php echo e(route('users.unfollow', $user)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <input type="submit" value="Dejar de seguir"
                                    class="bg-red-600 text-white uppercase font-bold rounded-lg cursor-pointer px-3 py-1 text-xs">
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('users.follow', $user)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="submit" value="Seguir"
                                    class="bg-blue-600 text-white uppercase font-bold rounded-lg cursor-pointer px-3 py-1 text-xs">
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

        </div>

    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <?php if (isset($component)) { $__componentOriginal00fa8af295fc1af9e68d7d311d812473 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00fa8af295fc1af9e68d7d311d812473 = $attributes; } ?>
<?php $component = App\View\Components\ListarPost::resolve(['posts' => $posts] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('listar-post'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ListarPost::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00fa8af295fc1af9e68d7d311d812473)): ?>
<?php $attributes = $__attributesOriginal00fa8af295fc1af9e68d7d311d812473; ?>
<?php unset($__attributesOriginal00fa8af295fc1af9e68d7d311d812473); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00fa8af295fc1af9e68d7d311d812473)): ?>
<?php $component = $__componentOriginal00fa8af295fc1af9e68d7d311d812473; ?>
<?php unset($__componentOriginal00fa8af295fc1af9e68d7d311d812473); ?>
<?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>