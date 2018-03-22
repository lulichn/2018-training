const Watch = {
  template: `
    <div class="video">
      <video
          id="watch-video"
          class="video-js vjs-default-skin vjs-16-9"
          controls
          preload="auto"
          autoplay
          data-setup='{}'>
        <source v-if="this.src" v-bind:src="this.src" v-bind:type="this.post.video_type"></source>
      </video>
      <div>
        <h1>{{ this.post.title }}</h1>
      </div>
    </div>
  `,
  data() {
    return {
      post: {},
      src: ''
    }
  },
  methods: {
    get_info() {
      const config = {
        params: { id: this.$route.query.v }
      }
      axios.get('/api/video', config)
        .then(response => {
          this.post = response.data;
          this.src        = 'assets/' + response.data.asset_path + '/' + response.data.filename;
        });
    }
  },
  created() {
    this.get_info();
  },
  mounted() {
    const a = document.getElementById('watch-video');
    a.addEventListener('loadedmetadata', function() { 
      const w = a.videoWidth;
    });
  }
}

