<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Seeder;

class QrCodeSeeder extends Seeder
{
    public function run(): void
    {
        $codes = [
            ['slug' => 'plan-de-fete', 'destination' => '/plan-de-fete'],
            ['slug' => 'cortege', 'destination' => '/cortege'],
            ['slug' => 'diaporama', 'destination' => '/diaporama'],
            ['slug' => 'diaporama/soumettre', 'destination' => '/diaporama/soumettre'],
        ];

        foreach ($codes as $code) {
            QrCode::firstOrCreate(['slug' => $code['slug']], $code);
        }
    }
}
