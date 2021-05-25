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
  },
}
</script>
