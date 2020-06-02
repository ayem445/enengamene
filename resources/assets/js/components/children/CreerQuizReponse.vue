<template>

	<div class="modal fade" id="createReponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" v-if="editing">Modifier Réponse</h5>
					<h5 class="modal-title" id="exampleModalLabel" v-else>Nouvelle Réponse</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Libellé" v-model="reponse.libelle">
					</div>
					<div class="form-group">
						<textarea cols="20" rows="5" class="form-control" placeholder="Description" v-model="reponse.description"></textarea>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Commentaire" v-model="reponse.commentaire">
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><input type="checkbox" id="isValideCheck" v-model="reponse.is_valide" /></span>
							<label class="form-control">Bonne Réponse</label>
						</div>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" hidden placeholder="QuizId" v-model="reponse.quiz_question_id">
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="button" class="btn btn-primary" @click="updateReponse()" v-if="editing">Enregistrer</button>
					<button type="button" class="btn btn-primary" @click="creerReponse()" v-else>Créer Reponse</button>
				</div>

			</div>
		</div>
	</div>

</template>

<script>

  import Axios from 'axios'
  class Reponse {
    constructor(reponse) {
			this.id = reponse.id || ''
      this.libelle = reponse.libelle || ''
      this.description = reponse.description || ''
      this.commentaire = reponse.commentaire || ''
      this.is_valide = reponse.is_valide || 0
			this.quiz_question_id = reponse.quiz_question_id || ''
    }
  }
  export default {

      mounted() {
        this.$parent.$on('creer_nouvelle_reponse', ({ questionId }) => {
          this.questionId = questionId
          this.editing = false
          this.reponse = new Reponse({})
					// TODO: A retirer car question pris en compte dans la route ({quizquestion_by_id})
          this.reponse.quiz_question_id = questionId
					console.log('on creer_nouvelle_reponse', this.reponse, questionId)
          $('#createReponse').modal()
        })

				this.$parent.$on('edit_reponse', ({ reponse, questionId }) => {
					this.editing = true
					this.reponse = new Reponse(reponse)
					this.questionId = questionId
					this.reponseId = reponse.id
          this.reponse.quiz_question_id = questionId

					$('#createReponse').modal()
				})
      },
      data() {
  			return {
  				reponse: {},
  				questionId: '',
  				editing: false,
  				reponseId: null
  			}
  		},
			methods: {
				setCurrentVideoInfos(dur) {
					this.reponse.duree = dur
				},
				creerReponse() {
					// Poster les données sur le serveur
					Axios.post(`/admin/${this.questionId}/quizreponses`, this.reponse).then(resp => {
						this.$parent.$emit('reponse_creee', resp.data, this.questionId)
						$('#createReponse').modal('hide')
					}).catch(error => {
						window.handleErrors(error)
					})
				},
				updateReponse() {
					Axios.put(`/admin/${this.questionId}/quizreponses/${this.reponseId}`, this.reponse)
					 .then(resp => {
					 	$("#createReponse").modal('hide')
					 	this.$parent.$emit('reponse_updated', resp.data, this.questionId)
					 }).catch(error => {
					 	window.handleErrors(error)
					 })
				}
			}
  }
</script>
