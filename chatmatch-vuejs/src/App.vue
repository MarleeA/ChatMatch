<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue';
import loginUser from "./views/LoginView.vue";
import Footer from './components/Footer.vue';
</script>

<template >

  <header>
    <NavBar/>
  </header>

  <body style="background-color:#feeddd;">
    <RouterView />
    <Footer/>
  </body>

</template>

<script>
export default {
  name: "App",
  components: {
    NavBar,
    loginUser,
    RouterView,
  },

  data() {
    return {
      isLoggedIn: false,
      user: null,
    };
  },

  methods: {
    async checkToken() {
      const token = localStorage.getItem("token");
      console.log('token',token);
      if (token) {
        const response = await fetch("http://127.0.0.1:8000/api/user",
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
                  
        })
        const user = await response.json();
        this.user = user;
        this.isLoggedIn = true;
      }
    },
    login(token, user) {
      localStorage.setItem("token", token);
      this.isLoggedIn = true;
      this.user = user;
    },
    logout() {
      localStorage.removeItem("token");
      this.isLoggedIn = false;
      this.user = null;
    },
  },
  provide() {
    return {
      isLoggedIn: () => this.isLoggedIn,
      getUser: () => this.user,
      loginUser: this.login,
      logoutUser:  this.logout,
    };
  },
  mounted() {
    this.checkToken();
  },
};
</script>