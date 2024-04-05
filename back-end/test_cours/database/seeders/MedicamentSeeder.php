<?php

namespace Database\Seeders;

use App\Models\Medicaments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Medicaments::factory(10)->create();
    }
}
