/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'vue-awesome/icons'
import Icon from 'vue-awesome/components/Icon'
import Toasted from 'vue-toasted'
import Mixin from './mixins/mixin'

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(Toasted);
Vue.component('v-icon', Icon)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// common
Vue.component('modal', require('./components/common/ModalComponent.vue').default);

// menu
Vue.component('menu-component', require('./components/MenuComponent.vue').default);

// home
Vue.component('home-component', require('./components/home/HomeComponent.vue').default);

// member
Vue.component('member-component', require('./components/member/MemberComponent.vue').default);

// company
Vue.component('company-component', require('./components/company/CompanyComponent.vue').default);
Vue.component('company-tab-component', require('./components/company/CompanyTabComponent.vue').default);
Vue.component('organization-tab-component', require('./components/company/OrganizationTabComponent.vue').default);
Vue.component('division-tab-component', require('./components/company/DivisionTabComponent.vue').default);

// manage
Vue.component('period-component', require('./components/manage/PeriodComponent.vue').default);
Vue.component('group-component', require('./components/manage/GroupComponent.vue').default);
Vue.component('sheet-component', require('./components/manage/SheetComponent.vue').default);

// entity
Vue.component('entity-component', require('./components/entity/EntityComponent.vue').default);

Vue.mixin(Mixin)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
