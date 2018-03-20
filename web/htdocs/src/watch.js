const Watch = {
  template: `
    <div>
      <video
          id="watch-video"
          class="video-js"
          controls
          preload="auto"
          autoplay
          data-setup='{}'>
        <source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4"></source>
      </video>
    </div>
  `,
  methods: {
  },
  mounted() {
  }
}

