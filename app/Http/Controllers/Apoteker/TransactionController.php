<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['patient.user', 'apoteker'])->latest();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $transactions    = $query->paginate(15);
        $totalPendapatan = $query->where('status', 'paid')->sum('total_amount');

        return view('apoteker.transactions.index', compact('transactions', 'totalPendapatan'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['patient.user', 'apoteker', 'items.medicine', 'medicalRecord.doctor.user']);
        return view('apoteker.transactions.show', compact('transaction'));
    }
}
