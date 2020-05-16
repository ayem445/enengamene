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

    public function test_un_user_a_un_username_par_defaut_après_enregistrement()
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

    public function test_un_user_a_un_jeton_apres_enregistrement()
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

    public function test_un_email_est_envoye_aux_nouveaux_users_enregistres()
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
