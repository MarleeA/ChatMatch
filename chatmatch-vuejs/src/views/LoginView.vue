<script>
import { routerKey } from 'vue-router';

export default {
  inject: ["loginUser"],

  data() {
    return {
      email: "",
      password: "",
      feedbackMessage:"",
    };
  },

  methods: {
    async login() {
      // Requête
      const token = localStorage.getItem("token");
      const body = {
        email: this.email,
        password: this.password,
      };
      const response = await fetch("http://127.0.0.1:8000/api/login",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
          },

          body: JSON.stringify(body)
                  
        })

        const data = await response.json();


        this.feedbackMessage = data.message;

        if(response.status === 201){
          this.feedbackMessage = data.message;
          console.log('data value', data);
          this.loginUser(data.access_token,data.user);
          return  this.$router.push('/');
        }else if(response.status === 500){
          this.feedbackMessage = "Mot de passe ou identifiant incorrect";
        } else if (response.status === 422){
          this.feedbackMessage = "Un champ est manquant";

        }
    },
  },
};
</script>

<template>

    <section class="flex items-center justify-center" >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm w-2/4 my-8">
  <form @submit.prevent="loginUser">
    <div class=" text-center rounded-xl">
      <h1 class="mb-5 text-lg text-orange-400 font-bold">Nous sommes heureux <br> de vous revoir</h1>
    </div>
    <div class="form-group mb-6">
      <input type="email" name="email" v-model="email" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInputEmail2"
        aria-describedby="emailHelp" placeholder="Entrez votre email">
    </div>
    <div class="form-group mb-6">
      <input v-model="password" name="password" type="password" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none" id="exampleInputPassword2"
        placeholder="Entrez votre mot de passe">
    </div>
    <div class="flex justify-between items-center mb-6">
      <div class="form-group form-check">
        <input type="checkbox"
          class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-orange-500 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
          id="exampleCheck2">
        <label class="form-check-label inline-block text-gray-800" for="exampleCheck2">Se souvenir de moi</label>
      </div>
      <a href="/reset"
        class="text-orange-400 hover:text-orange-500 focus:text-orange-500 transition duration-200 ease-in-out">Mot de passe oublié ?</a>
    </div>
    <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-orange-400
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-orange-500 hover:shadow-lg
      focus:bg-orange-500 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-orange-500 active:shadow-lg
      transition
      duration-150
      ease-in-out" @click.prevent="login">Se connecter</button>
      <p class="text-red-400 mt-2 text-m font-semibold">
      {{feedbackMessage}}
    </p>
    <p class="text-gray-800 mt-6 text-center">Vous n'avez pas de compte? <a href="/register"
        class="text-orange-400 hover:text-orange-500 focus:text-orange-500 transition duration-200 ease-in-out">S'inscrire</a>
    </p>
  </form>
</div>
    </section>
</template>
