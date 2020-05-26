/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.events = new Vue();

//import Multiselect from 'vue-multiselect';

window.noty = function(notification) {
	window.events.$emit('notification', notification)
}

window.handleErrors = function(error) {
	if(error.response.status == 422) {
 		window.noty({
			message: 'Vous avez des erreurs de validation. Veuillez réessayer.',
			type: 'danger'
		})
 	}

 	window.noty({
		message: 'Quelque chose a mal tourné. Veuillez rafraîchir la page.',
		type: 'danger'
	})
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('multiselect', Multiselect);

Vue.component('vue-noty', require('./components/Noty.vue').default);
Vue.component('vue-login', require('./components/Login.vue').default);
Vue.component('vue-select', require('./components/Select.vue').default);
Vue.component('vue-select2', require('./components/Select2.vue').default);
Vue.component('vue-chapitres', require('./components/Chapitres.vue').default);
Vue.component('vue-sessions', require('./components/Sessions.vue').default);
Vue.component('vue-player', require('./components/Player.vue').default);

//import VueChapitre from './components/Chapitre.vue'
//components: { VueLogin }

const app = new Vue({
    el: '#app',
});
