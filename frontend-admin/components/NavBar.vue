<template>
  <div>
    <b-navbar toggleable="lg" type="dark">
      <b-navbar-brand :to="'/'">Administration GoodFood</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse
        id="nav-collapse"
        class="NavBar p-2"
        is-nav
        style="z-index: 100"
      >
        <b-navbar-nav>
          <b-nav-item :to="'/'">Accueil</b-nav-item>
          <b-nav-item :to="'/resto'">Resto</b-nav-item>
          <b-nav-item :to="'/offres'">Offres</b-nav-item>
          <b-nav-item :to="'/commercial'">Commercial</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div class="d-flex align-items-center justify-content-center">
            <p v-if="isUserLoggedIn" class="m-0 pr-2">
              Bonjour, {{ user.firstname }} {{ user.lastname }}
            </p>
            <b-button @click="logOut">Déconnexion</b-button>
          </div>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isUserLoggedIn: this.$auth.loggedIn,
      user: this.$auth.user,
    }
  },
  methods: {
    async logOut() {
      await this.$auth.logout().then(() => this.$router.push('/'))
    },
  },
}
</script>
