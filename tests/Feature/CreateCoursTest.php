<?php

namespace Tests\Feature;

use Config;
use Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\User;

class CreateCoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_creer_un_cours()
    {
        $this->withoutExceptionHandling();

        //$this->loginAdmin();

        Storage::fake(config('filesystems.default'));

        $this->post('/admin/cours', [
          'libelle' => 'vuejs for the best',
          'description' => 'the best vue casts ever',
          'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertRedirect()
        ->assertSessionHas('success', 'Cours créé avec succès.');

        Storage::disk(config('filesystems.default'))->assertExists(
          'public/cours/' . Str::slug('vuejs for the best') . '.png'
        );

        $this->assertDatabaseHas('cours', [
          'code' => Str::slug('vuejs for the best')
        ]);
    }

    public function test_un_cours_doit_etre_cree_avec_un_libelle()
    {
        //$this->loginAdmin();
      	$this->post('/admin/cours', [
      		'description' => 'the best vue casts ever',
      		'image' => UploadedFile::fake()->image('image-series.png')
      	])->assertSessionHasErrors('libelle');
    }

    public function test_un_cours_doit_etre_cree_avec_un_description()
    {
        //$this->loginAdmin();
      	$this->post('/admin/cours', [
      		'libelle' => 'the best vue casts ever',
      		'image' => UploadedFile::fake()->image('image-series.png')
      	])->assertSessionHasErrors('description');
    }

    public function test_un_cours_doit_etre_cree_avec_une_image()
    {
        //$this->loginAdmin();
      	$this->post('/admin/cours', [
      		'libelle' => 'the best vue casts ever',
      		'description' => 'course description'
      	])->assertSessionHasErrors('image');
    }

    public function test_seuls_les_administrateurs_peuvent_creer_des_cours()
    {
        $this->actingAs(
            factory(User::class)->create()
        );
        $this->post('admin/cours')
            ->assertSessionHas('error', 'Vous n`êtes pas autorisé à effectuer cette action');
    }
}
