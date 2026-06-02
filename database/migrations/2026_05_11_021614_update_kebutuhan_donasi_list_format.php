<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InformasiLembaga;

return new class extends Migration
{
    public function up()
    {
        $semuaInformasi = InformasiLembaga::all();
        
        foreach ($semuaInformasi as $info) {
            $oldList = json_decode($info->kebutuhan_donasi_list, true);
            
            if (is_array($oldList) && count($oldList) > 0) {
                $newList = [];
                
                foreach ($oldList as $item) {
                    $newItem = [
                        'id' => uniqid(),
                        'nama' => $item['nama'] ?? '-',
                        'jenis' => 'barang', // default barang
                        'target' => (int)($item['jumlah'] ?? 0),
                        'terkumpul' => 0,
                        'satuan' => $item['satuan'] ?? 'unit',
                        'prioritas' => 'sedang',
                        'status' => 'aktif'
                    ];
                    
                    if (in_array($newItem['satuan'], ['Rp', 'rupiah', 'uang'])) {
                        $newItem['jenis'] = 'uang';
                    }
                    
                    $newList[] = $newItem;
                }
                
                $info->kebutuhan_donasi_list = json_encode($newList, JSON_UNESCAPED_UNICODE);
                $info->save();
            }
        }
    }

    public function down()
    {
        // Rollback tidak perlu
    }
};