<template>

  <div class="container">

      <h1 class="text-center">
        <button class="btn btn-primary" @click="creerNouveauChapitre()">
          Nouveau Chapitre
        </button>
      </h1>


      <div class="accordion" id="accordion-chapitres">

        <div class="card" v-for="(chapitre, index) in formattedChapitres" v-if="formattedChapitres">
          <h3 class="card-title">
            <a class="d-flex" data-toggle="collapse" data-parent="#accordion-chapitres" :href="'#collapse-chapitres-'+index">
              <span class="mr-auto">{{ chapitre.libelle }}</span>

              <span class="text-lighter hidden-sm-down"><i class="fa fa-signal mr-8"></i> {{ chapitre.difficulte.libelle }}</span>
            </a>
          </h3>

          <div :id="'collapse-chapitres-'+index" class="collapse in">
            <div class="card-block">

               <p class="">
                  <button class="btn btn-primary btn-xs" @click="editChapitre(chapitre)">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" @click="deleteChapitre(chapitre.id, key)">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
              </p>
              <p>{{ chapitre.description }}<br> Durée du chapitre: {{ chapitre.duree }}</p>

              <div class="row">
                <vue-sessions :default_sessions="chapitre.sessions" :chapitre_id="chapitre.id" ></vue-sessions>
              </div>


            </div>
          </div>
        </div>

      </div>

      <creer-chapitre></creer-chapitre>
    </div>

</template>

<script>

import axios from 'axios'

    export default {
        props: ['default_chapitres', 'cour_id'],

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
    				let chapitreIndex = this.chapitre.findIndex(s => {
    					return chapitre.id == s.id
    			  })

            // TODO: Inserer la nouveau chapitre en fonction de son numéro d'ordre (dans le UPDSATE)
  				  this.chapitre.splice(chapitreIndex, 1, chapitre)
            window.noty({
  					   message: 'Chapitre modifié avec succès',
  					   type: 'success'
  				 })

  			 })
  		  },
        components: {
          "creer-chapitre": require('./children/CreerChapitre.vue').default
        },
        data() {
            return {
                chapitres: this.default_chapitres
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
          deleteChapitre(id, key) {
  				if(confirm('Voulez-vous vraiment supprimer ?')) {
  					Axios.delete(`/admin/${this.cour_id}/chapitres/${id}`)
  						 .then(resp => {
  						 	this.sessions.splice(key, 1)
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
