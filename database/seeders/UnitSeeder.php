<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::insert([ 'name'=>'Adet' ]);
        Unit::insert([ 'name'=>'Koli' ]);
        Unit::insert([ 'name'=>'Kilo' ]);
        Unit::insert([ 'name'=>'Litre' ]);
    }
}
