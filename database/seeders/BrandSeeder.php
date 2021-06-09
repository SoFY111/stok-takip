<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'name' => 'Markasız',
                'slug' => 'markasiz'
            ],
            [
                'name' => 'Ülker',
                'slug' => 'ulker'
            ],
            [
                'name' => 'Nestle',
                'slug' => 'nestle'
            ],
            [
                'name' => 'Erikli',
                'slug' => 'erikli'
            ],
            [
                'name' => 'Filiz',
                'slug' => 'filiz'
            ],
            [
                'name' => 'Knorr',
                'slug' => 'knorr'
            ],
            [
                'name' => 'Tat',
                'slug' => 'tat'
            ],
            [
                'name' => 'Calve',
                'slug' => 'calve'
            ],
            [
                'name' => 'Söke',
                'slug' => 'soke'
            ],
            [
                'name' => 'Dr. Oetker',
                'slug' => 'dr-oetker'
            ],
            [
                'name' => 'Pakmaya',
                'slug' => 'pakmaya'
            ],
            [
                'name' => 'Uno',
                'slug' => 'uno'
            ],
            [
                'name' => 'Carte d\'Or',
                'slug' => 'carte-dor'
            ],
            [
                'name' => 'Eti',
                'slug' => 'eti'
            ],
            [
                'name' => 'Tadelle',
                'slug' => 'tadelle'
            ],
            [
                'name' => 'Lay\'s',
                'slug' => 'lays'
            ],
            [
                'name' => 'Ruffles',
                'slug' => 'ruffles'
            ],
        ]);
    }
}
