<template>
  <FormWizard @on-complete="onComplete" :title="quiz.libelle" :subtitle="quiz.description"
      back-button-text="Précédent"
      next-button-text="Suivant"
      finish-button-text="Validez vos Réponses">
    <div class="card" v-for="(question, qid) in questions" :key="question.id">
     <TabContent>
        <h3 class="card-title">
          {{ question.libelle }}
        </h3>
        <div class="card-block">
          <div class="row" v-if="question.quiz_type_question_id == 1">

            <ul v-for="(reponse, rid) in question.reponses" :key="reponse.id">
                <input type="checkbox" name="" :value="reponse.libelle" @click="onReponseSelect(qid, rid)"> {{ reponse.libelle }}
            </ul>

          </div>
          <div class="row" v-else>
            <input type="text" name="" v-model="question.userreponse">
          </div>
        </div>
     </TabContent>
    </div>
 </FormWizard>

</template>

<script>
  import {FormWizard, TabContent} from 'vue-form-wizard'
  import 'vue-form-wizard/dist/vue-form-wizard.min.css'
  import Axios from 'axios'
  import Swal from 'sweetalert'

  export default {
     props: {
        default_quiz: {},
        default_questions: {},
        next_url: ""
     },
     components: {
        FormWizard,
        TabContent
     },
     data() {
         return {
             quiz: JSON.parse(this.default_quiz),
             questions: JSON.parse(this.default_questions),
             nbquestionstrouvees: 0
         }
     },
     methods: {
      validerQuiz: function() {
          this.nbquestionstrouvees = 0
          let i = 0
          for (i = 0; i < this.questions.length; i++) {
              this.validerQuestion(i)
          }
      },
      validerQuestion: function(qid) {
        // userreponsevalide
        if (this.questions[qid].quiz_type_question_id == 1) {
          // Type: choix-multiple
          // On parcourt les reponses proposées et on s'assure que chaque bonne réponse a été selectionnée par le user
          let allgoodresp = 0
          let allgoodrespuser = 0
          let allbadrespuser = 0
          let i = 0
          for (i = 0; i < this.questions[qid].reponses.length; i++) {

              if (this.questions[qid].reponses[i].is_valide) {
                allgoodresp++
                if (this.questions[qid].reponses[i].selectedbyuser) {
                  allgoodrespuser++
                }
              } else {
                if (this.questions[qid].reponses[i].selectedbyuser) {
                  allbadrespuser++
                }
              }
          }
          // la réponse du user est valide si le nombre de bonnes réponses du user
          // est égale au nombre de bonnes réponses possibles
          // et le nombre de mauvaise réponses données par le user est égale à 0
          this.questions[qid].userreponsevalide = (allgoodresp == allgoodrespuser && allbadrespuser == 0)
        } else {
            // Type: Texte-Libre
            // On parcourt les réponses proposées en recherchant au moins 1 réponse qui est égale à celle du user
            let allgoodrespuser = 0
            let i = 0
            for (i = 0; i < this.questions[qid].reponses.length; i++) {
                if (this.questions[qid].reponses[i].is_valide) {
                  if ( this.questions[qid].reponses[i].libelle.localeCompare(this.questions[qid].userreponse, undefined, { sensitivity: 'base' }) === 0 ) {
                    allgoodrespuser++
                  }
                }
            }
            // la réponse du user est valide si le nombre de bonnes réponses du user
            // est supérieur à 0
            this.questions[qid].userreponsevalide = (allgoodrespuser > 0)
        }
        // On incrément le nobre de réponses trouvées (le cas échéant)
        if (this.questions[qid].userreponsevalide) {
          this.nbquestionstrouvees++
        }
      },
      onReponseSelect: function(qid, rid) {
          let selected = this.questions[qid].reponses[rid].selectedbyuser
          this.questions[qid].reponses[rid].selectedbyuser = (! selected)
          console.log(qid, rid, this.questions[qid],this.questions[qid].reponses[rid])
       },
       onComplete: function() {
          this.validerQuiz()
          let score = ((this.nbquestionstrouvees / this.quiz.nbquestions) * 100).toFixed()
          let scorenotation = ''

          if (score == 100) {
              scorenotation = 'Excellent Travail !'
          } else if (score > 50) {
              scorenotation = 'Bon Travail. Vous etes assez proche de l\'Excellence.'
          } else if (score == 50) {
              scorenotation = 'Travail Moyen. Vous avez une marge de progression.'
          } else if (score == 0) {
              scorenotation = 'Travail Médiocre. Vous pouvez mieux faire.'
          } else {
              scorenotation = 'Travail insuffisant. Vous pouvez mieux faire.'
          }

          this.saveQuizReponses(score, scorenotation)
      },
      saveQuizReponses: function (score, scorenotation) {
          Axios.post(`/doquiz/${this.quiz.id}`, this.questions).then(resp => {

            Swal('Votre score est de ' + score + '% . ' + scorenotation)
            .then(() => {
                window.location = this.next_url
            })

          }).catch(error => {
            window.handleErrors(error)
          })
      }

    }
  }
</script>
