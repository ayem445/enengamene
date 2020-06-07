<template>

  <div class="container">

      <h1 class="text-center">
        <button class="btn btn-primary" @click="creerNouveauChapitre()">
          <i class="fa fa-plus" aria-hidden="true"></i> Chapitre
        </button>
      </h1>


      <div class="accordion" id="accordion-chapitres">

        <div class="card" v-for="(chapitre, index) in chapitres" v-if="chapitres">
          <h3 class="card-title">
            <a class="d-flex" data-toggle="collapse" data-parent="#accordion-chapitres" :href="'#collapse-chapitres-'+index">
              <span class="mr-auto"> <small><span class="badge badge-primary">{{ index + 1 }}</span></small> {{ chapitre.libelle }}</span>
              <small>
              <span class="text-lighter hidden-sm-down">
                <span v-if="chapitre.difficulte.level == 1">&#128513;</span>
                <span v-else-if="chapitre.difficulte.level == 2">&#128512;</span>
                <span v-else-if="chapitre.difficulte.level == 3">&#128528;</span>
                <span v-else-if="chapitre.difficulte.level == 4">&#128529;</span>
                <span v-else>&#129488;</span>
              {{ chapitre.difficulte.libelle }}</span>
              </small>
            </a>
          </h3>

          <div :id="'collapse-chapitres-'+index" class="collapse in">
            <div class="card-block">

              <p>{{ chapitre.description }}</p>
              <p>
                <a :href="'/admin/quizs/' + chapitre.quiz_id " v-if="chapitre.quiz_id">
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i> <small><span class="badge badge-primary">{{ chapitre.quiz.nbquestions }}</span></small>
                  <small>
                    <span class="badge badge-success" v-if="chapitre.quiz.is_complet">complet</span>
                    <span class="badge badge-danger" v-else>incomplet</span>
                  </small>
                </a>
                <a :href="'/admin/quizchapitres/create/' + chapitre.id " v-else><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
              </p>
              <footer class="blockquote-footer">{{ chapitre.commentaire }}</footer>

              <p class="">
                 <button class="btn btn-primary btn-xs" @click="editChapitre(chapitre)">
                   <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chapitre
                 </button>
                 <button class="btn btn-danger btn-xs" @click="deleteChapitre(chapitre.id, index)">
                   <i class="fa fa-trash-o" aria-hidden="true"></i> Chapitre
                 </button>
                 <button class="btn btn-success btn-xs" @click="creerNouvelleSession(chapitre.id, index)">
                   <i class="fa fa-plus" aria-hidden="true"></i> Session
                 </button>
             </p>

              <div class="row">
                <Sessions :default_sessions="chapitre.sessions" :chapitre_id="chapitre.id" ></Sessions>
              </div>

            </div>
          </div>
        </div>

      </div>

      <CreerChapitre :difficultes_toselect="default_difficultes"></CreerChapitre>
      <CreerSession></CreerSession>
    </div>

</template>

<script>

    import EventBus from './eventBus';
    import Axios from 'axios'
    import Sessions from './Sessions.vue'
    import CreerChapitre from './children/CreerChapitre.vue'
    import CreerSession from './children/CreerSession.vue'

    export default {
        //props: ['default_chapitres', 'cour_id'],
        props: {
          default_chapitres: {},
          cour_id: "",
          default_difficultes: {}
        },

        mounted() {
    			this.$on('chapitre_cree', (chapitre) => {
            window.noty({
    					message: 'Chapitre créée avec succès',
    					type: 'success'
    				})
            // insert le nouveau dans le tableau des chapitres
    				this.chapitres.push(chapitre)
    			})

    			this.$on('chapitre_updated', (chapitre) => {
            // on récupère l'index du chapitre modifiée
    				let chapitreIndex = this.chapitres.findIndex(s => {
    					return chapitre.id == s.id
    			  })

            // TODO: Inserer la nouveau chapitre en fonction de son numéro d'ordre (dans le UPDSATE)
  				  this.chapitres.splice(chapitreIndex, 1, chapitre)
            window.noty({
  					   message: 'Chapitre modifié avec succès',
  					   type: 'success'
  				  })

  			   })

           this.$on('session_creee', (session, chapitreId) => {
             // recoit nouvelle session créée
             EventBus.$emit('session_to_add', {session, chapitreId})
           })

           this.$on('session_updated', (session, chapitreId) => {
             // recoit session à modifier
             EventBus.$emit('session_to_update', {session, chapitreId})
           })
  		  },
        components: {
            Sessions,
            CreerChapitre,
            CreerSession
        },
        data() {
            return {
                chapitres: JSON.parse(this.default_chapitres),
                difficultes: JSON.parse(this.default_difficultes)
            }
        },
        computed: {
                 formattedChapitres() {
                return JSON.parse(this.default_chapitres)
            }
        },
        methods: {
    			creerNouveauChapitre() {
            this.$emit('creer_nouveau_chapitre', this.cour_id)
          },
          creerNouvelleSession(chapitreId, key) {
            this.$emit('creer_nouvelle_session', chapitreId )
          },
          deleteChapitre(id, key) {
    				if(confirm('Voulez-vous vraiment supprimer ?')) {
    					Axios.delete(`/admin/${this.cour_id}/chapitres/${id}`)
                  .then(resp => {
                      this.chapitres.splice(key, 1)
                      window.noty({
                          message: 'Chapitre supprimé avec succès',
                          type: 'success'
                      })
    						 }).catch(error => {
    						 	 window.handleErrors(error)
    						 })
    				}
    			},
          editChapitre(chapitre) {
            let chapitreId = this.chapitre_id
            let courId = this.cour_id
    				this.$emit('edit_chapitre', { chapitre, chapitreId, courId})
    			}
      }

    }
</script>
