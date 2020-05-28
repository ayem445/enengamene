<template>

  <div class="container">
    <h5 class="text-left">
      <button class="btn btn-outline-success btn-sm" @click="creerNouvelleSession()">
        Nouvelle Session
      </button>
    </h5>

    <div class="container" v-for="session, key in sessions">
        <div class="row no-gutters pricing-4">
          <div class="col-12 col-md-9 plan-description">
            <h6>{{ session.libelle }}</h6>
            <p class="">{{ session.description }}
              <footer class="blockquote-footer">{{ session.commentaire }}</footer>
            </p>

            <p class="footer-copyright text-left">
              <button class="btn btn-primary btn-xs" @click="editSession(session)">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              <button class="btn btn-danger btn-xs" @click="deleteSession(session.id, key)">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
            </p>

          </div>

          <div class="col-12 col-md-3 plan-price">
            <div class="row">
              <div class="col-sm-3"><i class="fa fa-hourglass-end mr-0"></i></div>
              <div class="col-sm-9">00:01</div>
            </div>

            <div class="row">
              <div class="col-sm-3"><i class="fa fa-file-video-o mr-0"></i></div>
              <div class="col-sm-9">00:02</div>
            </div>

            <div class="row">
              <div class="col-sm-3"><i class="fa fa-file-text-o mr-0"></i></div>
              <div class="col-sm-9">00:03</div>
            </div>
          </div>

        </div>

        <br>
    </div>

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
