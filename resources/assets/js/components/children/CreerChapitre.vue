<template>
	<div class="modal fade" id="createChapitre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel" v-if="editing">Modifier chapitre</h5>
	          <h5 class="modal-title" id="exampleModalLabel" v-else>Créer Nouveau Chapitre</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		         <div class="form-group">
	              <input type="text" class="form-control" placeholder="Titre" v-model="chapitre.libelle">
	            </div>
							<div class="form-group">
								<multiselect
						      id="m_select"
						      v-model="chapitre.difficulte"
						      selected.sync="chapitre.difficulte"
						      value=""
						      :options="difficultes"
						      :searchable="true"
						      :multiple="false"
						      label="libelle"
						      track-by="id"
						      key="id"
						      placeholder="Difficulté"
						       >
						    </multiselect>
	            </div>
	            <div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" placeholder="Description" v-model="chapitre.description"></textarea>
	            </div>
							<div class="form-group">
                <input type="text" class="form-control" placeholder="Commentaire" v-model="chapitre.commentaire">
	            </div>
	        </div>
	        <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	          			<button type="button" class="btn btn-primary" @click="updateChapitre()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</button>
						<button type="button" class="btn btn-primary" @click="creerChapitre()" :disabled="!isValidCreateForm" v-else>Créer Chapitre</button>
	        </div>
	      </div>
	    </div>
	  </div>
</template>

<script>

  import Axios from 'axios'
	import Multiselect from 'vue-multiselect'

  class Chapitre {
    constructor(chapitre) {
			this.libelle = chapitre.libelle || ''
      this.difficulte = chapitre.difficulte || ''
      this.num_ordre = chapitre.num_ordre || ''
      this.description = chapitre.description || ''
      this.commentaire = chapitre.commentaire || ''
    }
  }
  export default {
			components: { Multiselect },
			//props: ['default_typequestions'],
			props: {
				difficultes_toselect: {}
			},
      mounted() {
        this.$parent.$on('creer_nouveau_chapitre', (courId) => {
          this.courId = courId
          this.editing = false
          this.chapitre = new Chapitre({})
          $('#createChapitre').modal()
		})
		this.$parent.$on('edit_chapitre', ({ chapitre, chapitreId, courId }) => {
					this.editing = true
					this.chapitre = new Chapitre(chapitre)
					this.courId = courId
					this.chapitreId = chapitre.id

					$('#createChapitre').modal()
				})
      },
      data() {
  			return {
  				chapitre: {},
  				courId: '',
  				editing: false,
					loading: false,
  				chapitreId: null,
					difficultes: JSON.parse(this.difficultes_toselect)
  			}
		  },

		  methods: {
				creerChapitre() {
					this.loading = true
					Axios.post(`/admin/${this.courId}/chapitres`, this.chapitre).then(resp => {
						this.loading = false
						this.$parent.$emit('chapitre_cree', resp.data)
						$('#createChapitre').modal('hide')
					}).catch(error => {
						this.loading = false
						window.handleErrors(error)
					})
				},
				updateChapitre() {
					this.loading = true
					Axios.put(`/admin/${this.courId}/chapitres/${this.chapitreId}`, this.chapitre).then(resp => {
						this.loading = false
						 this.$parent.$emit('chapitre_updated', resp.data)

						 $("#createChapitre").modal('hide')
					 }).catch(error => {
						this.loading = false
					 	window.handleErrors(error)
					 })
				}
			},
			computed: {
				isValidCreateForm() {
					return this.chapitre.libelle && this.chapitre.difficulte && this.chapitre.description && !this.loading
				}
			}
  }
</script>
