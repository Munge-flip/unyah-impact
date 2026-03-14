import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import ServiceCard from './components/ServiceCard.vue';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('service-card', ServiceCard);
app.component('app-header', AppHeader);
app.component('app-footer', AppFooter);

app.mount('#app');
