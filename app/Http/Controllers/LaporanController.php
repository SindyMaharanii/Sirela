<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\InformasiLembaga;
use App\Models\DonasiBarang;
use App\Models\DonasiUang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        
        if (Auth::user()->role == 'admin') {
            $lembagaId = $request->lembaga_id;
            $lembagaList = Lembaga::all();
        } else {
            $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
            $lembagaId = $lembaga ? $lembaga->lembaga_id : null;
            $lembagaList = [];
        }
        
        $totalTarget = 0;
        $totalTerkumpul = 0;
        
        if ($lembagaId) {
            $informasi = InformasiLembaga::where('lembaga_id', $lembagaId)->first();
            if ($informasi && $informasi->kebutuhan_donasi_list) {
                // AMAN: cek apakah string atau array
                $items = $informasi->kebutuhan_donasi_list;
                if (is_string($items)) {
                    $items = json_decode($items, true);
                }
                if (!is_array($items)) {
                    $items = [];
                }
                
                foreach ($items as $item) {
                    $totalTarget += $item['target'] ?? 0;
                    $totalTerkumpul += $item['terkumpul'] ?? 0;
                }
            }
        }
        
        $persentase = $totalTarget > 0 ? min(100, round(($totalTerkumpul / $totalTarget) * 100, 2)) : 0;
        
        $queryBarang = DonasiBarang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        $queryUang = DonasiUang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        if ($lembagaId) {
            $queryBarang->where('lembaga_id', $lembagaId);
            $queryUang->where('lembaga_id', $lembagaId);
        }
        
        $donasiBarang = $queryBarang->get();
        $donasiUang = $queryUang->get();
        
        $donasi = collect();
        
        foreach ($donasiBarang as $item) {
            $donasi->push((object)[
                'created_at' => $item->created_at,
                'nama_donatur' => $item->nama_donatur,
                'no_hp' => $item->no_hp,
                'kebutuhan_nama' => $item->kebutuhan_nama,
                'kebutuhan_jenis' => 'barang',
                'jumlah_barang' => $item->jumlah_barang,
                'satuan_barang' => $item->satuan_barang,
                'nominal_uang' => null,
                'status' => $item->status,
            ]);
        }
        
        foreach ($donasiUang as $item) {
            $donasi->push((object)[
                'created_at' => $item->created_at,
                'nama_donatur' => $item->nama_donatur,
                'no_hp' => $item->no_hp,
                'kebutuhan_nama' => $item->kebutuhan_nama,
                'kebutuhan_jenis' => 'uang',
                'jumlah_barang' => null,
                'satuan_barang' => null,
                'nominal_uang' => $item->nominal_uang,
                'status' => $item->status,
            ]);
        }
        
        $donasi = $donasi->sortByDesc('created_at');
        
        $totalDonasiBarang = $donasiBarang->sum('jumlah_barang');
        $totalDonasiUang = $donasiUang->sum('nominal_uang');
        $totalDonatur = $donasi->count();
        
        $tahunBarang = DonasiBarang::selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->when($lembagaId, function($q) use ($lembagaId) {
                return $q->where('lembaga_id', $lembagaId);
            })
            ->pluck('tahun');
        
        $tahunUang = DonasiUang::selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->when($lembagaId, function($q) use ($lembagaId) {
                return $q->where('lembaga_id', $lembagaId);
            })
            ->pluck('tahun');
        
        $tahunList = $tahunBarang->merge($tahunUang)->unique()->sortDesc()->values();
        
        if ($tahunList->isEmpty()) {
            $tahunList = collect([date('Y')]);
        }
        
        $namaBulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $namaBulan = $namaBulanList[(int)$bulan - 1];
        
        return view('laporan.index', compact(
            'donasi', 'bulan', 'tahun', 'lembagaList', 'lembagaId',
            'totalDonasiBarang', 'totalDonasiUang', 'totalDonatur',
            'totalTarget', 'totalTerkumpul', 'persentase', 'namaBulan', 'tahunList'
        ));
    }
    
    public function downloadExcel(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        
        if (Auth::user()->role == 'admin') {
            $lembagaId = $request->lembaga_id;
        } else {
            $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
            $lembagaId = $lembaga ? $lembaga->lembaga_id : null;
        }
        
        $queryBarang = DonasiBarang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        $queryUang = DonasiUang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        if ($lembagaId) {
            $queryBarang->where('lembaga_id', $lembagaId);
            $queryUang->where('lembaga_id', $lembagaId);
        }
        
        $donasiBarang = $queryBarang->get();
        $donasiUang = $queryUang->get();
        
        $donasi = collect();
        foreach ($donasiBarang as $item) {
            $donasi->push($item);
        }
        foreach ($donasiUang as $item) {
            $donasi->push($item);
        }
        $donasi = $donasi->sortByDesc('created_at');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'LAPORAN DONASI');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A2', 'Periode: Bulan ' . $bulan . ' Tahun ' . $tahun);
        $sheet->mergeCells('A2:G2');
        
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Tanggal');
        $sheet->setCellValue('C4', 'Nama Donatur');
        $sheet->setCellValue('D4', 'No HP');
        $sheet->setCellValue('E4', 'Kebutuhan');
        $sheet->setCellValue('F4', 'Jumlah/Nominal');
        $sheet->setCellValue('G4', 'Status');
        
        $row = 5;
        $no = 1;
        foreach ($donasi as $item) {
            if (isset($item->kebutuhan_jenis) && $item->kebutuhan_jenis == 'barang') {
                $jumlah = number_format($item->jumlah_barang, 0, ',', '.') . ' ' . $item->satuan_barang;
            } elseif (isset($item->satuan_barang)) {
                $jumlah = number_format($item->jumlah_barang, 0, ',', '.') . ' ' . $item->satuan_barang;
            } else {
                $jumlah = 'Rp ' . number_format($item->nominal_uang, 0, ',', '.');
            }
            
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item->created_at->format('d/m/Y H:i'));
            $sheet->setCellValue('C' . $row, $item->nama_donatur);
            $sheet->setCellValue('D' . $row, $item->no_hp);
            $sheet->setCellValue('E' . $row, $item->kebutuhan_nama);
            $sheet->setCellValue('F' . $row, $jumlah);
            $sheet->setCellValue('G' . $row, $item->status);
            $row++;
        }
        
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_donasi_' . $bulan . '_' . $tahun . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }
    
    public function downloadPdf(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        
        if (Auth::user()->role == 'admin') {
            $lembagaId = $request->lembaga_id;
        } else {
            $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
            $lembagaId = $lembaga ? $lembaga->lembaga_id : null;
        }
        
        $queryBarang = DonasiBarang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        $queryUang = DonasiUang::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);
        
        if ($lembagaId) {
            $queryBarang->where('lembaga_id', $lembagaId);
            $queryUang->where('lembaga_id', $lembagaId);
        }
        
        $donasiBarang = $queryBarang->get();
        $donasiUang = $queryUang->get();
        
        $donasi = collect();
        foreach ($donasiBarang as $item) {
            $donasi->push($item);
        }
        foreach ($donasiUang as $item) {
            $donasi->push($item);
        }
        $donasi = $donasi->sortByDesc('created_at');
        
        $totalDonasiBarang = $donasiBarang->sum('jumlah_barang');
        $totalDonasiUang = $donasiUang->sum('nominal_uang');
        $totalDonatur = $donasi->count();
        
        $pdf = Pdf::loadView('laporan.pdf', compact('donasi', 'bulan', 'tahun', 'totalDonasiBarang', 'totalDonasiUang', 'totalDonatur'));
        return $pdf->download('laporan_donasi_' . $bulan . '_' . $tahun . '.pdf');
    }
    
    public function downloadExcelRekap(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        
        if (Auth::user()->role == 'admin') {
            $lembagaId = $request->lembaga_id;
        } else {
            $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
            $lembagaId = $lembaga ? $lembaga->lembaga_id : null;
        }
        
        $totalTarget = 0;
        $totalTerkumpul = 0;
        
        if ($lembagaId) {
            $informasi = InformasiLembaga::where('lembaga_id', $lembagaId)->first();
            if ($informasi && $informasi->kebutuhan_donasi_list) {
                // AMAN: cek apakah string atau array
                $items = $informasi->kebutuhan_donasi_list;
                if (is_string($items)) {
                    $items = json_decode($items, true);
                }
                if (!is_array($items)) {
                    $items = [];
                }
                
                foreach ($items as $item) {
                    $totalTarget += $item['target'] ?? 0;
                    $totalTerkumpul += $item['terkumpul'] ?? 0;
                }
            }
        }
        
        $persentase = $totalTarget > 0 ? min(100, round(($totalTerkumpul / $totalTarget) * 100, 2)) : 0;
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'REKAPITULASI DONASI');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        $sheet->setCellValue('A2', 'Tahun: ' . $tahun);
        $sheet->mergeCells('A2:D2');
        
        $sheet->setCellValue('A4', 'Total Target');
        $sheet->setCellValue('B4', 'Total Terkumpul');
        $sheet->setCellValue('C4', 'Persentase');
        $sheet->setCellValue('D4', 'Status');
        
        $sheet->setCellValue('A5', number_format($totalTarget, 0, ',', '.'));
        $sheet->setCellValue('B5', number_format($totalTerkumpul, 0, ',', '.'));
        $sheet->setCellValue('C5', $persentase . '%');
        $sheet->setCellValue('D5', $persentase >= 100 ? 'TERCAPAI' : 'Belum Tercapai');
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'rekapitulasi_donasi_' . $tahun . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }
    
    public function downloadPdfRekap(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        
        if (Auth::user()->role == 'admin') {
            $lembagaId = $request->lembaga_id;
        } else {
            $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
            $lembagaId = $lembaga ? $lembaga->lembaga_id : null;
        }
        
        $totalTarget = 0;
        $totalTerkumpul = 0;
        
        if ($lembagaId) {
            $informasi = InformasiLembaga::where('lembaga_id', $lembagaId)->first();
            if ($informasi && $informasi->kebutuhan_donasi_list) {
                // AMAN: cek apakah string atau array
                $items = $informasi->kebutuhan_donasi_list;
                if (is_string($items)) {
                    $items = json_decode($items, true);
                }
                if (!is_array($items)) {
                    $items = [];
                }
                
                foreach ($items as $item) {
                    $totalTarget += $item['target'] ?? 0;
                    $totalTerkumpul += $item['terkumpul'] ?? 0;
                }
            }
        }
        
        $persentase = $totalTarget > 0 ? min(100, round(($totalTerkumpul / $totalTarget) * 100, 2)) : 0;
        
        $pdf = Pdf::loadView('laporan.pdf_rekap', compact('tahun', 'totalTarget', 'totalTerkumpul', 'persentase'));
        return $pdf->download('rekapitulasi_donasi_' . $tahun . '.pdf');
    }
}