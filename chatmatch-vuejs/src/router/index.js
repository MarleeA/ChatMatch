import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterView.vue"),
      props: true,
    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
    },
    {
      path: "/profil",
      name: "profil",
      component: () => import("../views/ProfilView.vue"),
    },
    {
      path: "/news",
      name: "news",
      component: () => import("../views/NewsView.vue"),
    },
    {
      path: "/post",
      name: "post",
      component: () => import("../views/PostView.vue"),
    }
  ]
})

export default router
