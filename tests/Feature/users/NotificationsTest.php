<?php

namespace Tests\Feature\users;

use App\Models\Comments;
use App\Models\Items;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class NotificationsTest extends TestCase
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
#####################################      show      ##################################
    public function test_show()
    {
        $user=$this->user;
        $item=factory(Items::class)->create([
            'users_id'=>$user->id
        ]);

        factory(Comments::class)->create([
            'user_id'=>4,
            'item_id'=>$item->id
        ]);

        $response = $this->get('/notifications/show');

        $response->assertJson(['notifs_not_read_count'=>1]);
        $response->assertStatus(200);
    }

#####################################      update      ##################################
    public function test_update()
    {
        Session::start();
        
        $user=$this->user;
        $item=factory(Items::class)->create([
            'users_id'=>$user->id
        ]);

        factory(Comments::class)->create([
            'user_id'=>4,
            'item_id'=>$item->id
        ]);

        $response = $this->post('/notifications/update',['_token'=>csrf_token()]);

        $this->assertDatabaseHas('comment',['notification'=>1]);
        $response->assertStatus(200);
    }


}
