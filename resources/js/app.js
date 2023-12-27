import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
// import { MotionPlugin } from '@vueuse/motion'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

library.add(fab, fas, far)

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Corem';

createInertiaApp({
	title: (title) => ` ${title} &#183; ${appName}`,
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
	setup({ el, App, props, plugin }) {
		return createApp({ render: () => h(App, props) })
			.use(Toast)
			.use(plugin)
			.use(ZiggyVue, Ziggy)
			.mount(el);
	},
	progress: {
		color: '#00449f',
	},
});
