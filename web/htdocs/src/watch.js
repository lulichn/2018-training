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
        <source v-if="this.src" v-bind:src="this.src" v-bind:type="this.type"></source>
      </video>
      <div>
        <h1>{{ this.title }}</h1>
      </div>
    </div>
  `,
  data() {
    return {
      title: '',
      src: '',
      type: '',
      created_at: ''
    }
  },
  methods: {
    get_info() {
      const config = {
        params: { id: this.$route.query.v }
      }
      axios.get('/api/video', config)
        .then(response => {
          this.title      = response.data.title;
          this.src        = 'assets/' + response.data.asset + '/' + response.data.filename;
          this.type       = response.type;
          this.created_at = response.data.created_at;
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

