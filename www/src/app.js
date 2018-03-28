const App = {
  template: `
    <div class='main'>
      <nav>
        <div class='header'>
          <div class='navigation-left'>
            <a class="hollow button" v-on:click="home">Home</a>
          </div>
          <div class='navigation-right'>
            <a class="hollow button" v-on:click="upload">Upload</a>
          </div>
        </div>
      </nav>
      <div class="body">
        <router-view></router-view>
      </div>
    </div>
  `,
  methods: {
    home() {
      router.push({ path: '/' })
    },
    upload() {
      router.push({ path: 'upload' })
    }
  }
}

