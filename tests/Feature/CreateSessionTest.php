<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Chapitre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_creer_une_session()
    {
    	// admin/3/lesson
    	$this->loginAdmin();
    	$this->withoutExceptionHandling();
      $chapitre = factory(Chapitre::class)->create();
      $session = [
        'libelle' => 'another sess',
        'description' => 'new lesson description',
        'num_ordre' => 23,
        'lien' => '230485453'
      ];

      $this->postJson("/admin/{$chapitre->id}/sessions", $session)
        ->assertStatus(201)//->assertStatus(200)
        ->assertJson($session);

      $this->assertDatabaseHas('sessions', [
        'libelle' => $session['libelle']
      ]);
    }

    public function test_un_libelle_est_requis_pour_creer_une_session()
    {
    	$this->loginAdmin();
      $chapitre = factory(Chapitre::class)->create();
      $session = [
        'description' => 'new lesson description',
        'num_ordre' => 23,
        'lien' => '230485453'
      ];
      $this->post("/admin/{$chapitre->id}/sessions", $session)
    		->assertSessionHasErrors('libelle');
    }
}
