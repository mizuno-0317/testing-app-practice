<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_user()
    {
        $user=User::factory()->create([
            'name'=>'Test name',
            'email'=>'test@example.com',
        ]);


        $this->assertDatabaseHas('users',[
            'name'=>'Test name',
            'email'=>'test@example.com',
        ]);
    }


    public function test_email_must_be_unique()
    {
        User::factory()->create([
        'email'=>'duplicate@example.com',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'email'=>'duplicate@example.com',
        ]);
    }

}
