<script>
import moment from 'moment';

export default {
    data() {
    return {
     posts:[],
     user:{},
      content: "",
      feedbackMessage: "",
      pseudo:"",
      created_at:""
    };
  },
  methods: {

    formatDate(date) {
      return moment(date).format('DD/MM/YYYY HH:mm');
    },

    async createPost() {
      const body = {
        content: this.content,
      };
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/post`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
        body: JSON.stringify(body),
      });

      const data = await response.json();
      
      if (response.status !== 200 || !data.url) {
        this.feedbackMessage = data.message;
        return;
      }

      window.location.assign(data.url);
      
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
    async createComment(post) {
    
      const body = {
        content: post.commentContent,
      };
      let tokens = localStorage.getItem("token");
      const response = await fetch(`http://127.0.0.1:8000/api/post/${post.id}/comment`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          Authorization: `Bearer ${tokens}`,
        },
        body: JSON.stringify({
          content: post.commentContent,
        }),
      })
      const data = await response.json();
      post.comments.push(data);
      post.commentContent = '';

    },

 
  mounted() {
    this.getPosts();
    // this.getComments()
    
  },
};
</script>

<template>
    <section class="flex items-center justify-center mb-10">
        <div class="block p-6 rounded-lg shadow-lg mt-10 bg-white max-w-sm w-2/4">
      <form @submit.prevent="createPost">
        <div class="form-group mb-6">
          <h2 class="text-sky-900 text-l font-semibold mb-1">Créer un post</h2>
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
        <p class="text-sky-900 text-l font-semibold">{{ formatDate(post.created_at) }}</p>

      <form @submit.prevent="createComment">
      <div>
        <textarea id="comment-content" class="form-control block mt-10 h-10 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"  v-model="post.commentContent"></textarea>
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
</template>
