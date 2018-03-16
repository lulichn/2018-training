
new Vue({
  el: '#app',
  data: {
    posts: []
  },
  methods: {
    request() {
      axios.get('/api/posts')
        .then(response => {
          this.posts = response.data;
        });
    }
  }
});
