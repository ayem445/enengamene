<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_correct_response_after_user_logs_in()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ], ['X-Requested-With' => 'XMLHttpRequest'])->assertStatus(200)
        ->assertJson([
            'status' => 'ok'
        ])->assertSessionHas('success', 'Connexion réussie.');
    }

    public function test_a_user_receives_correct_message_when_passing_in_wrong_credentials()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ])->assertStatus(422)
        ->assertJson([
            'message' => 'Ces informations d`identification ne correspondent pas à nos enregistrements.'
        ]);
    }
}
