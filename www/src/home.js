const Home = {
  template: `
    <div>
      <table class="hover">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>View count</th>
            <th>Uploaded at</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post) in posts" @click="select(post.id)">
            <td><img v-bind:src="'assets' +  post.asset_path + '/' + post.thumbnail" width="225" height="127"></td>
            <td>{{post.title}}</td>
            <td>{{post.view_count}}</td>
            <td>{{post.uploaded_at}}</td>
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
    select(id) {
      router.push({ path: '/watch', query: { v: id  }})
    }
  },
  mounted() {
    this.refresh();
  }
}

