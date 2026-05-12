<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="p-6">
    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 text-center max-w-2xl mx-auto">
        <div class="text-6xl mb-4">⏳</div>
        <h2 class="text-2xl font-bold text-yellow-800 mb-2">Akun Belum Diverifikasi</h2>
        <p class="text-yellow-700 mb-4">
            Akun Anda masih dalam proses verifikasi oleh admin.
        </p>
        <p class="text-gray-600 text-sm mb-6">
            Fitur seperti membuat profil lembaga, mengelola informasi donasi, dan mengedit data 
            hanya dapat diakses setelah akun Anda diverifikasi.
        </p>
        <div class="bg-gray-100 rounded-lg p-4 text-left">
            <p class="font-semibold text-gray-700 mb-2">📌 Yang bisa Anda lakukan saat ini:</p>
            <ul class="list-disc ml-5 text-gray-600 text-sm">
                <li>Menunggu verifikasi dari admin</li>
                <li>Menghubungi admin untuk mempercepat verifikasi</li>
                <li>Logout dan login kembali setelah diverifikasi</li>
            </ul>
        </div>
        <div class="mt-6">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mt-6">
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mt-6">
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" 
                style="background-color: #2563eb !important; color: white !important; font-weight: 500 !important; padding: 10px 24px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important;">
            Logout
        </button>
    </form>
</div>
    </form>
</div>
            </form>
        </div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views\lembaga\pending.blade.php ENDPATH**/ ?>