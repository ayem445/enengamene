<template>

  <div class="container">

    <table class="table table-cart">
      <tbody valign="middle">

        <tr v-for="session, key in sessions">
          <td>
            <a class="item-remove" href="#" @click.prevent="deleteSession(session.id, key)"><i class="ti-close"></i></a>
          </td>

          <td>
            <h5>
              <span>
                <small><span class="badge badge-success" style="vertical-align: top">{{ key + 1 }}. </span></small>
                <a href="#" @click.prevent="editSession(session)">{{ session.libelle }}</a>
              </span>
            </h5>
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

          <td valign="center">
            <label>
              <span v-if="session.quiz_id">
                <a :href="'/admin/quizs/' + session.quiz_id ">
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </a>
                <a class="text-danger" href="#" @click.prevent="deleteQuizSession(session.id, session.quiz)">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
              </span>
              <span v-else>
              <a :href="'/admin/quizsessions/' + session.id + '/create' ">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
              </a>
              </span>
            </label>
            <p>
              <small v-if="session.quiz_id && session.quiz.is_complet">
                <div class="btn-group">
                  <span class="badge badge-success">complet</span>
                  <span class="badge badge-info">{{ session.quiz.nbquestions }}</span>
                </div>
              </small>
              <small v-else-if="session.quiz_id">
                <div class="btn-group">
                  <span class="badge badge-danger">incomplet</span>
                  <span class="badge badge-info">{{ session.quiz.nbquestions }}</span>
                </div>
              </small>
              <small v-else>
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
  import Axios from 'axios'

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

        EventBus.$on('session_to_update', (upd_data) => {
            // Session modifiée à mettre à jour sur la liste
            if (this.chapitre_id == upd_data.chapitreId) {
              this.updateSession(upd_data.session)
            }
  			})

        EventBus.$on('session_to_add', (add_data) => {
            // Session créée à insérer sur la liste
            if (this.chapitre_id == add_data.chapitreId) {
              this.createSession(add_data.session)
            }
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
  				this.$parent.$emit('edit_session', { session, chapitreId })
  			},
        updateSession(session) {
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
  			},
        createSession(session) {
          window.noty({
  					message: 'Session créée avec succès',
  					type: 'success'
  				})

  				this.sessions.push(session)
  			},
        deleteQuizSession(sessionId, quiz) {
          if(confirm('Voulez-vous vraiment supprimer ?')) {
            Axios.post(`/admin/quizsessions/${sessionId}/destroy`, quiz)
                .then(resp => {
                    window.noty({
                        message: 'Quiz supprimé avec succès',
                        type: 'success'
                    })
                    let session = resp.data
                    this.updateSessionAttributes(session)
               }).catch(error => {
                 window.handleErrors(error)
               })
          }
        },
        updateSessionAttributes(session) {
          let sessionIndex = this.sessions.findIndex(c => {
            return session.id == c.id
          })

          this.sessions[sessionIndex].quiz_id = session.quiz_id
          this.sessions[sessionIndex].quiz = session.quiz
        }
      }
  }
</script>
