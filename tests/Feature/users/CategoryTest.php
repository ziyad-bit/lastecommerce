<?php

namespace Tests\Feature\users;

use App\Models\Category;
use App\Models\Items;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/category/get');

        $response->assertSee('computers');
        $response->assertStatus(200);
    }

#####################################     
    public function test_show()
    {
        $iphone_category=factory(Category::class)->create([
            'name'=>'iphones'
        ]);

        factory(Items::class)->create([
            'name'=>'apple 100',
            'category_id'=>$iphone_category->id
        ]);

        $response = $this->get('/category/show/items/'.$iphone_category->id);

        $response->assertSee('apple 100');
        $response->assertStatus(200);
    }
}
