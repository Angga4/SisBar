<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
{
    $filter = $request->input('filter', 'bulan'); 

     $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    if ($filter === 'minggu') {

        $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1);
        $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
        $totalWeeks = ceil($lastDayOfMonth->weekOfMonth); 

        $peminjamanData = Peminjaman::selectRaw('WEEK(tanggal_pinjam, 3) - WEEK(DATE_SUB(tanggal_pinjam, INTERVAL DAYOFMONTH(tanggal_pinjam)-1 DAY), 3) + 1 as minggu, COUNT(*) as total')
            ->whereYear('tanggal_pinjam', $currentYear)
            ->whereMonth('tanggal_pinjam', $currentMonth)
            ->groupBy('minggu')
            ->pluck('total', 'minggu')
            ->toArray();

        $pengembalianData = Pengembalian::selectRaw('WEEK(tanggal_kembali, 3) - WEEK(DATE_SUB(tanggal_kembali, INTERVAL DAYOFMONTH(tanggal_kembali)-1 DAY), 3) + 1 as minggu, COUNT(*) as total')
            ->whereYear('tanggal_kembali', $currentYear)
            ->whereMonth('tanggal_kembali', $currentMonth)
            ->groupBy('minggu')
            ->pluck('total', 'minggu')
            ->toArray();

        $peminjamanChart = array_fill(0, $totalWeeks, 0);
        $pengembalianChart = array_fill(0, $totalWeeks, 0);

        foreach ($peminjamanData as $week => $count) {
            $peminjamanChart[$week - 1] = $count;
        }

        foreach ($pengembalianData as $week => $count) {
            $pengembalianChart[$week - 1] = $count;
        }

        $labels = [];
        for ($i = 1; $i <= $totalWeeks; $i++) {
            $labels[] = "Minggu $i";
        }

    } else {
        $peminjamanData = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_pinjam', $currentYear)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $pengembalianData = Pengembalian::selectRaw('MONTH(tanggal_kembali) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_kembali', $currentYear)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $peminjamanChart = array_fill(0, 12, 0);
        $pengembalianChart = array_fill(0, 12, 0);

        foreach ($peminjamanData as $month => $count) {
            $peminjamanChart[$month - 1] = $count;
        }

        foreach ($pengembalianData as $month => $count) {
            $pengembalianChart[$month - 1] = $count;
        }

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    }

    $totalBarang = Barang::count();
    $totalGuru = User::where('role', 'guru')->count();

    return view('dashboard.admin', [
        'peminjamanChart' => $peminjamanChart,
        'pengembalianChart' => $pengembalianChart,
        'totalBarang' => $totalBarang,
        'totalGuru' => $totalGuru,
        'labels' => $labels,
        'filter' => $filter
    ]);
}

}
