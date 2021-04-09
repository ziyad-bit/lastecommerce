<?php

namespace Tests\Feature\users;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Comments;
use App\User;
use Tests\TestCase;
use App\Models\Items;
use App\Models\Orders;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;


class ItemsTest extends TestCase
{
    use DatabaseTransactions;

    private $data;
    private $item;
    private $category;
    private $brand;

    public function setup():void
    {
        parent::setUp();
        Session::start();

        $user           = factory(User::class)->create();
        $this->item     = factory(Items::class)->create();
        $this->category = factory(Category::class)->create();
        $this->brand    = factory(Brands::class)->create();

        $this->actingAs($user);

        $file=UploadedFile::fake()->image('avatar.jpg');
        $this->data=[
            '_token'      => csrf_token(),
            'name'        => 'apple',
            'price'       => '1212',
            'condition'   => 'new',
            'description' => 'bad',
            'category_id' => $this->category->id,
            'brand_id'    => $this->brand->id,
            'users_id'    => $user->id,
            'photo'       => $file,
            'slug'        => 'apple',
            'date'        => now(),
            'id'          => $this->item->id
        ];
        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
#########################################      get create     ###########################    
    public function test_get_create()
    {
        $response=$this->get('items/create');

        $response->assertSee('condition');
        $response->assertStatus(200);
    }

#########################################      post create     ###########################
    public function test_post_create()
    {
        $data=$this->data;

        $response=$this->post('items/post',$data);

        $this->assertDatabaseHas('items',['name'=>'apple']);
        $response->assertSessionHas('success','you created item successfully');
    }

#########################################      get     ####################################
    public function test_get()
    {
        for ($i=0; $i < 3 ; $i++) { 
            factory(Items::class)->create([
                'name'     => 'iphone '.$i,
                'slug'     => 'iphone '.$i,
                'brand_id' => 1
            ]);
        }

        $data=[
            '_token' => csrf_token(),
            'search' => 'iphone',
            'brands' => [1],
            'agax'   => 1
        ];

        $response=$this->post('items/get?page=2',$data);
        
        $response->assertJson(['html'=>true]);
        $response->assertSee('iphone 11');
    }

#########################################      get details     ###########################
    public function test_get_details()
    {
        for ($i=0; $i < 3 ; $i++) { 
            factory(Comments::class)->create([
                'comment'=>'good '.$i,
                'item_id'=>30
            ]);
        }

        $response=$this->call('GET','items/details/iphone-12-1?page=2',['agax'=>1]);
        
        $response->assertJson(['html'=>true]);
        $response->assertSee('bad');
    }

#########################################      get checkout     #########################
    public function test_checkout()
    {
        $data=$this->data;

        $response=$this->call('GET','items/get/checkout',$data);
        
        $response->assertJson(['form'=>true]);
    }

#########################################      delete     ###############################
    public function test_delete()
    {
        $item=$this->item;

        $data=[
            '_token' => csrf_token(),
            'id'     => $item->id,
        ];

        $response=$this->call('delete','items/delete',$data);

        $this->assertDatabaseMissing('items',['id'=>$item->id]);
        $response->assertJson(['success'=>true]);
    }


#########################################      edit     ###############################
    public function test_edit()
    {
        $item=$this->item;

        $response=$this->call('get','items/edit',['id'=>$item->id]);

        $response->assertJson(['item'=>true]);
    }

#########################################      update     ###############################
    public function test_update()
    {
        $data=$this->data;
        
        $response=$this->call('post','items/update',$data);

        $this->assertDatabaseHas('items',['name'=>'apple']);
        $response->assertJson(['item'=>true]);
    }

#########################################      show results     ###############################
    public function test_show_results()
    {
        $item=$this->item;

        $data=[
            'search'=>$item->name,
            '_token'=>csrf_token()
        ];

        $response=$this->call('post','items/show/results',$data);

        $response->assertJson(['search'=>true]);
    }

    #########################################      rate     ###############################
    public function test_rate()
    {
        $order=factory(Orders::class)->create();
        $item=$this->item;

        $data=[
            'order_id' => $order->id,
            'item_id'  => $item->id,
            'rate'     => 4.5,
            '_token'   => csrf_token()
        ];

        $response=$this->call('post','items/rate',$data);
        
        $this->assertDatabaseHas('review',['rate'=>4.5]);
        $response->assertSessionHas('success','thank you for review');
        $response->assertRedirect('orders/show');
    }
    
}
