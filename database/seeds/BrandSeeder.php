<?php

use App\Models\Brands;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) { 
            factory(Brands::class)->create(['name'=>'apple'.$i]);
        }
    }
}
