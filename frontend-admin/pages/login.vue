<template>
  <div>
    <b-container class="authWindow">
      <b-row>
        <b-col class="authForm">
          <h2>Connexion</h2>
          <b-form @submit="onSubmit">
            <b-form-group class="m-0">
              <b-form-input
                v-model="form.email"
                type="email"
                placeholder="E-mail"
              ></b-form-input>
              <b-form-input
                v-model="form.password"
                type="password"
                placeholder="******"
              ></b-form-input>
              <b-button type="submit" variant="primary w-100"
                >Me connecter</b-button
              >
            </b-form-group>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
export default {
  layout: 'authPage',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  methods: {
    onSubmit() {
      this.$auth.loginWith('laravelSanctum', {
        data: {
          email: this.form.email,
          password: this.form.password,
        }.then(() => this.$toast.success('Logged In!')),
      })
    },
  },
}
</script>
<style scoped>
.authWindow {
  padding: 55px;
  background-color: lightgrey;
  border-radius: 5px;
}
.authForm {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
input {
  margin: 10px 0;
}
</style>
