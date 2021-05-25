<template>
  <button @click="login">Connexion</button>
</template>

<script>
export default {
  methods: {
    login() {
      console.log(this)
      this.$auth.loginWith('laravelSanctum', {
        data: {
          email: 'a@a.a',
          password: 'a',
        },
      })
    },
  },
}
</script>
