<?php

namespace Tests\Feature\users;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ProfileTest extends TestCase
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
#########################################     index      ##############################
    public function test_index()
    {
        $user=$this->user;

        $response = $this->get('/profile/get');

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

#########################################     update profile     ##############################
    public function test_update_profile()
    {
        $user=$this->user;

        $data=[
            '_token'   => csrf_token(),
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => '12121212',
            'photo_id' => 1
        ];

        $response = $this->post('/profile/update',$data);

        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
    }


#########################################     update  photo    ##############################
    public function test_update_photo()
    {
        $user=$this->user;

        $file=UploadedFile::fake()->image('image.jpg');
        $data=[
            '_token'   => csrf_token(),
            'id'       => 1,
            'photo'    => $file
        ];

        $response = $this->post('/profile/update/photo',$data);

        $response->assertStatus(200);
        $response->assertJson(['success'=>true]);
    }
}
