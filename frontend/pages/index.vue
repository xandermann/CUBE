<template>
  <div class="container">
    <div>
      <h1>AUTHENTIFICATION: voir dans la console :)</h1>
      <button @click="fetch_token">Fetch token</button>
      <button @click="login">Login</button>
      <button @click="fetch_user">Fetch user</button>
      <button @click="logout">Logout</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  methods: {
    fetch_token() {
      axios
        .get('http://localhost/sanctum/csrf-cookie', {
          withCredentials: true,
        })
        .then(console.log)
        .catch(console.error)
    },
    login() {
      axios
        .post(
          'http://localhost/login',
          {
            email: 'a@a.a',
            password: 'a',
          },
          {
            withCredentials: true,
          }
        )
        .then(console.log)
        .catch(console.error)
    },
    fetch_user() {
      axios
        .get('http://localhost/api/user', {
          withCredentials: true,
        })
        .then(console.log)
        .catch(console.error)
    },
    logout() {
      axios
        .post(
          'http://localhost/logout',
          {},
          {
            withCredentials: true,
          }
        )
        .then(console.log)
        .catch(console.error)
    },
  },
}
</script>

<style></style>
