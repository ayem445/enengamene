<template>

  <div class="container">
    <h5 class="text-left">
      <button class="btn btn-outline-success btn-sm" @click="creerNouvelleSession()">
        Nouvelle Session
      </button>
    </h5>

    <table class="table table-cart">
      <tbody valign="middle">

        <tr v-for="session, key in sessions">
          <td>
            <a class="item-remove" href="#" @click.prevent="deleteSession(session.id, key)"><i class="ti-close"></i></a>
          </td>

          <td>
            <h5><a href="#" @click.prevent="editSession(session)">{{ session.libelle }}</a></h5>
            <p>{{ session.description }}</p>
          </td>

          <td>
            <label>Dimensions</label>
            <p>{{ session.width }}/{{ session.height }}</p>
          </td>

          <td valign="center">
            <label><i class="fa fa-file-video-o mr-0"></i></label>
            <p>{{ session.duree_hhmmss }}</p>
          </td>
        </tr>

      </tbody>
    </table>

    <creer-session></creer-session>
  </div>

</template>

<script>

  import axios from 'axios'

  export default {
      props: ['default_sessions', 'chapitre_id'],
      mounted() {
  			this.$on('session_creee', (session) => {
          window.noty({
  					message: 'Session créée avec succès',
  					type: 'success'
  				})

  				this.sessions.push(session)
  			})

  			this.$on('session_updated', (session) => {
          // on récupère l'index de session modifiée
  				let sessionIndex = this.sessions.findIndex(s => {
  					return session.id == s.id
  				})

          // TODO: Inserer la nouvelle session en fonction de son numéro d'ordre (dans le UPDSATE)
  				this.sessions.splice(sessionIndex, 1, session)
          window.noty({
  					message: 'Session modifiée avec succès',
  					type: 'success'
  				})

  			})
  		},
      components: {
        "creer-session": require('./children/CreerSession.vue').default
      },
      data() {
          return {
              sessions: this.default_sessions
          }
      },
      computed: {

      },
      methods: {
        creerNouvelleSession() {
          this.$emit('creer_nouvelle_session', this.chapitre_id)
        },
        deleteSession(id, key) {
  				if(confirm('Voulez-vous vraiment supprimer ?')) {
  					Axios.delete(`/admin/${this.chapitre_id}/sessions/${id}`)
  						 .then(resp => {
  						 	this.sessions.splice(key, 1)
                window.noty({
  								message: 'Session supprimée avec succès',
  								type: 'success'
  							})
  						 }).catch(error => {
  						 	 window.handleErrors(error)
  						 })
  				}
  			},
        editSession(session) {
  				let chapitreId = this.chapitre_id
  				this.$emit('edit_session', { session, chapitreId })
  			}
      }
  }
</script>
