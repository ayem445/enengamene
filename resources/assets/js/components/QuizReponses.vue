<template>

  <div class="container">

    <table class="table table-cart">
      <tbody valign="middle">

        <tr v-for="(reponse, key) in reponses">
          <td>
            <a class="item-remove" href="#" @click.prevent="deleteReponse(reponse.id, key)"><i class="ti-close"></i></a>
          </td>

          <td>
            <h5><a href="#" @click.prevent="editReponse(reponse)">{{ reponse.libelle }}</a></h5>
            <p>{{ reponse.description }}</p>
          </td>

          <td>
            <label>Réponse valide</label>
            <p>
              <small>
                <span class="badge badge-success" v-if="reponse.is_valide">Oui</span>
                <span class="badge badge-danger" v-else="reponse.is_valide">Non</span>
              </small>
            </p>
          </td>
        </tr>

      </tbody>
    </table>

  </div>

</template>

<script>

  import EventBus from './eventBus';
  import axios from 'axios'

  export default {
      props: ['default_reponses', 'question_id'],
      mounted() {
  			this.$on('reponse_creee', (reponse) => {
          console.log('reception reponse_creee', reponse)
          window.noty({
  					message: 'Reponse créée avec succès',
  					type: 'success'
  				})

  				this.reponses.push(reponse)
  			})

  			this.$on('reponse_updated', (reponse) => {
          // on récupère l'index de reponse modifiée
  				let reponseIndex = this.reponses.findIndex(s => {
  					return reponse.id == s.id
  				})

          // TODO: Inserer la nouvelle reponse en fonction de son numéro d'ordre (dans le UPDSATE)
  				this.reponses.splice(reponseIndex, 1, reponse)
          window.noty({
  					message: 'Reponse modifiée avec succès',
  					type: 'success'
  				})

  			})

        EventBus.$on('reponse_to_update', (upd_data) => {
            // Réponse modifiée à mettre à jour sur la liste
            if (this.question_id == upd_data.questionId) {
              this.updateReponse(upd_data.reponse)
            }
  			})

        EventBus.$on('reponse_to_add', (add_data) => {
            // Réponse créée à insérer sur la liste
            if (this.question_id == add_data.questionId) {
              this.createReponse(add_data.reponse)
            }
  			})
  		},
      components: {

      },
      data() {
          return {
              reponses: this.default_reponses
          }
      },
      computed: {

      },
      methods: {

        deleteReponse(id, key) {
  				if(confirm('Voulez-vous vraiment supprimer ?')) {
  					Axios.delete(`/admin/${this.question_id}/reponses/${id}`)
  						 .then(resp => {
  						 	this.reponses.splice(key, 1)
                window.noty({
  								message: 'Reponse supprimée avec succès',
  								type: 'success'
  							})
  						 }).catch(error => {
  						 	 window.handleErrors(error)
  						 })
  				}
  			},
        editReponse(reponse) {
  				let questionId = this.question_id
  				this.$parent.$emit('edit_reponse', { reponse, questionId })
  			},
        updateReponse(reponse) {
          // on récupère l'index de reponse modifiée
  				let reponseIndex = this.reponses.findIndex(s => {
  					return reponse.id == s.id
  				})

          // TODO: Inserer la nouvelle reponse en fonction de son numéro d'ordre (dans le UPDSATE)
  				this.reponses.splice(reponseIndex, 1, reponse)
          window.noty({
  					message: 'Reponse modifiée avec succès',
  					type: 'success'
  				})
  			},
        createReponse(reponse) {
          window.noty({
  					message: 'Reponse créée avec succès',
  					type: 'success'
  				})

  				this.reponses.push(reponse)
  			}
      }
  }
</script>
