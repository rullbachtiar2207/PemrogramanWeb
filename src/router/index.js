//import vue router 
import { createRouter, createWebHistory } from 'vue-router' 
 
//define a routes 
const routes = [ 
    { 
        path: '/', 
        name: 'home', 
        component: () => import( /* webpackChunkName: "home" */ 
'../views/home.vue') 
    }, 
    { 
        path: '/layanan', 
        name: 'layanan.index', 
        component: () => import( /* webpackChunkName: "index" */ 
'../views/layanan/index.vue') 
    }, 
    { 
        path: '/create', 
        name: 'layanan.create', 
        component: () => import( /* webpackChunkName: "create" */ 
'../views/layanan/create.vue') 
    }, 
    { 
        path: '/edit/:id', 
        name: 'layanan.edit', 
        component: () => import( /* webpackChunkName: "edit" */ 
'../views/layanan/edit.vue') 
}, 
 // Adding routes for Portofolio
 { 
    path: '/portofolios', 
    name: 'portofolios.index', 
    component: () => import( /* webpackChunkName: "portofolio-index" */ 
    '../views/portofolio/index.vue') 
},
{ 
    path: '/portofolios/create', 
    name: 'portofolios.create', 
    component: () => import( /* webpackChunkName: "portofolio-create" */ 
    '../views/portofolio/create.vue') 
},
{ 
    path: '/portofolios/edit/:id', 
    name: 'portofolios.edit', 
    component: () => import( /* webpackChunkName: "portofolio-edit" */ 
    '../views/portofolio/edit.vue') 
}

] 
//create router 
const router = createRouter({ 
history: createWebHistory(), 
routes // <-- routes, 
}) 
export default router 