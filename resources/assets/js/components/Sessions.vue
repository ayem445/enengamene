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
            <h6>{{ session.libelle }}</h6>
            <p>{{ session.description }}</p>
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
        </a>

        <br>
    </div>

    <creer-session></creer-session>
  </div>

</template>

<script>
export default {
    props: ['default_sessions', 'chapitre_id'],
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
