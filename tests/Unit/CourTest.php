<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Chapitre;
use App\Cour;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_cours_peut_obtenir_le_chemin_de_l_image() {
        $series = factory(\App\Cour::class)->create([
            'image_url' => 'cours-slug.png'
        ]);
        
        $imagePath = $series->image_path;
        $this->assertEquals(asset('uploads/cours/cours-slug.png'), $imagePath);
    }
}
