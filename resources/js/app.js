require('./bootstrap');

import Vue from 'vue';
import ExampleComponent from './ExampleComponent.vue';

new Vue({
  el: '#app',
  components: {
    ExampleComponent,
  },
});