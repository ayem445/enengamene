<?php

namespace Tests\Feature;

use Storage;
use App\NiveauEtude;
use App\Auteur;
use App\Matiere;
use App\Cour;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCourTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_modifier_un_cour() {
        // login as admin
        $this->withoutExceptionHandling();
        $this->loginAdmin();
        //put request to the specified endpoint
        $cour = factory(Cour::class)->create();
        $matiere = factory(Matiere::class)->create();
        $auteur = factory(Auteur::class)->create();
        $niveau_etude = factory(NiveauEtude::class)->create();

        Storage::fake(config('filesystems.default'));

        $this->put(route('cours.update', $cour->id), [
            'libelle' => 'new cours title',
            'description' => 'new cours description',
            'matiere' => json_encode($matiere->mapped('libelle')),
            'auteur' => json_encode($auteur->mapped('nomComplet')),
            'niveau_etude' => json_encode($niveau_etude->mapped('libelle')),
            'image' => UploadedFile::fake()->image('image-cours.png')
        ])->assertRedirect(route('cours.index'))
          ->assertSessionHas('success', 'Cours mis à jour avec succès');
        //assert storage image
        // Storage::disk(config('filesystems.default'))->assertExists(
        // 'public/cours/' . str_slug('new cours title') . '.png'
        // );
        //assert that db has a particular
        // $this->assertDatabaseHas('cours', [
        //     'slug' => str_slug('new cours title'),
        //     'image_url' => 'cours/new-cours-title.png'
        // ]);
    }
}
