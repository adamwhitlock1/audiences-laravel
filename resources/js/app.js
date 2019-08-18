import { InertiaApp } from '@inertiajs/inertia-vue'
import PortalVue from 'portal-vue'
import Vue from 'vue'
import { ClientTable } from 'vue-tables-2';
import { library } from '@fortawesome/fontawesome-svg-core';

import { faSave } from '@fortawesome/free-solid-svg-icons/faSave';
import { faCheckCircle } from '@fortawesome/free-solid-svg-icons/faCheckCircle';
import { faCloudDownloadAlt } from '@fortawesome/free-solid-svg-icons/faCloudDownloadAlt';
import { faTrashAlt } from '@fortawesome/free-solid-svg-icons/faTrashAlt';
import { faBan } from '@fortawesome/free-solid-svg-icons/faBan';
import { faArrowAltCircleRight } from '@fortawesome/free-solid-svg-icons/faArrowAltCircleRight';
import { faUserFriends } from '@fortawesome/free-solid-svg-icons/faUserFriends';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(
    faSave,
    faCheckCircle,
    faCloudDownloadAlt,
    faTrashAlt,
    faBan,
    faArrowAltCircleRight,
    faUserFriends
);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(ClientTable);
Vue.use(InertiaApp)
Vue.use(PortalVue)

let app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
