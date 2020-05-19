<template>
  <div>
    <multiselect
      id="m_select"
      v-model="selected"
      value=""
      :options="options"
      :searchable="true"
      :multiple="true"
      label="label"
      track-by="value"
      key="value"
      :placeholder="placeholder"
      @select="onSelected" @remove="onRemove" >
    </multiselect>
    <input type="text" :name="name" :value="selectedVals">
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect'

  export default {
    components: { Multiselect },
    props: {
      default_options: {},
      default_placeholder: "",
      default_name: ""
    },
    data () {
      return {
        selected: [],
        selectedVals: [],
        options: JSON.parse(this.default_options),
        placeholder: this.default_placeholder,
        name: this.default_name,

        optionsProxy: [],
        selectedResources: [],
      }
    },
    methods: {
      onSelected (selectedOption, id) {
        //console.log(selectedOption)
        this.selectedVals.push(selectedOption.value)
      },
      onRemove (removedOption, id) {
        let selIdx = this.selected.findIndex(s => {
          return removedOption.value == s.value
        })
        console.log(removedOption, selIdx)
        this.selectedVals.splice(selIdx, 1)
      }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
