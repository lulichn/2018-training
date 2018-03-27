const Upload = {
  components: {
    Modal,
  },
  template: `
    <div>
      <form enctype="multipart/form-data" novalidate>
        <h1>Upload video</h1>
        <div class="dropbox" v-if="!target">
          <input type="file" @change="onSelect" accept="video/*" class="input-file">
              Drag your file here to begin or click to browse
        </div>
        <div v-else>
            <label>Preview:
            <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                autoplay
                data-setup='{}'>
              <source v-bind:src="previewSrc" type="video/mp4"></source>
            </video>
            </label>
            <label>Title: <input v-model="title" type="text" name="title">
            </label>
          <a class="button" @click="onSubmit">Submit</a>
        </div>
      </form>
      <modal v-show="modalValue.isVisible" v-bind:modalValue="modalValue" @close="closeModal"/>
    </div>
  `,
  data() {
    return {
      modalValue: {
        isVisible: false,
        message: '',
        button: {
          message: 'Return to home'
        }
      },
      target: null,
      previewSrc: null,
      title: ''
    }
  },
  methods: {
    closeModal() {
      this.modalValue.message = '';
      this.modalValue.isVisible = false;

      router.push({ path: '/' })
    },
    onSelect(event) {
      let files = event.target.files;
      if (!files) {
        this.target = null;
        return;
      }
      this.target = files[0];
      this.previewSrc = window.URL.createObjectURL(this.target);
    },
    onSubmit(event) {
      const params = new FormData();
      params.append('title', this.title);
      params.append('file', this.target);

      const config = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios.post('/api/upload', params, config)
        .then(response => {
          response;
          this.modalValue.message = 'Upload completed!';
          this.modalValue.isVisible = true;
        })
        .catch(error => {
          error;
          this.modalValue.message = 'Upload failed...';
          this.modalValue.isVisible = true;
        });
    }
  },
  mounted() {
  }
}

