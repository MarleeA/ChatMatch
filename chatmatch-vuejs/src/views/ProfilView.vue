<script setup>
import moment from 'moment';
import { ref } from "vue";
const showUpdateProfile = ref(true);
</script>

<script>
export default {
  data() {
    return {
      posts:[],
      profil: [],
      lastname: "",
      firstname: "",
      pseudo: "",
      email: "",
      password: "",
      feedbackMessage: "",
    };
  },

  methods: {

    formatDate(date) {
      return moment(date).format('DD/MM/YYYY HH:mm');
    },
    
    async getProfil() {
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/profil`, {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });

      const data = await response.json();

      this.profil = data.profil;
    },

    async updateProfil() {
      const body = {
        lastname: this.lastname,
        firstname: this.firstname,
        pseudo: this.pseudo,
        email: this.email,
        password: this.password,
      };
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/profil`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
        body: JSON.stringify(body),
      });

      const data = await response.json();

      this.feedbackMessage = data.message;
      this.getProfil();
    },

    async getPosts() {
      let tokens = localStorage.getItem("token");
      const response = await fetch("http://127.0.0.1:8000/api/post", {
        method: "GET",
        headers: {
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
      });

      const data = await response.json();
      this.posts = data.posts;
    },


  },
  mounted() {
    this.getProfil();
    this.getPosts();
  },
};
</script>

<template>
  <section class="flex items-center justify-center mb-10">
    <div class="flex flex-col p-6 rounded-lg mt-5 shadow-lg bg-white max-w-sm w-2/4">
      <div class="flex flex-col justify-center mb-5 ">
        <img src="@/assets/img/ChatMatchAvatar.png" class="w-18 h-16 self-center" alt="">

        <p class="text-sky-900 text-2xl font-semibold  self-center">
          Meow ?? toi, 
        </p>
        <p class="text-sky-900 text-2xl font-semibold italic self-center">
        {{ profil.pseudo }}
        </p>
      </div>

      <div>
        <h3 class="text-sky-900 text-l font-semibold mb-1">Mes infos</h3>
        <p class="text-sky-900 text-m">
          {{ profil.lastname }} {{ profil.firstname }}
        </p>
        <p class="text-sky-900 text-m">{{ profil.email }}</p>
      </div>
      <button
        type="submit"
        @click="showUpdateProfile = !showUpdateProfile"
        class="w-full mt-4 px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-ORANGE-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out"
      >Modifier mon profil</button>
      <button
        type="submit"
        @click="$router.push('/post')"
        class="w-full mt-4 px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-ORANGE-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out"
      >Cr??er un post</button>
    </div>
  </section>

  <section
    class="flex items-center justify-center mb-10"
    :class="{ hidden: showUpdateProfile }"
  >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <form @submit.prevent="updateProfil">
        <div class="form-group mb-6">
          <h2 class="text-sky-900 text-l font-semibold mb-1">Modifier le profil</h2>
          <input
            v-model="lastname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            placeholder="Nouveau Nom"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="firstname"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            placeholder="Nouveau Pr??nom"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="pseudo"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            placeholder="Nouveau Pseudo"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="email"
            type="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            id="exampleInputPassword2"
            aria-describedby="emailHelp"
            placeholder="Nouvel email"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="password"
            type="password"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            id="exampleInputEmail2"
            placeholder="Nouveau mot de passe"
          />
        </div>
        <p class="text-center text-red-600">{{feedbackMessage}}</p>
        <button
          type="submit"
          class="w-full px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-orange-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out"
        >
          Valider
        </button>
      </form>
    </div>
  </section>

  <section class="flex items-center justify-center mb-10 mt-10">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
      <h2 class="text-sky-900 text-xl mb-4 text-center font-semibold">
        Mes posts
      </h2>
      <div
        class="block mb-2 p-6 rounded-lg shadow-lg bg-white max-w-md"
        v-for="post in posts" :key="post.id"
      >
        <p class="text-sky-900 text-l font-semibold">{{ }}</p>
        <p class="text-sky-900 text-l font-semibold">{{ post.content }}</p>
        <div class="flex justify-end">
          <p class="text-sky-900 text-xs mt-3 font-semibold">{{ formatDate(post.created_at) }}</p>
        </div>

      <form @submit.prevent="createComment(post_id)">
      <div>
        <textarea id="comment-content" placeholder="Laissez un commentaire" class="form-control block mt-10 h-10 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"  v-model="post.commentContent"></textarea>
        <button type="submit" class="w-full px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-orange-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out">Commenter</button>
      </div>
    </form>
    <ul>
      <h2 class=" mt-2 text-sky-900 text-l font-semibold">Commentaires</h2>
    <li v-for="comment in post.comments" :key="comment.id">
      <p>{{ comment.content }}</p>
    </li>
  </ul>
      </div>

    </div>
  </section>
  <!-- <section
    class="flex items-center justify-center mb-10"
    :class="{ hidden: showCreatePost }"
  >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4">
      <form @submit.prevent="createPost">
        <div class="form-group mb-6">
          <h2 class="text-sky-900 text-l font-semibold mb-1">Cr??er un post</h2>
          <textarea name="content" class="form-control block h-28 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            v-model="content" id="" placeholder="Racontez-nous quelque chose" cols="30" rows="10"></textarea>
         
        </div>
        <p class="text-center text-red-600">{{feedbackMessage}}</p>
        <button
          type="submit"
          class="w-full px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-orange-400 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out"
        >
          Poster
        </button>
      </form>
    </div>
  </section> -->
</template>