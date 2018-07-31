/**
 * Created by yuswa on 6/12/17.
 */

import Vue from 'vue';
import router from './router/display'
import MainContainer from './MainContainer.vue'


const app = new Vue({
    el: '#ds-display-view',
    template: `<main-container></main-container>`,
    components: {MainContainer},
    router
})