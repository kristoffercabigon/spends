<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $barangayNo = [
            'Barangay 165',
            'Barangay 166',
            'Barangay 167',
            'Barangay 168',
            'Barangay 169',
            'Barangay 170',
            'Barangay 171',
            'Barangay 172',
            'Barangay 173',
            'Barangay 174',
            'Barangay 175',
            'Barangay 176-A',
            'Barangay 176-B',
            'Barangay 176-C',
            'Barangay 176-D',
            'Barangay 176-E',
            'Barangay 176-F',
            'Barangay 177',
            'Barangay 178',
            'Barangay 179',
            'Barangay 180',
            'Barangay 181',
            'Barangay 182',
            'Barangay 183',
            'Barangay 184',
            'Barangay 185',
            'Barangay 186',
            'Barangay 187',
            'Barangay 188'
        ];

        foreach ($barangayNo as $barangay) {
            DB::table('barangay')->insert([
                'barangay_no' => $barangay,
            ]);
        }
    }
}

