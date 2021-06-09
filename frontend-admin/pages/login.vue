<template>
  <div>
    <b-container class="authWindow">
      <b-row>
        <b-col class="authForm">
          <b-progress
            v-if="status == 'pending'"
            variant="info"
            :animated="true"
            class="mt-3"
            ><b-progress-bar :value="100"
              ><span>Connexion en cours</span></b-progress-bar
            ></b-progress
          >
          <b-progress
            v-if="status == 'success'"
            variant="success"
            :animated="false"
            class="mt-3"
            ><b-progress-bar :value="100"
              ><span
                >Connexion réussie, vous allez être redirigé</span
              ></b-progress-bar
            ></b-progress
          >
          <b-progress
            v-if="status == 'error'"
            :value="100"
            variant="danger"
            :animated="false"
            class="mt-3"
            ><b-progress-bar :value="100"
              ><span
                >Echec de connexion : login ou mot de passe incorrect</span
              ></b-progress-bar
            ></b-progress
          >
          <h2>Connexion</h2>
          <b-form @submit.prevent="onSubmit">
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
      status: String,
      form: {
        email: '',
        password: '',
      },
      error: null,
    }
  },
  methods: {
    async onSubmit() {
      this.status = 'pending'
      await this.$auth
        .loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
        })
        .then(() => {
          this.status = 'success'
          this.$router.push('/')
        })
        .catch((err) => {
          this.status = 'error'
          this.error = err
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
