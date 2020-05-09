<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after_registration()
    {
        //Mail::fake();

        //$this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'kati frantz',
            'email' => 'kati@frantz.com',
            'password' => 'secret'
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'username' => Str::slug('kati frantz')
        ]);
    }
}
