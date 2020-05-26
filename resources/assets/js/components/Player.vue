<template>
  <div>
    <div :data-vimeo-id="session.lien" data-vimeo-width="900" v-if="session" id="handstick"></div>
  </div>
</template>

<script>
    import Axios from 'axios'
    import Swal from 'sweetalert'
    import Player from '@vimeo/player'
    export default {
        props: ['default_session', 'next_session_url'],
        data() {
            return {
                session: JSON.parse(this.default_session)
            }
        },
        methods: {
            displayVideoEndedAlert() {
                Swal('Félicitation ! Vous avez terminé cette Session !')
                  .then(() => {
                      window.location = this.next_session_url
                  })
            },
            completeLesson() {
                Axios.post(`/chapitre/terminer-session/${this.session.id}`, {})
                     .then(resp => {
                         this.displayVideoEndedAlert()
                     })
            }
        },
        mounted() {
            const player = new Player('handstick')

            player.on('ended', () => {
                this.completeLesson()
            })
        }
    }

</script>
