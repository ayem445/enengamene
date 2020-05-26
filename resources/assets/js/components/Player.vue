<template>
  <div>
    <div :data-vimeo-id="session.lien" data-vimeo-width="900" v-if="session" id="handstick"></div>
  </div>
</template>

<script>

    import Player from '@vimeo/player'
    export default {
        props: ['default_session'],
        data() {
            return {
                session: JSON.parse(this.default_session)
            }
        },
        mounted() {
            const player = new Player('handstick')
        }
    }

</script>
