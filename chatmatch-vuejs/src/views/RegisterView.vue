<script>
export default {
  data() {
    return {
      firstname: "",
      lastname: "",
      pseudo: "",
      email: "",
      password: "",
      feedbackMessage: "",
    };
  },
  props: {
    id: { type: String, required: true },
  },
  methods: {
    async createUser() {
      const body = {
        lastname: this.lastname,
        firstname: this.firstname,
        pseudo: this.pseudo,
        email: this.email,
        password: this.password,
      };
      const response = await fetch("http://127.0.0.1:8000/api/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
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
  },
};
</script>

<template>
  <section class="flex items-center justify-center">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md mt-10 mb-10">
      <form @submit.prevent="createUser">
        <h1 class="text-sky-900 text-xl mb-4 text-center font-semibold">
          Créer un compte
        </h1>
        <div class="grid grid-cols-2 gap-4">
          <div class="form-group mb-6">
            <input
              v-model="lastname"
              type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
              id="exampleInput123"
              aria-describedby="emailHelp123"
              name="nom"
              placeholder="Nom"
            />
          </div>
          <div class="form-group mb-6">
            <input
              v-model="firstname"
              type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
              id="exampleInput124"
              aria-describedby="emailHelp124"
              name="prenom"
              placeholder="Prénom"
            />
          </div>
        </div>
        <div class="form-group mb-6">
          <input
            type="pseudo"
            v-model="pseudo"
            name="pseudo"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            id="exampleInput125"
            placeholder="Pseudo"
          />
        </div>
        <div class="form-group mb-6">
          <input
            type="email"
            v-model="email"
            name="email"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            id="exampleInput125"
            placeholder="Adresse mail"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="password"
            name="password"
            type="password"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-orange-600 focus:outline-none"
            id="exampleInput126"
            placeholder="Mot de passe"
          />
        </div>
        <p class="text-red-500 mt-2 text-m font-semibold text-center mb-3">
          {{ feedbackMessage }}
        </p>
        <button
          type="submit"
          class="w-full px-6 py-2.5 bg-orange-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-teteal00 active:shadow-lg transition duration-150 ease-in-out"
        >
          Créer un compte
        </button>
      </form>
    </div>
  </section>
</template>
