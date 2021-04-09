<?php

namespace Tests\Feature\users;

use App\Models\Comments;
use App\Models\Items;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    public function setup():void
    {
        parent::setUp();
        Session::start();

        $this->user=factory(User::class)->create();
        $this->actingAs($this->user);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
#########################################     create      ##############################
    public function test_create()
    {
        $item=factory(Items::class)->create();
        $data=[
            '_token'  => csrf_token(),
            'comment' => 'good',
            'item_id' => $item->id,
        ];

        $response = $this->post('/comments/post/'.$item->id,$data);

        $this->assertDatabaseHas('comment',['comment'=>'good']);
        $response->assertSessionHas('success','you added comment successfully');
        $response->assertStatus(302);
    }

    #########################################     edit      ##############################
    public function test_edit()
    {
        $comment=factory(Comments::class)->create();

        $response = $this->get('/comments/edit/'.$comment->id);

        $response->assertSee($comment->name);
        $response->assertStatus(200);
    }

    #########################################     update      ##############################
    public function test_update()
    {
        $comment=factory(Comments::class)->create();

        $data=[
            '_token'  => csrf_token(),
            'comment' => $comment->comment,
        ];

        $response = $this->post('/comments/update/'.$comment->id,$data);

        $response->assertRedirect('comments/edit/'.$comment->id);
        $this->assertDatabaseHas('comment',['comment'=>$comment->comment]);
    }

    #########################################     delete      ##############################
    public function test_delete()
    {
        $comment=factory(Comments::class)->create();

        $response = $this->get('/comments/delete/'.$comment->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('comment',['comment'=>$comment->comment]);
    }


}
