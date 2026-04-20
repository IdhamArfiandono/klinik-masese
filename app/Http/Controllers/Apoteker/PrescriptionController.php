<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicalRecord;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function index()
    {
        $resepBelumDiproses = MedicalRecord::whereDoesntHave('transaction')
            ->whereHas('prescriptions')
            ->with(['patient.user', 'doctor.user', 'prescriptions.medicine'])
            ->latest('created_at')
            ->paginate(15);

        return view('apoteker.prescriptions.index', compact('resepBelumDiproses'));
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient.user', 'doctor.user', 'prescriptions.medicine', 'transaction']);
        return view('apoteker.prescriptions.show', compact('medicalRecord'));
    }

    public function process(MedicalRecord $medicalRecord)
    {
        abort_if($medicalRecord->transaction()->exists(), 403, 'Resep sudah diproses.');

        DB::transaction(function () use ($medicalRecord) {
            $total = 0;
            $items = [];

            foreach ($medicalRecord->prescriptions as $presc) {
                $medicine = Medicine::lockForUpdate()->find($presc->medicine_id);
                abort_if($medicine->stock < $presc->quantity, 422, "Stok {$medicine->name} tidak cukup.");

                $medicine->decrement('stock', $presc->quantity);

                $subtotal = $medicine->price * $presc->quantity;
                $total   += $subtotal;
                $items[]  = [
                    'medicine_id' => $medicine->id,
                    'quantity'    => $presc->quantity,
                    'price'       => $medicine->price,
                    'subtotal'    => $subtotal,
                ];
            }

            $transaction = Transaction::create([
                'patient_id'        => $medicalRecord->patient_id,
                'apoteker_id'       => auth()->id(),
                'medical_record_id' => $medicalRecord->id,
                'total_amount'      => $total,
                'status'            => 'paid',
            ]);

            foreach ($items as $item) {
                TransactionItem::create(array_merge(['transaction_id' => $transaction->id], $item));
            }
        });

        return redirect()->route('apoteker.transactions.show',
            Transaction::where('medical_record_id', $medicalRecord->id)->first()
        )->with('success', 'Resep berhasil diproses dan transaksi dibuat.');
    }
}
