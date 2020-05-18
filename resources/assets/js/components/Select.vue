<template>
  <div>
    <multiselect
      v-model="value"
      :options="options"
      :searchable="true"
      :multiple="true"
      label="label"
      track-by="value"
      :placeholder="placeholder"
      :name="name"
      @select="onSelect" >
    </multiselect>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect'

  export default {
    components: { Multiselect },
    props: {
      default_options: {},
      default_placeholder: "",
      default_name: "",
    },
    data () {
      return {
        value: null,
        options: JSON.parse(this.default_options),
        placeholder: this.default_placeholder,
        name: this.default_name
      }
    },
    methods: {
      onSelect (option, id) {
        this.selected = option.value
      	console.log(this.selected, option)
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
