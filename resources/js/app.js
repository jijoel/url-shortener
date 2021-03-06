
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

import VeeValidate from 'vee-validate'
Vue.use(VeeValidate, {
    events: 'blur',
    dictionary: {
      en: {
        messages:{
          required: 'Please fill in this field',
          email: 'Please enter a valid email address',
        }
      },
    }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('short-url-component', require('./components/ShortUrlComponent.vue'))

const app = new Vue({
    el: '#app'
});
