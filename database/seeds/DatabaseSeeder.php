<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name'     => 'ziyad',
            'email'    => 'ziyad199523@yahoo.com',
            'password' => Hash::make('ziyad12'),
        ]);
        */
        //$this->call(CategorySeeder::class);
        //$this->call(BrandSeeder::class);
        //$this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);


        //$this->call(TestSeeder::class);
    }
}
