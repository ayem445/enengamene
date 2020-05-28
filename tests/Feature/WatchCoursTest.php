<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WatchCoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_terminer_un_chapitre() {
        $this->flushRedis();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([ 'chapitre_id' => 1 ]);
         // post -> terminer-session

         $response = $this->post("/chapitre/terminer-session/{$session->id}", []);
        // asert has
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok'
        ]);
        $this->assertTrue(
            $user->aTermineeSession($session)
        );
        $this->assertFalse(
            $user->aTermineeSession($session2)
        );
    }
}
