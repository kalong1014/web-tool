import { createApp } from 'vue';
import { createProvider, LocalService, createModules } from '@vtj/web';
import router from './router';
import App from './App.vue';
import './style/index.scss';

const app = createApp(App);
const service = new LocalService();

const { provider, onReady } = createProvider({
  nodeEnv: process.env.NODE_ENV,
  modules: createModules(),
  service,
  router,
  dependencies: {
    Vue: () => import('vue'),
    VueRouter: () => import('vue-router'),
    ElementPlus: () => import('element-plus')
  }
});

onReady(async () => {
  app.use(router);
  app.use(provider);
  app.mount('#app');
});
