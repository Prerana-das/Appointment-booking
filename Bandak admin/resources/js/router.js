
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
// admin project pages 
import home from './components/pages/home'
import category from './admin/pages/category'
import adminusers from './admin/pages/adminusers'
import login from './admin/pages/login'
import booking from './admin/pages/booking'
import booked_slot from './admin/pages/booked_slot'
import booking_details from './admin/pages/booking_details'


const routes = [
    //projects routes....

    {
        path: '/', 
        component: home, 
        name: 'home'
       
    },

    {
        path: '/category', 
        component: category, 
        name: 'category'
       
    },
    {
        path: '/adminusers', 
        component: adminusers, 
        name: 'adminusers'
       
    },
    {
        path: '/login', 
        component: login, 
        name: 'login'
    },
    {
        path: '/booking', 
        component: booking, 
        name: 'booking'
    },
    {
        path: '/booked_slot', 
        component: booked_slot, 
        name: 'booked_slot'
    },
    {
        path: '/booking_details', 
        component: booking_details, 
        name: 'booking_details'
    },
    

]



export default new Router({
    mode: 'history', 
    routes

})