<template>

  <div class="container">
    <h5 class="text-left">
      <button class="btn btn-outline-success btn-sm" @click="creerNouvelleSession()">
        Nouvelle Session
      </button>
    </h5>

    <div class="container" v-for="session in formattedSessions">
        <a class="row no-gutters pricing-4" href="#">
          <div class="col-12 col-md-9 plan-description">
            <h5>{{ session.libelle }}</h5>
            <p>{{ session.description }}</p>
          </div>

          <div class="col-12 col-md-3 plan-price">
            <h3>Quiz</h3>
            <p>for 100 MB space</p>
          </div>
        </a>

        <br>
    </div>

    <creer-session></creer-session>
  </div>

</template>

<script>
export default {
    props: ['default_sessions'],
    components: {
      "creer-session": require('./children/CreerSession.vue').default
    },
    data() {
        return {
            sessions: this.default_sessions
        }
    },
    computed: {
        formattedSessions() {
            return this.sessions
        }
    },
    methods: {
      creerNouvelleSession() {
        this.$emit('creer_nouvelle_session', this.chapitre_id)
      },
    }
}
</script>
