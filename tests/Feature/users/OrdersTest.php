<?php

namespace Tests\Feature\users;

use App\Models\Orders;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    public function setup():void
    {
        parent::setUp();

        $this->user=factory(User::class)->create();
        $this->actingAs($this->user);

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
#########################################    index     ################################
    public function test_index()
    {
        $response = $this->get('/orders/show');

        $response->assertSee('review');
        $response->assertStatus(200);
    }

#########################################      delete      ################################
    public function test_delete()
    {
        $orders   = factory(Orders::class)->create();
        $response = $this->get('orders/cancel/'.$orders->id);

        $this->assertDatabaseMissing('orders',['id'=>$orders->id]);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }


}
