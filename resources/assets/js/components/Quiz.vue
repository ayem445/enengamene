<template>

  <table class="table table-cart">
    <tbody valign="left">
      <tr>
        <td>
          <a class="item-remove" href="#" @click.prevent="deleteQuizElem(elem.id, elem.quiz)" v-if="elem.quiz_id"><i class="ti-close"></i></a>
          <a class="item-remove" :href="'/admin/' + quiztype + '/' + elem.id + '/create'" v-else><i class="ti-plus"></i></a>
        </td>

        <td>
          <a :href="'/admin/quizs/' + elem.quiz_id " v-if="elem.quiz_id">
              <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </a>
          <a v-else>
              <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </a>
        </td>

        <td>
          <label class="text-success" v-if="elem.quiz_id && elem.quiz.is_complet">complet</label>
          <label class="text-danger" v-else-if="elem.quiz_id">incomplet</label>
          <label class="text-default" v-else>aucun quiz</label>
        </td>

        <td v-if="elem.quiz_id">
          <small><span class="badge badge-default">{{ elem.quiz.nbquestions }}</span></small>
        </td>
      </tr>
    </tbody>
  </table>

</template>

<script>

    import EventBus from './eventBus';
    import Axios from 'axios'

    export default {
        props: {
          default_elem: {},
          default_quiztype: ""
        },
        data() {
            return {
                elem: this.default_elem,
                quiztype: this.default_quiztype
            }
        },
        methods: {
          deleteQuizElem(elemId, quiz) {
    				if(confirm('Voulez-vous vraiment supprimer ?')) {
    					Axios.post(`/admin/${this.quiztype}/${elemId}/destroy`, quiz)
                  .then(resp => {
                      window.noty({
                          message: 'Quiz supprimé avec succès',
                          type: 'success'
                      })
                      let elem = resp.data
                      this.updateElemAttributes(elem)
    						 }).catch(error => {
    						 	 window.handleErrors(error)
    						 })
    				}
    			},
          updateElemAttributes(elem) {
            this.elem.quiz_id = elem.quiz_id
            this.elem.quiz = elem.quiz
          }
      }

    }
</script>
