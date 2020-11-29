import Vue from 'vue'
import App from './App.vue'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import store from './store/index'
/*custom common methods*/
import common from './common';
Vue.mixin(common);
//import axios from 'axios'
window.axios = require('axios');

import iView from 'iview';
import 'iview/dist/styles/iview.css';
import locale from 'iview/dist/locale/en-US';
Vue.use(iView, { locale });


// plugins

// widget setup
// (optional) 'Custom elements polyfill'
import 'document-register-element/build/document-register-element'
// vue-custom-element by karol-f
import vueCustomElement from 'vue-custom-element'
Vue.use(vueCustomElement)


Vue.config.productionTip = false



// use vue-custom-element
App.store = store
// App.router = router
Vue.customElement('forehand-rank', App)