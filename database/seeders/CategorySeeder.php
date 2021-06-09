<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name'=>'Kategori Yok',
                'slug'=>'kategori-yok',
                'color' => '#eeb72c',
            ],
            [
                'name'=>'Kahvaltılık',
                'slug'=>'kahvaltilik',
                'color' => '#aaee2b',
            ],
            [
                'name'=>'Meyve & Sebze',
                'slug'=>'meyve-sebze',
                'color' => '#967627',
            ],
            [
                'name'=>'Temel Gıda',
                'slug'=>'temel-gida',
                'color' => '#2bee89',
            ],
            [
                'name'=>'Tahıl & Bakliyat',
                'slug'=>'tahil-bakliyat',
                'color' => '#b7b6b3',
            ],
            [
                'name'=>'Süper Gıda',
                'slug'=>'super-gida',
                'color' => '#ff0000',
            ],
            [
                'name'=>'Salçalar & Soslar',
                'slug'=>'salcalar-soslar',
                'color' => '#eb2bee',
            ],
        ]);
    }
}
