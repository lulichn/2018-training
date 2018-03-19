const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: Home },
    { path: '/watch', component: Watch },
    { path: '/upload', component: Upload }
  ]
})

