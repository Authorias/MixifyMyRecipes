<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::factory()->create([
            'name' => 'Theelepel',
            'abbreviation' => 'tl',
        ]);        

        Unit::factory()->create([
            'name' => 'Eetlepel',
            'abbreviation' => 'el',
        ]);        

        Unit::factory()->create([
            'name' => 'Milliliter',
            'abbreviation' => 'ml',
        ]);        

        Unit::factory()->create([
            'name' => 'Centiliter',
            'abbreviation' => 'cl',
        ]);        

        Unit::factory()->create([
            'name' => 'Liter',
            'abbreviation' => 'l',
        ]);

        Unit::factory()->create([
            'name' => 'Milligram',
            'abbreviation' => 'mg',
        ]);

        Unit::factory()->create([
            'name' => 'Gram',
            'abbreviation' => 'g',
        ]);

        Unit::factory()->create([
            'name' => 'Kilogram',
            'abbreviation' => 'kg',
        ]);

        Unit::factory()->create([
            'name' => 'Snufje',
            'abbreviation' => 'sn',
        ]);

        Unit::factory()->create([
            'name' => 'Beetje',
            'abbreviation' => 'bj',
        ]);

        Unit::factory()->create([
            'name' => 'Mespuntje',
            'abbreviation' => 'mp',
        ]);

        Unit::factory()->create([
            'name' => 'Stokje',
            'abbreviation' => 'st',
        ]);

        Unit::factory()->create([
            'name' => 'Stuks',
            'abbreviation' => 'sk',
        ]);
        
        Unit::factory()->create([
            'name' => 'Blokje',
            'abbreviation' => 'bl',
        ]);
        
        Unit::factory()->create([
            'name' => 'Zakje',
            'abbreviation' => 'zk',
        ]);
        
        Unit::factory()->create([
            'name' => 'Takje',
            'abbreviation' => 'tk',
        ]);
    }
}