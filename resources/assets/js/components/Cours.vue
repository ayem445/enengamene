<template>



  <div class="container">

    <div class="row">
      <input type="text" v-model="q" value="">
      <button class="btn btn-primary" @click="getResults(1)">
        Search
      </button>
    </div>

    <div class="row gap-y">

      <div class="col-12 col-md-6 col-lg-4" v-for="tag in laravelData.data" :key="tag.id">
        <div class="card card-hover-shadow">
          <a :href="'/cours/' + tag.id "><img class="card-img-top" :src="tag.image_path"  alt="Card image cap"></a>
          <div class="card-block">
            <h4 class="card-title">{{ tag.libelle }}</h4>
            <p class="card-text">{{ tag.description }}</p>
            <a class="fw-600 fs-12" :href="'/cours/' + tag.id " >En savoir plus <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
          </div>
        </div>
      </div>

    </div>


    <nav class="flexbox mt-30">
      <vue-pagination :data="laravelData" @pagination-change-page="getResults"></vue-pagination>
    </nav>


  </div>



</template>

<script>

    import Axios from 'axios'

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                laravelData: {},
                q: null
            }
        },
        created() {
            this.getResults();
        },
        methods: {
            getResults(page) {
                console.log("new search launched !")
                if (typeof page === 'undefined') {
                    page = 1;
                }

                Axios.get(`/coursgetall?page=${page}`, this.q)
                    .then(resp => {
                          this.laravelData = resp.data
                    }).catch(error => {
                          window.handleErrors(error)
                })

            }
        }
    }
</script>
