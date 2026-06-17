<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Donasi</title>
    <style>
        body { font-family: 'Arial', sans-serif; }
        h2 { text-align: center; margin-bottom: 10px; }
        .subtitle { text-align: center; margin-bottom: 20px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #2563eb; color: white; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #999; }
        .total-box { margin-top: 20px; padding: 10px; background: #f3f4f6; border-radius: 8px; }
    </style>
</head>
<body>
    <h2>Laporan Donasi</h2>
    <div class="subtitle">Periode: <?php echo e($bulan); ?>/<?php echo e($tahun); ?></div>

    <div class="total-box">
        <strong>Ringkasan:</strong><br>
        Total Donatur: <?php echo e($totalDonatur); ?> orang<br>
        Total Donasi Barang: <?php echo e(number_format($totalDonasiBarang, 0, ',', '.')); ?> unit<br>
        Total Donasi Uang: Rp <?php echo e(number_format($totalDonasiUang, 0, ',', '.')); ?>

    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Donatur</th>
                <th>Kebutuhan</th>
                <th>Jumlah/Nominal</th>
                <th>Lembaga</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $donasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                <td><?php echo e($item->nama_donatur); ?></td>
                <td><?php echo e($item->kebutuhan_nama); ?></td>
                <td>
                    <?php if($item->kebutuhan_jenis == 'barang'): ?>
                        <?php echo e(number_format($item->jumlah_barang, 0, ',', '.')); ?> <?php echo e($item->satuan_barang); ?>

                    <?php else: ?>
                        Rp <?php echo e(number_format($item->nominal_uang, 0, ',', '.')); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($item->lembaga->nama_lembaga ?? '-'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="footer">Dicetak: <?php echo e(date('d/m/Y H:i:s')); ?></div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/laporan/pdf.blade.php ENDPATH**/ ?>