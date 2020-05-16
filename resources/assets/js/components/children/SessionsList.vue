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
            <h3>$0</h3>
            <p>for 100 MB space</p>
          </div>
        </a>

        <br>
    </div>
  </div>

</template>

<script>
export default {
    props: {
        default_sessions: {
            type: Array
        }
    },
    components: {

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

    }
}
</script>
