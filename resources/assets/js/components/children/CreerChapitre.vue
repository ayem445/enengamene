<template>
	<div class="modal fade" id="createChapitre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="modal-title" id="exampleModalLabel">Créer Nouveau Chapitre</h5>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	        </div>
	        <div class="modal-body">
		         <div class="form-group">
	              <input type="text" class="form-control" placeholder="Titre" v-model="chapitre.libelle">
	            </div>
	            <div class="form-group">
	              <input type="number" class="form-control" placeholder="Numéro Ordre" v-model="chapitre.num_ordre">
	            </div>

	            <div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" v-model="chapitre.description"></textarea>
	            </div>
              <div class="form-group">
	            	<textarea cols="30" rows="10" class="form-control" v-model="chapitre.commentaire"></textarea>
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

  class Chapitre {
    constructor(chapitre) {
      this.libelle = chapitre.libelle || ''
      this.num_ordre = chapitre.num_ordre || ''
      this.description = chapitre.description || ''
      this.commentaire = chapitre.commentaire || ''
    }
  }
  export default {

      mounted() {
        this.$parent.$on('creer_nouveau_chapitre', (courId) => {
          this.courId = courId
          this.editing = false
          this.chapitre = new Chapitre({})
          console.log('hello parent, we are creating the chapitre')
          $('#createChapitre').modal()
        })
      },
      data() {
  			return {
  				chapitre: {},
  				courId: '',
  				editing: false,
  				chapitreId: null
  			}
  		}
  }
</script>
