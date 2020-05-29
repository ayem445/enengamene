<template>
	<div class="modal fade" id="createSession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" v-if="editing">Modifier Session</h5>
	          <h5 class="modal-title" id="exampleModalLabel" v-else>Créer Nouvelle Session</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		         <div class="form-group">
	              <input type="text" class="form-control" placeholder="Titre" v-model="session.libelle">
	            </div>
							<div class="form-group">
 	              <input type="text" class="form-control" placeholder="Lien/Id Video" v-model="session.lien">
 	            </div>

	            <div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" placeholder="Description" v-model="session.description"></textarea>
	            </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Commentaire" v-model="session.commentaire">
	            </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="button" class="btn btn-primary" @click="updateSession()" v-if="editing">Enregistrer</button>
						<button type="button" class="btn btn-primary" @click="creerSession()" v-else>Créer Session</button>
	        </div>
	      </div>

				<div id="made-in-ny"></div>

	    </div>
	  </div>
</template>

<script>
  import Axios from 'axios'
	import Player from '@vimeo/player'

  class Session {
    constructor(session) {
      this.libelle = session.libelle || ''
			this.lien = session.lien || ''
			this.num_ordre = session.num_ordre || ''
      this.duree = session.duree || ''
      this.description = session.description || ''
      this.commentaire = session.commentaire || ''
    }
  }
  export default {

      mounted() {
        this.$parent.$on('creer_nouvelle_session', (chapitreId) => {
          this.chapitreId = chapitreId
          this.editing = false
          this.session = new Session({})

          $('#createSession').modal()
        })

				this.$parent.$on('edit_session', ({ session, chapitreId }) => {
					this.editing = true
					this.session = new Session(session)
					this.chapitreId = chapitreId
					this.sessionId = session.id

					$('#createSession').modal()
				})
      },
      data() {
  			return {
  				session: {},
  				chapitreId: '',
  				editing: false,
  				sessionId: null
  			}
  		},
			methods: {
				setCurrentVideoInfos(dur) {
					this.session.duree = dur
				},
				creerSession() {
					// Poster les données sur le serveur
					Axios.post(`/admin/${this.chapitreId}/sessions`, this.session).then(resp => {
						this.$parent.$emit('session_creee', resp.data)
						$('#createSession').modal('hide')
					}).catch(error => {
						window.handleErrors(error)
					})
				},
				updateSession() {
					Axios.put(`/admin/${this.chapitreId}/sessions/${this.sessionId}`, this.session)
					 .then(resp => {
					 	$("#createSession").modal('hide')
					 	this.$parent.$emit('session_updated', resp.data)
					 }).catch(error => {
					 	window.handleErrors(error)
					 })
				}
			}
  }
</script>
