import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import base_search from '@/components/ui/Base-Search.vue'
import base_form from '@/components/ui/base-form.vue'

Vue.config.productionTip = false
Vue.component('Base-search', base_search)
Vue.component('Base-form', base_form)


new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')