import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import base_search from '@/components/ui/Base-Search.vue'
import base_form from '@/components/ui/base-form.vue'
import base_warning from '@/components/ui/Warning.vue'

import base_dailog from '@/components/ui/dailog.vue'
Vue.config.productionTip = false
Vue.component('Base-search', base_search)
Vue.component('Base-form', base_form)
Vue.component('Base-warning', base_warning)
Vue.component('Base-dailog', base_dailog)


new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')