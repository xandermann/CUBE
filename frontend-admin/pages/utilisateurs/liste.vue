<template>
  <List :elems="users" :modal="modaleUser" />
</template>
<script>
import { AjoutUser } from '../../assets/models/modales/utilisateurs/AjoutUser'
export default {
  data() {
    return {
      users: [],
      modaleUser: new AjoutUser(),
    }
  },
  async fetch() {
    this.users = await fetch(process.env.API_URL + '/api/users').then((res) =>
      res.json()
    )
  },
}
</script>
