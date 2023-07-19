import { createApp } from 'vue'
import App from './App.vue'

/* Bootstrap.js */
import('bootstrap')

/* Styles */
import('../css/app.css')

const app = createApp(App)

app.mount('#app')
