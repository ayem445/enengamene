<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_reponse_correcte_apres_la_connexion_du_user()
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

    public function test_un_user_recoit_le_message_adequat_lorsqu_il_transmet_des_informations_d_identification_incorrectes()
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
