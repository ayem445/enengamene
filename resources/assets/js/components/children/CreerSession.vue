<template>
	<div class="modal fade" id="createSession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="modal-title" id="exampleModalLabel">Créer Nouvelle Session</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		         <div class="form-group">
	              <input type="text" class="form-control" placeholder="Titre" v-model="session.libelle">
	            </div>
	            <div class="form-group">
	              <input type="number" class="form-control" placeholder="Numéro Ordre" v-model="session.num_ordre">
	            </div>

	            <div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" placeholder="Description" v-model="session.description"></textarea>
	            </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Commentaire" v-model="session.commentaire">
	            </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	  </div>
</template>

<script>
  import Axios from 'axios'

  class Session {
    constructor(session) {
      this.libelle = session.libelle || ''
      this.num_ordre = session.num_ordre || ''
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
          console.log('hello parent, we are creating the session')
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
  		}
  }
</script>
