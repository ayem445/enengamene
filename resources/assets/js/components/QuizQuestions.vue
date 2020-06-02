<template>

  <div class="container">

      <h1 class="text-center">
        <button class="btn btn-primary" @click="creerNouvelleQuestion()">
          <i class="fa fa-plus" aria-hidden="true"></i> Question
        </button>
      </h1>

      <div class="accordion" id="accordion-questions">

        <div class="card" v-for="(question, index) in questions" v-if="questions">
          <h3 class="card-title">
            <a class="d-flex" data-toggle="collapse" data-parent="#accordion-questions" :href="'#collapse-questions-'+index">
              <span class="mr-auto">{{ question.libelle }}</span>

              <span class="text-lighter">
                <small v-if="question.quiz_type_question_id == 1"><i class="fa fa-check" aria-hidden="true"></i> Choix-multiple</small>
                <small v-else><i class="fa fa-pencil" aria-hidden="true"></i> Libre</small>
              </span>
            </a>
          </h3>

          <div :id="'collapse-questions-'+index" class="collapse in">
            <div class="card-block">

              <p>{{ question.description }}</p>
              <footer class="blockquote-footer">{{ question.commentaire }}</footer>
               <p class="">
                  <button class="btn btn-primary btn-xs" @click="editQuestion(question)">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Question
                  </button>
                  <button class="btn btn-danger btn-xs" @click="deleteQuestion(question.id, index)">
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Question
                  </button>
                  <button class="btn btn-success btn-xs" @click="creerNouvelleReponse(question.id, index)">
                    <i class="fa fa-plus" aria-hidden="true"></i> Réponse
                  </button>
              </p>

              <div class="row">
                <QuizReponses :default_reponses="question.reponses" :question_id="question.id" ></QuizReponses>
              </div>

            </div>
          </div>
        </div>

      </div>

      <CreerQuizQuestion></CreerQuizQuestion>
      <CreerQuizReponse></CreerQuizReponse>
    </div>

</template>

<script>

    import EventBus from './eventBus';
    import axios from 'axios'
    import QuizReponses from './QuizReponses.vue'
    import CreerQuizQuestion from './children/CreerQuizQuestion.vue'
    import CreerQuizReponse from './children/CreerQuizReponse.vue'

    export default {
        props: ['default_questions', 'quiz_id'],
        mounted() {
    			this.$on('question_creee', (question) => {
            console.log(question)
            window.noty({
    					message: 'Question créée avec succès',
    					type: 'success'
    				})
            // insert le nouveau dans le tableau des questions
    				this.questions.push(question)
    			})

    			this.$on('question_updated', (question) => {
            // on récupère l'index du question modifiée
    				let questionIndex = this.questions.findIndex(s => {
    					return question.id == s.id
    			  })

            // TODO: Inserer la nouveau question en fonction de son numéro d'ordre (dans le UPDSATE)
  				  this.questions.splice(questionIndex, 1, question)
            window.noty({
  					   message: 'Question modifiée avec succès',
  					   type: 'success'
  				 })

  			 })

         this.$on('reponse_updated', (reponse, questionId) => {
           // recoit réponse à modifier
           EventBus.$emit('reponse_to_update', {reponse, questionId})
         })

         this.$on('reponse_creee', (reponse, questionId) => {
           // recoit nouvelle réponse créée
           EventBus.$emit('reponse_to_add', {reponse, questionId})
         })
  		  },
        components: {
          QuizReponses,
          CreerQuizQuestion,
          CreerQuizReponse
          //"creer-quizquestion": require('./children/CreerQuizQuestion.vue').default;
          //"vue-quizreponses": require('./children/QuizReponses.vue').default;
        },
        data() {
            return {
                questions: JSON.parse(this.default_questions)
            }
        },
        computed: {
          formattedQuestions() {
            return JSON.parse(this.default_questions)
          }
        },
        methods: {
      			creerNouvelleQuestion() {
              this.$emit('creer_nouvelle_question', this.quiz_id)
            },
            creerNouvelleReponse(questionId, key) {
       				this.$emit('creer_nouvelle_reponse', { questionId })
     			  },
            deleteQuestion(id, key) {
    				if(confirm('Voulez-vous vraiment supprimer ?')) {
    					Axios.delete(`/admin/${this.quiz_id}/questions/${id}`)
    						 .then(resp => {
    						 	this.reponses.splice(key, 1)
                  window.noty({
    								message: 'Question supprimée avec succès',
    								type: 'success'
    							})
    						 }).catch(error => {
    						 	 window.handleErrors(error)
    						 })
    				  }
    			 },
           editQuestion(question) {
              let questionId = this.question_id
              let quizId = this.quiz_id
      				this.$emit('edit_question', { question, questionId, quizId})
    			  }
      }

    }
</script>
