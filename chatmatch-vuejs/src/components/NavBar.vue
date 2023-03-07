<template>
  <nav>
    <!--desktop menu-->
    <div class="bg-orange-400">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
          <!-- menu -->
          <div class="flex space-x-4">
            <!-- logo -->
            <a href="/" class="flex items-center space-x-2 py-5 px-2">
              <img
                src="@/assets/img/ChatMatchLogo.png"
                class="w-20 h-18 ml-5"
                alt=""
              />
            </a>
            <!-- menu -->
            <ul class="hidden md:flex items-center space-x-1">
              <li v-if="isLoggedIn()" class="py-5 px-2">
                <RouterLink
                  to="/news"
                  class="text-xl text-white hover:text-orange-300"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-8 h-8"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525"
                    />
                  </svg>
                </RouterLink>
              </li>
            </ul>
          </div>
          <!-- login -->
          <ul class="hidden md:flex items-center space-x-1">
            <form  class="pt-2 relative mx-auto text-gray-600">
              <input
                class="border-2 border-orange-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                type="search"
                name="search"
                v-model="searchTerm"
                placeholder="Rechercher"
              />
              <ul>
                <li>
                  <!-- <a :href="'/users/' + user.id">@{{ user.pseudo }}</a> -->
                </li>
              </ul>
              <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                <svg
                  class="text-gray-600 h-4 w-4 fill-current"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  version="1.1"
                  id="Capa_1"
                  x="0px"
                  y="0px"
                  viewBox="0 0 56.966 56.966"
                  style="enable-background: new 0 0 56.966 56.966"
                  xml:space="preserve"
                  width="512px"
                  height="512px"
                >
                  <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"
                  />
                </svg>
              </button>
            </form>
            <li v-if="isLoggedIn()" class="py-5 px-2">
              <RouterLink
                to="/profil"
                class="text-white text-xl hover:text-orange-300"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-8 h-8"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                  />
                </svg>
              </RouterLink>
            </li>
            <li v-if="isLoggedIn()" class="py-5 px-2">
              <RouterLink
                to="/"
                class="text-white text-xl hover:text-orange-300"
                @click="logoutUser"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-8 h-8"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                  />
                </svg>
              </RouterLink>
            </li>
            <li v-if="!isLoggedIn()" class="py-5 px-2">
              <RouterLink
                to="/login"
                class="text-white text-xl hover:text-orange-300"
                >Se connecter</RouterLink
              >
            </li>
            <li v-if="!isLoggedIn()" class="py-5 px-2">
              <RouterLink
                to="/register"
                class="text-white text-xl hover:text-orange-300"
                >Créer un compte</RouterLink
              >
            </li>
          </ul>
          <!--Mobile menu-->
          <ul class="md:hidden flex items-center bg-orange-400">
            <li v-if="isLoggedIn()" class="py-5 px-2">
              <form  class="pt-2 mx-auto text-gray-600">
                <input
                  class="border-2 border-orange-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                  type="search"
                  name="search"
                  v-model="searchTerm"
                  placeholder="Rechercher"
                />
                <ul>
                  <li>
                    <!-- <a :href="'/users/' + user.id">@{{ user.pseudo }}</a> -->
                  </li>
                </ul>
                <button type="submit" class="right-0 top-0 ml-2 mt-5">
                  <svg
                    class="text-white h-5 w-5 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    version="1.1"
                    id="Capa_1"
                    x="0px"
                    y="0px"
                    viewBox="0 0 56.966 56.966"
                    style="enable-background: new 0 0 56.966 56.966"
                    xml:space="preserve"
                    width="512px"
                    height="512px"
                  >
                    <path
                      d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"
                    />
                  </svg>
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from "vue";
const showMobileMenu = ref(true);
</script>

<script>
export default {
  name: "Navbar",
  inject: ["isLoggedIn", "getUser", "logoutUser"],

  data() {
    return {
      searchTerm: "",
      users: [],
    };
  },

  methods: {
  
  },
};
</script>
