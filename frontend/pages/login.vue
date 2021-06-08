<template>
  <div>
    <b-alert v-model="showError" variant="danger" dismissible>
      L'addresse email où le mot de passe ne correspondent pas
    </b-alert>

    <b-form @submit="onSubmit">
      <b-form-group id="input-group-1" label="Email" label-for="input-1">
        <b-form-input
          v-model="form.email"
          type="email"
          placeholder="Email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Mot de passe">
        <b-form-input
          v-model="form.password"
          type="password"
          placeholder="Mot de passe"
          required
        ></b-form-input>
      </b-form-group>

      <!-- <a class="color: blue mb-2" href="#" @click.prevent="resetPassword"
        >Mot de passe oublié</a
      > -->

      <div class="mt-3"></div>

      <b-button @click="onSubmit">Se connecter</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  layout: 'default',
  auth: 'auth',

  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      showError: false,
    }
  },

  methods: {
    onSubmit() {
      this.$auth
        .loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
        })
        .catch(() => (this.showError = true))
    },

    resetPassword() {
      this.$axios.get(`${process.env.API_URL}/sanctum/csrf-cookie`).then(() => {
        return this.$axios.post(
          `${process.env.API_URL}/forgot-password`,
          {
            email: this.form.email,
          },
          { withCredentials: true }
        )
      })
    },
  },
}
</script>
