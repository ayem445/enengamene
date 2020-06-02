<template>
	<div class="modal fade" id="createQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" v-if="editing">Modifier Question</h5>
	          <h5 class="modal-title" id="exampleModalLabel" v-else>Nouvelle Question</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		         <div class="form-group">
	              <input type="text" class="form-control" placeholder="Libellé" v-model="question.libelle">
	            </div>

	            <div class="form-group">
	            	<textarea cols="20" rows="5" class="form-control" placeholder="Description" v-model="question.description"></textarea>
	            </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Commentaire" v-model="question.commentaire">
	            </div>
							<div class="form-group">
                <input type="text" class="form-control" hidden placeholder="QuizId" v-model="question.quiz_id">
	            </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="button" class="btn btn-primary" @click="updateQuestion()" v-if="editing">Enregistrer</button>
						<button type="button" class="btn btn-primary" @click="creerQuestion()" v-else>Créer Question</button>
	        </div>
	      </div>

	    </div>
	  </div>
</template>

<script>
  import Axios from 'axios'

  class Question {
    constructor(question) {
			this.id = question.id || ''
      this.libelle = question.libelle || ''
      this.description = question.description || ''
			this.commentaire = question.commentaire || ''
      this.quiz_id = question.quiz_id || ''
    }
  }
  export default {

      mounted() {
        this.$parent.$on('creer_nouvelle_question', (quizId) => {
          this.quizId = quizId
          this.editing = false
          this.question = new Question({})
					this.question.quiz_id = quizId

          $('#createQuestion').modal()
        })

				this.$parent.$on('edit_question', ({ question, quizId }) => {
					this.editing = true
					this.question = new Question(question)
					this.quizId = quizId
					this.questionId = question.id

					$('#createQuestion').modal()
				})
      },
      data() {
  			return {
  				question: {},
  				quizId: '',
  				editing: false,
  				questionId: null
  			}
  		},
			methods: {
				creerQuestion() {
					// Poster les données sur le serveur
					Axios.post(`/admin/${this.quizId}/quizquestions`, this.question).then(resp => {
						this.$parent.$emit('question_creee', resp.data)
						$('#createQuestion').modal('hide')
					}).catch(error => {
						window.handleErrors(error)
					})
				},
				updateQuestion() {
					Axios.put(`/admin/${this.quizId}/quizquestions/${this.questionId}`, this.question)
					 .then(resp => {
					 	$("#createQuestion").modal('hide')
					 	this.$parent.$emit('question_updated', resp.data)
					 }).catch(error => {
					 	window.handleErrors(error)
					 })
				}
			}
  }
</script>
