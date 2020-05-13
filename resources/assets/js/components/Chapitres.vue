<template>
  <div class="container">
    <h1>Chapitres:</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="chapitre in formattedChapitres">
          {{ chapitre.libelle }}
      </li>
    </ul>
  </div>
</template>

<script>
    export default {
        props: ['default_chapitres'],
        data() {
            return {
                chapitres: this.default_chapitres
            }
        },
        computed: {
            formattedChapitres() {
                return JSON.parse(this.chapitres)
            }
        }
    }
</script>
