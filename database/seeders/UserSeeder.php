<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@marisehatselalu.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'phone'    => '081200000001',
            'is_active'=> true,
        ]);

        // Dokter 1 - Dokter Umum
        $dokter1User = User::create([
            'name'     => 'dr. Muhammad Idham',
            'email'    => 'dokter.umum@marisehatselalu.com',
            'password' => Hash::make('dokter123'),
            'role'     => 'dokter',
            'phone'    => '081200000002',
            'is_active'=> true,
        ]);
        Doctor::create([
            'user_id'          => $dokter1User->id,
            'specialization'   => 'Dokter Umum',
            'education'        => 'S1 Kedokteran Universitas Indonesia',
            'experience_years' => 8,
            'consultation_fee' => 150000,
            'is_active'        => true,
            'schedule'         => [
                'senin'  => ['08:00', '09:00', '10:00', '11:00'],
                'selasa' => ['08:00', '09:00', '10:00', '11:00'],
                'rabu'   => ['13:00', '14:00', '15:00', '16:00'],
                'kamis'  => ['08:00', '09:00', '10:00', '11:00'],
                'jumat'  => ['08:00', '09:00', '10:00'],
            ],
        ]);

        // Dokter 2 - Dokter Gigi
        $dokter2User = User::create([
            'name'     => 'drg. Faiq Bangkit',
            'email'    => 'dokter.gigi@marisehatselalu.com',
            'password' => Hash::make('dokter123'),
            'role'     => 'dokter',
            'phone'    => '081200000003',
            'is_active'=> true,
        ]);
        Doctor::create([
            'user_id'          => $dokter2User->id,
            'specialization'   => 'Dokter Gigi',
            'education'        => 'S1 Kedokteran Gigi Universitas Gadjah Mada',
            'experience_years' => 5,
            'consultation_fee' => 200000,
            'is_active'        => true,
            'schedule'         => [
                'senin'  => ['09:00', '10:00', '11:00'],
                'rabu'   => ['09:00', '10:00', '11:00'],
                'jumat'  => ['13:00', '14:00', '15:00', '16:00'],
                'sabtu'  => ['09:00', '10:00', '11:00', '12:00'],
            ],
        ]);

        // Apoteker
        User::create([
            'name'     => 'Arya Anugrah',
            'email'    => 'apoteker@marisehatselalu.com',
            'password' => Hash::make('apoteker123'),
            'role'     => 'apoteker',
            'phone'    => '081200000004',
            'is_active'=> true,
        ]);

        // 5 Pasien dummy
        $patients = [
            ['name' => 'Angel Pangande',   'email' => 'angel@example.com',  'phone' => '081300000001', 'birth_date' => '1990-05-15', 'gender' => 'L', 'blood_type' => 'A',  'address' => 'Jl. Melati No. 1, Jakarta'],
            ['name' => 'Wisnoe Azi',      'email' => 'wisnoe@example.com', 'phone' => '081300000002', 'birth_date' => '1995-08-20', 'gender' => 'P', 'blood_type' => 'B',  'address' => 'Jl. Mawar No. 5, Bandung'],
            ['name' => 'Firman Kurniawan', 'email' => 'firman@example.com', 'phone' => '081300000003', 'birth_date' => '1985-03-10', 'gender' => 'L', 'blood_type' => 'O',  'address' => 'Jl. Anggrek No. 12, Surabaya'],
            ['name' => 'Amar Rabbany',    'email' => 'amar@example.com',   'phone' => '081300000004', 'birth_date' => '2000-11-25', 'gender' => 'P', 'blood_type' => 'AB', 'address' => 'Jl. Kenanga No. 3, Yogyakarta'],
            ['name' => 'Kiki Aldzikri',   'email' => 'kiki@example.com',   'phone' => '081300000005', 'birth_date' => '1992-07-08', 'gender' => 'L', 'blood_type' => 'A',  'address' => 'Jl. Flamboyan No. 7, Medan'],
        ];

        foreach ($patients as $p) {
            $user = User::create([
                'name'     => $p['name'],
                'email'    => $p['email'],
                'password' => Hash::make('pasien123'),
                'role'     => 'pasien',
                'phone'    => $p['phone'],
                'is_active'=> true,
            ]);
            Patient::create([
                'user_id'    => $user->id,
                'birth_date' => $p['birth_date'],
                'gender'     => $p['gender'],
                'blood_type' => $p['blood_type'],
                'address'    => $p['address'],
                'allergies'  => null,
            ]);
        }
    }
}
