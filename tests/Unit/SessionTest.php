<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Chapitre;
use App\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_peut_obtenir_la_session_suivante_et_precedente_d_une_session() {
        // chapitre de sessions
        $session = factory(Session::class)->create(['num_ordre' => 200]);
        $session2 = factory(Session::class)->create(['num_ordre' => 100, 'chapitre_id' => 1]);
        $session3 = factory(Session::class)->create(['num_ordre' => 300, 'chapitre_id' => 1]);
        // obtenir suivant session, et precedente session
        $this->assertEquals($session->sessionSuiv()->id, $session3->id);
        $this->assertEquals($session3->sessionPrec()->id, $session->id);
        $this->assertEquals($session2->sessionSuiv()->id, $session->id);
        $this->assertEquals($session2->sessionPrec()->id, $session2->id);
        $this->assertEquals($session3->sessionSuiv()->id, $session3->id);
    }
}
