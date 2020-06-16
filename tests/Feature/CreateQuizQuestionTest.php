<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Quiz;
use App\QuizQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateQuizQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_creer_une_question_de_quiz()
    {
        // $this->loginAdmin();
        // $this->withoutExceptionHandling();
        //
        // factory(Quiz::class)->create();
        //
        // $quizquestion = [
        //   'libelle' => 'New Question',
        //   'description' => 'new question description',
        //   'commentaire' => 'new question comment',
        //   'quiz_id' => 1
        // ];
        //
        // $this->postJson("/admin/1/quizquestions", $quizquestion)
        //   ->assertStatus(201)//->assertStatus(200)
        //   ->assertJson($quizquestion);
        //
        // $this->assertDatabaseHas('quiz_questions', [
        //   'libelle' => $quizquestion['libelle']
        // ]);
    }

    public function test_un_user_peut_modiffier_une_question_de_quiz()
    {
        // $this->loginAdmin();
        // $this->withoutExceptionHandling();
        //
        // $quizquestion = [
        //   'libelle' => 'New Question',
        //   'description' => 'new question description',
        //   'commentaire' => 'new question comment',
        //   'quiz_id' => 1
        // ];
        //
        // $this->postJson("/admin/quizquestions", $quizquestion);
        //
        // $quizquestion_fromdb = QuizQuestion::find(1);
        // $quizquestion_fromdb->libelle = 'Question Updated';
        // $upd_param = $quizquestion_fromdb->toArray();
        //
        // $this->putJson("/admin/quizquestions/1", $upd_param)
        //   ->assertStatus(200)
        //   ->assertJson($upd_param);
        //
        // $this->assertDatabaseHas('quiz_questions', [
        //   'libelle' => $quizquestion_fromdb->libelle
        // ]);

    }
}
