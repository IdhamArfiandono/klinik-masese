<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Medicine;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $doctors  = Doctor::all();
        $dokterUmum = $doctors->where('specialization', 'Dokter Umum')->first();
        $dokterGigi = $doctors->where('specialization', 'Dokter Gigi')->first();

        $appointments = [
            // Completed with medical records
            ['patient' => 0, 'doctor' => $dokterUmum, 'date' => '2025-03-10', 'time' => '09:00', 'complaint' => 'Demam dan batuk sudah 3 hari', 'status' => 'completed'],
            ['patient' => 1, 'doctor' => $dokterGigi, 'date' => '2025-03-12', 'time' => '10:00', 'complaint' => 'Sakit gigi geraham kiri bawah', 'status' => 'completed'],
            ['patient' => 2, 'doctor' => $dokterUmum, 'date' => '2025-03-15', 'time' => '08:00', 'complaint' => 'Tekanan darah tinggi dan pusing', 'status' => 'completed'],
            ['patient' => 3, 'doctor' => $dokterUmum, 'date' => '2025-03-18', 'time' => '11:00', 'complaint' => 'Sakit perut dan mual', 'status' => 'completed'],
            ['patient' => 4, 'doctor' => $dokterGigi, 'date' => '2025-03-20', 'time' => '14:00', 'complaint' => 'Gusi berdarah dan bengkak', 'status' => 'completed'],
            // Confirmed
            ['patient' => 0, 'doctor' => $dokterUmum, 'date' => '2026-04-25', 'time' => '09:00', 'complaint' => 'Kontrol tekanan darah rutin', 'status' => 'confirmed'],
            ['patient' => 1, 'doctor' => $dokterGigi, 'date' => '2026-04-26', 'time' => '10:00', 'complaint' => 'Pemasangan kawat gigi', 'status' => 'confirmed'],
            // Pending
            ['patient' => 2, 'doctor' => $dokterUmum, 'date' => '2026-04-28', 'time' => '08:00', 'complaint' => 'Cek gula darah rutin', 'status' => 'pending'],
            ['patient' => 3, 'doctor' => $dokterGigi, 'date' => '2026-04-29', 'time' => '13:00', 'complaint' => 'Cabut gigi', 'status' => 'pending'],
            // Cancelled
            ['patient' => 4, 'doctor' => $dokterUmum, 'date' => '2026-04-22', 'time' => '10:00', 'complaint' => 'Alergi kulit', 'status' => 'cancelled'],
        ];

        foreach ($appointments as $idx => $a) {
            $appointment = Appointment::create([
                'patient_id'       => $patients[$a['patient']]->id,
                'doctor_id'        => $a['doctor']->id,
                'appointment_date' => $a['date'],
                'appointment_time' => $a['time'],
                'complaint'        => $a['complaint'],
                'status'           => $a['status'],
            ]);

            if ($a['status'] === 'completed') {
                $this->createMedicalRecord($appointment, $idx);
            }
        }
    }

    private function createMedicalRecord(Appointment $appointment, int $idx): void
    {
        $diagnoses = [
            'ISPA (Infeksi Saluran Pernapasan Atas). Pasien mengalami demam, batuk, dan pilek.',
            'Karies gigi pada gigi 36. Diperlukan perawatan saraf.',
            'Hipertensi grade I. TD: 150/90 mmHg.',
            'Gastritis akut. Nyeri epigastrik dan mual.',
            'Gingivitis. Gusi meradang akibat penumpukan plak.',
        ];

        $notes = [
            'Istirahat yang cukup, minum air putih yang banyak.',
            'Hindari makanan keras dan manis.',
            'Kurangi garam, olahraga rutin, kontrol 2 minggu lagi.',
            'Makan teratur, hindari makanan pedas dan asam.',
            'Sikat gigi 2x sehari, gunakan benang gigi.',
        ];

        $mr = MedicalRecord::create([
            'appointment_id' => $appointment->id,
            'patient_id'     => $appointment->patient_id,
            'doctor_id'      => $appointment->doctor_id,
            'diagnosis'      => $diagnoses[$idx],
            'prescription'   => 'Resep terlampir',
            'notes'          => $notes[$idx],
            'created_at'     => now(),
        ]);

        $medicineSets = [
            [['id' => 1, 'qty' => 10, 'dosage' => '3x1 tablet'], ['id' => 2, 'qty' => 10, 'dosage' => '3x1 kapsul']],
            [['id' => 1, 'qty' => 6, 'dosage' => '3x1 tablet'],  ['id' => 15, 'qty' => 10, 'dosage' => '2x1 tablet']],
            [['id' => 11, 'qty' => 30, 'dosage' => '1x1 tablet'], ['id' => 10, 'qty' => 30, 'dosage' => '2x1 tablet']],
            [['id' => 4, 'qty' => 10, 'dosage' => '3x1 tablet'], ['id' => 12, 'qty' => 10, 'dosage' => '2x1 kapsul']],
            [['id' => 18, 'qty' => 6, 'dosage' => '2x1 tablet'], ['id' => 6, 'qty' => 30, 'dosage' => '1x1 tablet']],
        ];

        foreach ($medicineSets[$idx] as $med) {
            Prescription::create([
                'medical_record_id' => $mr->id,
                'medicine_id'       => $med['id'],
                'quantity'          => $med['qty'],
                'dosage'            => $med['dosage'],
            ]);
        }
    }
}
