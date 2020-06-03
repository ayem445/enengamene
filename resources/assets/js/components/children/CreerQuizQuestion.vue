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
								<multiselect
						      id="m_select"
						      v-model="question.typequestion"
						      selected.sync="question.typequestion"
						      value=""
						      :options="typequestions"
						      :searchable="true"
						      :multiple="false"
						      label="libelle"
						      track-by="id"
						      key="id"
						      placeholder="Type Question"
						       >
						    </multiselect>
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
						<button type="button" class="btn btn-primary" @click="updateQuestion()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</button>
						<button type="button" class="btn btn-primary" @click="creerQuestion()" :disabled="!isValidCreateForm" v-else>Créer Question</button>
	        </div>
	      </div>

	    </div>
	  </div>
</template>

<script>
  import Axios from 'axios'
	import Multiselect from 'vue-multiselect'
	//@select="onSelected" @remove="onRemove"
  class Question {
    constructor(question) {
			this.id = question.id || ''
			this.libelle = question.libelle || ''
      this.typequestion = question.typequestion || ''
      this.description = question.description || ''
			this.commentaire = question.commentaire || ''
      this.quiz_id = question.quiz_id || ''
    }
  }
  export default {
			components: { Multiselect },
			//props: ['default_typequestions'],
			props: {
				typequestions_toselect: {}
			},
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
					loading: false,
  				questionId: null,
					typequestions: JSON.parse(this.typequestions_toselect)
  			}
  		},
			methods: {
				creerQuestion() {
					// Poster les données sur le serveur
					this.loading = true
					Axios.post(`/admin/${this.quizId}/quizquestions`, this.question).then(resp => {
						this.loading = false
						this.$parent.$emit('question_creee', resp.data)
						$('#createQuestion').modal('hide')
					}).catch(error => {
						this.loading = false
						window.handleErrors(error)
					})
				},
				updateQuestion() {
					Axios.put(`/admin/${this.quizId}/quizquestions/${this.questionId}`, this.question)
					 .then(resp => {
						this.loading = false
					 	$("#createQuestion").modal('hide')
					 	this.$parent.$emit('question_updated', resp.data)
					 }).catch(error => {
					 	window.handleErrors(error)
					 })
				},
				onSelected (selectedOption, id) {
	        this.value = selectedOption
	        this.selectedVal = JSON.stringify(selectedOption)
	      },
	      onRemove (removedOption, id) {
	        this.value = null
	        this.selectedVal = null
	      }
			},
			computed: {
				isValidCreateForm() {
					return this.question.libelle && this.question.typequestion && this.question.description && !this.loading
				}
			}
  }
</script>
