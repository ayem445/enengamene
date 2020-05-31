<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Chapitre;
use App\Cour;
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

    public function test_peut_naviguer_vers_le_prochain_et_precedent_chapitre_du_cours() {
        // on crée le cours 1 & 2
        $cour1 = factory(Cour::class)->create();
        $cour2 = factory(Cour::class)->create();
        // on crée et met les chapitre 1 & 2 dans le cours 1
        $chapitre1 = factory(Chapitre::class)->create(['num_ordre' => 1, 'cour_id' => $cour1->id]);
        $chapitre2 = factory(Chapitre::class)->create(['num_ordre' => 2, 'cour_id' => $cour1->id]);

        // on crée et met la session 1 dans le chapitre 1
        $session1 = factory(Session::class)->create(['num_ordre' => 1, 'chapitre_id' => $chapitre1->id]);
        // on crée et met les session 2 & 3 dans le chapitre 2
        $session2 = factory(Session::class)->create(['num_ordre' => 1, 'chapitre_id' => $chapitre2->id]);
        $session3 = factory(Session::class)->create(['num_ordre' => 2, 'chapitre_id' => $chapitre2->id]);

        //
        $this->assertEquals($session1->sessionSuiv()->id, $session2->id);
        $this->assertEquals($session1->sessionPrec()->id, $session1->id);
        $this->assertEquals($session2->sessionPrec()->id, $session1->id);
        $this->assertEquals($session3->sessionSuiv()->id, $session3->id);
    }
}
