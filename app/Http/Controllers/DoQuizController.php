<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizQuestion;
use App\QuizReponseUser;
use App\QuizQuestionUser;

class DoQuizController extends Controller
{
    public function showQuiz(Quiz $quiz) {
        $questions = QuizQuestion::with('reponses')->where('quiz_id', $quiz->id)->orderBy('id', 'asc')->get();
        return view('doquiz', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    /**
     * Enregistre via ajax les résultats d'un quiz effectué par un user
     *
     * @param App\Session $session
     * @return json response
     */
    public function saveQuiz(Quiz $quiz, Request $request) {
        $user = auth()->user()->get();
        $questions = $request->all();

        foreach ($questions as $question){
            $questionuser = QuizQuestionUser::where('quiz_question_id', $question['id'])->where('user_id', auth()->user()->id)->first();
            if ($questionuser) {
              // On supprime les précédentes réponses à cette question
              QuizReponseUser::where('quiz_question_user_id', $questionuser->id)->delete();
              // On marque la date de mise à jour
              $questionuser->update();
            } else {
              // On créer un nouvelle objet user-question
              $questionuser = QuizQuestionUser::create([
                'user_id' => auth()->user()->id,'quiz_question_id' => $question['id'], 'is_valide' => $question['userreponsevalide']
              ]);
            }

            if ($question['quiz_type_question_id'] == 1) {
              // Question choix-multiple
              foreach ($question['reponses'] as $reponse) {
                if ($reponse['selectedbyuser']) {
                  QuizReponseUser::create([
                    'quiz_question_user_id' => $questionuser->id, 'reponse' => $reponse['libelle'], 'is_valide' => $reponse['is_valide']
                  ]);
                }
              }
            } else {
              // Question texte-libre

              QuizReponseUser::create([
                'quiz_question_user_id' => $questionuser->id, 'reponse' => $question['userreponse'], 'is_valide' => $reponse['is_valide']
              ]);
            }
        }

        return $questions[0];
    }
}
