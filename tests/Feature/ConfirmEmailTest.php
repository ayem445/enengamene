<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_confirm_email()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->get("/register/confirm/?token={$user->confirm_token}")
          ->assertRedirect('/')
          ->assertSessionHas('success', 'Votre email a été confirmé.');
        $this->assertTrue($user->fresh()->isConfirmed());
    }

    public function test_a_user_is_redirected_if_token_is_wrong()
    {
        $user = factory(User::class)->create();
        $this->get("/register/confirm/?token=WRONG_TOKEN")
          ->assertRedirect('/')
          ->assertSessionHas('error', 'Jeton de confirmation non reconnu.');
    }
}
