<template>
  <div>
    <b-navbar toggleable="lg" type="dark">
      <b-navbar-brand href="/">GoodFood BackOffice</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :to="'/'">Accueil</b-nav-item>
          <b-nav-item :to="'/resto'">Resto</b-nav-item>
          <b-nav-item :to="'/offres'">Offres</b-nav-item>
          <b-nav-item :to="'/commercial'">Commercial</b-nav-item>
          <b-nav-item :to="'/utilisateurs'">Utilisateurs</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div class="d-flex align-items-center justify-content-center">
            <p class="m-0 pr-2" v-if="isUserLoggedIn">
              Bonjour, {{ user.firstname }} {{ user.lastname }}
            </p>
            <b-button v-on:click="logOut">Deconnexion</b-button>
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
    logOut() {
      this.$auth.logout()
    },
  },
}
</script>
