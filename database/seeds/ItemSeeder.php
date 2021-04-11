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
        $users      = User::where('id','<','4')->pluck('id')->toArray();
        $brands     = Brands::where('id','<','4')->pluck('id')->toArray();
        $categories = Category::where('id','<','4')->pluck('id')->toArray();

        for ($i=0; $i <10 ; $i++) { 
            factory(Items::class)->create([
                'name'        => 'iphone '.$i,
                'users_id'    => $users[array_rand($users)],
                'brand_id'    => $brands[array_rand($brands)],
                'category_id' => $categories[array_rand($categories)]
            ]);
        }
    }
}
