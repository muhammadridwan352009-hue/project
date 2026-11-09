<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Multimedia', 'OSIS', 'Band', 'Rohis'] as $nama) {
            Category::firstOrCreate(['nama' => $nama]);
        }
    }
}
