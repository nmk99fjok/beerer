import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'

Vue.component('star-rating', VueStarRating.default);

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
  },
  data: {
      rating: 0,
  },
  methods: {
      setRating: function(rating) {
          this.rating = rating;
      }
  }
});

new WOW().init();
