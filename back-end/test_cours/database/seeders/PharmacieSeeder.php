<?php

namespace Database\Seeders;

use App\Models\Pharmacie;
use Illuminate\Database\Seeder;

class PharmacieSeeder extends Seeder
{

    public function run(): void
    {
        Pharmacie::factory(10)->create();
    }
}
