<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Redis;
use App\User;
use App\Cour;
use App\Session;
use App\Chapitre;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_user_peut_terminer_une_session() {
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([
            'chapitre_id' => 1
        ]);
        $user->terminerSession($session);
        $user->terminerSession($session2);
        $this->assertEquals(
            Redis::smembers('user:1:cour:1:chapitre:1'),
            [1, 2]
        );

        $this->assertEquals(
            $user->getNombreSessionsTermineesPourChapitre($session->chapitre),
            2
        );
    }

    public function test_un_user_peut_obtenir_le_pourcentage_realise_par_chapitre() {
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        factory(Session::class)->create(['chapitre_id' => 1]);
        factory(Session::class)->create(['chapitre_id' => 1]);
        $session2 = factory(Session::class)->create([
            'chapitre_id' => 1
        ]);
        $user->terminerSession($session);
        $user->terminerSession($session2);

        $this->assertEquals(
            $user->pourcentageTerminePourChapitre($session->chapitre),
            50
        );
    }

    public function test_peut_savoir_si_un_user_a_demarrer_un_chapitre() {
        //user, 2 chapitre,
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([
            'chapitre_id' => 1
        ]);
        $session3 = factory(Session::class)->create();
        //un user lit une session dans le 1er chapitre
        $user->terminerSession($session2);
        //affirmer que aDemarreLeChapitre(1) retourne true
        $this->assertTrue($user->aDemarreLeChapitre($session->chapitre));
        $this->assertFalse($user->aDemarreLeChapitre($session3->chapitre));
    }

    public function test_peut_obtenir_les_sessions_terminees_pour_un_chapitre() {
        // user , series
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([ 'chapitre_id' => 1 ]);
        $session3 = factory(Session::class)->create([ 'chapitre_id' => 1 ]);
        //terminer quelques sessions dans le chapitre
        $user->terminerSession($session);
        $user->terminerSession($session2);
        //méthode obtenir les sessions terminees
        $sessionsTerminees = $user->getSessionsTerminees($session->chapitre);
        //affirmer que les sessions terminées sont dans la valeur de retour
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $sessionsTerminees);
        $this->assertInstanceOf(Session::class, $sessionsTerminees->random());
        $sessionsTermineesIds = $sessionsTerminees->pluck('id')->all();
        $this->assertTrue(in_array($session->id, $sessionsTermineesIds));
        $this->assertTrue(in_array($session2->id, $sessionsTermineesIds ));
        $this->assertFalse(in_array($session3->id, $sessionsTermineesIds));
    }

    public function test_peut_savoir_si_un_user_a_demarrer_un_cour() {
        //user, 2 chapitre,
        $this->flushRedis();
        $user = factory(User::class)->create();

        // on crée un 1er chapitre
        $chapitre = factory(Chapitre::class)->create();

        // on crée et assigne 2 session au 1er chapitre
        $session = factory(Session::class)->create([
            'chapitre_id' => 1
        ]);
        $session2 = factory(Session::class)->create([
            'chapitre_id' => 1
        ]);

        // on crée un 2e chapitre
        $chapitre2 = factory(Chapitre::class)->create();
        // on crée et assigne une session au 2e chapitre
        $session3 = factory(Session::class)->create([
            'chapitre_id' => $chapitre2->id
        ]);
        //un user lit une session dans le 1er chapitre
        $user->terminerSession($session2);
        //affirmer que aDemarreLeCours(1) retourne true
        $this->assertTrue($user->aDemarreLeCours($chapitre->cour));
        $this->assertFalse($user->aDemarreLeCours($chapitre2->cour));
    }

    public function test_peut_verifier_si_un_user_a_termine_une_session() {
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([ 'chapitre_id' => 1 ]);
        //complete a session
        $user->terminerSession($session);
        //assert true,
        $this->assertTrue($user->aTermineeSession($session));
        $this->assertFalse($user->aTermineeSession($session2));
    }

    public function test_peut_obtenir_tous_les_cours_en_cours_de_visionnage_par_un_user() {
        $this->flushRedis();
        $user = factory(User::class)->create();
        $session = factory(Session::class)->create();
        $session2 = factory(Session::class)->create([ 'chapitre_id' => 1 ]); // donc cours 1
        $session3 = factory(Session::class)->create();
        $session4 = factory(Session::class)->create([ 'chapitre_id' => 2 ]); // donc cours 2
        $session5 = factory(Session::class)->create();
        $session6 = factory(Session::class)->create([ 'chapitre_id' => 3 ]); // donc cours 3
        // terminer sessions 1 , 2
        $user->terminerSession($session);
        $user->terminerSession($session3);

        $startedCours = $user->coursEnVisionnage();
        // collection de Cour
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $startedCours);
        $this->assertInstanceOf(\App\Cour::class, $startedCours->random());
        $idsOfStartedCours = $startedCours->pluck('id')->all();

        $this->assertTrue(
            in_array($session->chapitre->cour_id, $idsOfStartedCours)
        );
        $this->assertTrue(
            in_array($session3->chapitre->cour_id, $idsOfStartedCours)
        );
        $this->assertFalse(
            in_array($session6->chapitre->cour_id, $idsOfStartedCours)
        );
        //assert 1 , 2
        // assert 3
    }
}
