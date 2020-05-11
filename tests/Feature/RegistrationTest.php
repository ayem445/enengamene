<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ConfirmYourEmail;
use App\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after_registration()
    {
        //Mail::fake();

        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'julian frantz',
            'email' => 'julian@frantz.com',
            'password' => 'secret'
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'username' => Str::slug('julian frantz')
        ]);
    }

    public function test_a_user_has_a_token_after_registration()
    {
        Mail::fake();

        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'kati frantz',
            'email' => 'kati@frantz.com',
            'password' => 'secret'
        ])->assertRedirect();

        $user = User::find(1);
        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed());
    }

    public function test_an_email_is_sent_to_newly_registered_users()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        // register new user
        $this->post('/register', [
            'name' => 'kati frantz',
            'email' => 'kati@frantz.com',
            'password' => 'secret'
        ])->assertRedirect();
        //assert that a particular email was sent
        Mail::assertQueued(ConfirmYourEmail::class);
    }
}
