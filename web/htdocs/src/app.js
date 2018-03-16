
new Vue({
  el: '#app',
  data: {
    posts: [],
    count: 0
  },
  methods: {
    request() {
      axios.get('/api/posts')
        .then(response => {
          this.posts = response.data;
        });
    },

    select(post_id) {
      this.count += 1
    }
  }
});
