<?php

use App\Models\Brands;
use App\Models\Category;
use App\Models\Items;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        for ($i=0; $i <10 ; $i++) { 
            factory(Items::class)->create([
                'users_id'    => $faker->numberBetween(1,5),
                'brand_id'    => $faker->numberBetween(1,5),
                'category_id' => $faker->numberBetween(1,5)
            ]);
        }
    }
}
