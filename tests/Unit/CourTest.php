<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Session;
use App\Chapitre;
use App\Cour;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_cours_peut_obtenir_le_chemin_de_l_image() {
        $cour = factory(\App\Cour::class)->create([
            'image_url' => 'cours-slug.png'
        ]);

        $imagePath = $cour->image_path;
        $this->assertEquals(asset('uploads/cours/cours-slug.png'), $imagePath);
    }

    public function test_peut_obtenir_les_sessions_ordonnes_pour_un_chapitre() {
        // chapitre , sessions
        $session = factory(Session::class)->create(['num_ordre' => 200]);
        $session2 = factory(Session::class)->create(['num_ordre' => 100, 'chapitre_id' => 1]);
        $session3 = factory(Session::class)->create(['num_ordre' => 300, 'chapitre_id' => 1]);
        // appel de la méthode getSessionsOrdonnees
        $sessions = $session->chapitre->getSessionsOrdonnees();
        //s'assurer que les sessions sont dans le bon ordre
        $this->assertInstanceOf(Session::class, $sessions->random());
        $this->assertEquals($sessions->first()->id, $session2->id);
        $this->assertEquals($sessions->last()->id, $session3->id);
    }
}
