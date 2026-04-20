<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            ['name' => 'Paracetamol 500mg',        'category' => 'Analgesik',       'price' => 5000,   'stock' => 500, 'unit' => 'tablet',  'description' => 'Obat penurun demam dan pereda nyeri'],
            ['name' => 'Amoxicillin 500mg',         'category' => 'Antibiotik',      'price' => 8000,   'stock' => 200, 'unit' => 'kapsul',  'description' => 'Antibiotik untuk infeksi bakteri'],
            ['name' => 'Ibuprofen 400mg',           'category' => 'Analgesik',       'price' => 6000,   'stock' => 300, 'unit' => 'tablet',  'description' => 'Pereda nyeri dan antiinflamasi'],
            ['name' => 'Antasida DOEN',             'category' => 'Antasida',        'price' => 4000,   'stock' => 150, 'unit' => 'tablet',  'description' => 'Menetralkan asam lambung'],
            ['name' => 'Cetirizine 10mg',           'category' => 'Antihistamin',    'price' => 7000,   'stock' => 100, 'unit' => 'tablet',  'description' => 'Obat alergi'],
            ['name' => 'Vitamin C 500mg',           'category' => 'Vitamin',         'price' => 3000,   'stock' => 400, 'unit' => 'tablet',  'description' => 'Suplemen vitamin C'],
            ['name' => 'OBH Combi Batuk Berdahak',  'category' => 'Obat Batuk',      'price' => 25000,  'stock' => 80,  'unit' => 'botol',   'description' => 'Obat batuk berdahak'],
            ['name' => 'Betadine Antiseptik',       'category' => 'Antiseptik',      'price' => 20000,  'stock' => 60,  'unit' => 'botol',   'description' => 'Antiseptik luka'],
            ['name' => 'Salep Gentamicin',          'category' => 'Antibiotik Topikal', 'price' => 15000, 'stock' => 7,  'unit' => 'tube',   'description' => 'Salep untuk infeksi kulit'],
            ['name' => 'Metformin 500mg',           'category' => 'Antidiabetik',    'price' => 5000,   'stock' => 200, 'unit' => 'tablet',  'description' => 'Obat diabetes tipe 2'],
            ['name' => 'Amlodipine 5mg',            'category' => 'Antihipertensi',  'price' => 10000,  'stock' => 150, 'unit' => 'tablet',  'description' => 'Obat tekanan darah tinggi'],
            ['name' => 'Omeprazole 20mg',           'category' => 'Antasida',        'price' => 12000,  'stock' => 100, 'unit' => 'kapsul',  'description' => 'Mengurangi produksi asam lambung'],
            ['name' => 'Loperamide 2mg',            'category' => 'Antidiare',       'price' => 4000,   'stock' => 5,   'unit' => 'tablet',  'description' => 'Obat diare'],
            ['name' => 'Dimenhidrinat 50mg',        'category' => 'Antimual',        'price' => 3500,   'stock' => 200, 'unit' => 'tablet',  'description' => 'Obat mual dan mabuk perjalanan'],
            ['name' => 'Natrium Diklofenak 50mg',   'category' => 'Analgesik',       'price' => 8000,   'stock' => 180, 'unit' => 'tablet',  'description' => 'Pereda nyeri sendi dan otot'],
            ['name' => 'Kloramfenikol Tetes Mata',  'category' => 'Antibiotik Topikal', 'price' => 18000,'stock' => 8,  'unit' => 'botol',   'description' => 'Tetes mata untuk infeksi'],
            ['name' => 'Salbutamol 2mg',            'category' => 'Bronkodilator',   'price' => 6000,   'stock' => 100, 'unit' => 'tablet',  'description' => 'Obat asma'],
            ['name' => 'Dexamethasone 0.5mg',       'category' => 'Kortikosteroid',  'price' => 4000,   'stock' => 120, 'unit' => 'tablet',  'description' => 'Antiinflamasi steroid'],
            ['name' => 'Asam Mefenamat 500mg',      'category' => 'Analgesik',       'price' => 7000,   'stock' => 250, 'unit' => 'kapsul',  'description' => 'Pereda nyeri ringan hingga sedang'],
            ['name' => 'Zinc Sulfat 20mg',          'category' => 'Mineral',         'price' => 4500,   'stock' => 3,   'unit' => 'tablet',  'description' => 'Suplemen zinc untuk imunitas'],
        ];

        foreach ($medicines as $m) {
            Medicine::create($m);
        }
    }
}
