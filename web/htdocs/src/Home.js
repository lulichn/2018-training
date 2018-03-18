const Home = {
  template: `
    <div>
      <table class="hover">
        <thead>
          <tr>
            <th></th>
            <th>タイトル</th>
            <th>作成日時</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post) in posts" @click="select(post.id)">
            <td><img v-bind:src="'assets/thumbnail/' +  post.thumbnail" width="225" height="127"></td>
            <td>{{post.title}}</td>
            <td>{{post.created_at}}</td>
          </tr>
        </tbody>
      </table>
      <a class="button" v-on:click="refresh">Refresh</a>
    </div>
  `,
  data() {
    return {
      posts: []
    }
  },
  methods: {
    refresh() {
      axios.get('/api/posts')
        .then(response => {
          this.posts = response.data;
        });
    },
    select(post_id) {
      router.push({ path: 'watch', query: { v: post_id  }})
    }
  },
  mounted() {
    this.refresh();
  }
}

