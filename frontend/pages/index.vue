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
    async fetch_token() {
      const res = await axios
        .get('http://localhost/sanctum/csrf-cookie', {
          withCredentials: true,
        })
        .catch(console.error)

      console.log(res)
    },
    async login() {
      const res = await axios
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
        .catch(console.error)

      console.log(res)
    },
    async fetch_user() {
      const res = await axios
        .get('http://localhost/api/user', {
          withCredentials: true,
        })
        .catch(console.error)

      console.log(res.data)
    },
    async logout() {
      const res = await axios
        .post(
          'http://localhost/logout',
          {},
          {
            withCredentials: true,
          }
        )
        .catch(console.error)

      console.log(res)
    },
  },
}
</script>

<style></style>
