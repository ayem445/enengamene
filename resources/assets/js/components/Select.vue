<template>
  <div>
    <multiselect
      id="m_select"
      v-model="selected"
      selected.sync="selected"
      value=""
      :options="options"
      :searchable="true"
      :multiple="false"
      label="libelle"
      track-by="id"
      key="id"
      :placeholder="placeholder"
      @select="onSelected" @remove="onRemove" >
    </multiselect>
    <input type="text" :id="name" ref="selectedVal" :name="name" :value="selectedVal">
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
      default_selected: {}
    },
    mounted() {

    },
    data () {
      return {
        selected: JSON.stringify(JSON.parse(this.default_selected)) == "[]" ? null : JSON.parse(this.default_selected),
        selectedVal: JSON.stringify(JSON.parse(this.default_selected)) == "[]" ? null : JSON.stringify(JSON.parse(this.default_selected)),
        options: JSON.parse(this.default_options),
        placeholder: this.default_placeholder,
        name: this.default_name,
      }
    },
    methods: {
      onSelected (selectedOption, id) {
        console.log(selectedOption)
        this.value = selectedOption
        this.selectedVal = JSON.stringify(selectedOption)
      },
      onRemove (removedOption, id) {
        console.log(removedOption)
        this.value = null
        this.selectedVal = null
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
