<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $apoteker   = User::where('role', 'apoteker')->first();
        $patients   = Patient::all();
        $records    = MedicalRecord::with('prescriptions.medicine')->get();

        foreach ($records->take(5) as $idx => $record) {
            $total = 0;
            $items = [];

            foreach ($record->prescriptions as $presc) {
                $subtotal = $presc->medicine->price * $presc->quantity;
                $total   += $subtotal;
                $items[]  = [
                    'medicine_id' => $presc->medicine_id,
                    'quantity'    => $presc->quantity,
                    'price'       => $presc->medicine->price,
                    'subtotal'    => $subtotal,
                ];
            }

            $transaction = Transaction::create([
                'patient_id'        => $record->patient_id,
                'apoteker_id'       => $apoteker->id,
                'medical_record_id' => $record->id,
                'total_amount'      => $total,
                'status'            => 'paid',
                'created_at'        => now()->subDays(rand(1, 30)),
                'updated_at'        => now()->subDays(rand(1, 30)),
            ]);

            foreach ($items as $item) {
                TransactionItem::create(array_merge(['transaction_id' => $transaction->id], $item));
            }
        }
    }
}
