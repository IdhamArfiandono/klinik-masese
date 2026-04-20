<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year  = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // Pendapatan per bulan (12 bulan terakhir)
        $pendapatanBulanan = [];
        for ($m = 1; $m <= 12; $m++) {
            $pendapatanBulanan[$m] = Transaction::where('status', 'paid')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->sum('total_amount');
        }

        // Total appointment per dokter
        $appointmentPerDokter = Doctor::with('user')
            ->withCount(['appointments as total_appointments',
                'appointments as completed_appointments' => fn($q) => $q->where('status', 'completed')])
            ->get();

        // Obat terlaris
        $obatTerlaris = TransactionItem::with('medicine')
            ->selectRaw('medicine_id, SUM(quantity) as total_quantity, SUM(subtotal) as total_revenue')
            ->groupBy('medicine_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'pendapatanBulanan', 'appointmentPerDokter', 'obatTerlaris', 'year'
        ));
    }
}
