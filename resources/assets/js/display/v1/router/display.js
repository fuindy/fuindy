/**
 * Created by yuswa on 23/11/17.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

import studentIndex from '../views/pages/student/views/index.vue'
import dashboardIndex from '../views/pages/dashboard/views/index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {path:'/',component:dashboardIndex},
        {path:'/student/',component:studentIndex},
    ]
})

export default router
