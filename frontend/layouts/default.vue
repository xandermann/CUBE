<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <nuxt-link to="/">
        <b-navbar-brand>GoodFood</b-navbar-brand>
      </nuxt-link>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <client-only>
          <b-navbar-nav v-if="loggedIn">
            <b-nav-item to="/orders">Liste des commandes passées</b-nav-item>

            <!--
          <b-nav-item href="#" disabled>Disabled</b-nav-item>
        -->
          </b-navbar-nav>
        </client-only>

        <b-navbar-nav>
          <b-nav-item to="/about">A propos de nous</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <!--
          <b-nav-form>
            <b-form-input
              size="sm"
              class="mr-sm-2"
              placeholder="Search"
            ></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit"
              >Search</b-button
            >
          </b-nav-form>
          -->

          <b-nav-item-dropdown text="Langue" right>
            <b-dropdown-item href="#">Français</b-dropdown-item>
            <b-dropdown-item href="#">English</b-dropdown-item>
            <b-dropdown-item href="#">Deutsch</b-dropdown-item>
            <b-dropdown-item href="#">Lëtzebuergesch</b-dropdown-item>
            <b-dropdown-item href="#">Nederlands</b-dropdown-item>
          </b-nav-item-dropdown>

          <client-only>
            <template v-if="loggedIn">
              <b-nav-item-dropdown right>
                <template #button-content>
                  <em>{{ user.email }}</em>
                </template>
                <b-dropdown-item to="/account">Mon compte</b-dropdown-item>

                <b-dropdown-item @click="logout"
                  >Se déconnecter</b-dropdown-item
                >
              </b-nav-item-dropdown>
            </template>

            <template v-if="!loggedIn">
              <b-navbar-nav right>
                <b-nav-item to="/login">Connexion</b-nav-item>

                <b-nav-item to="/signup">Inscription</b-nav-item>
              </b-navbar-nav>
            </template>
          </client-only>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <b-container class="mt-4">
      <b-row class="text-center">
        <b-col md="8">
          <Nuxt />
        </b-col>
        <b-col>
          <p>À compléter</p>

          <b-button variant="success"
            >Télécharger l'application mobile</b-button
          >
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  computed: {
    loggedIn() {
      return this.$auth.loggedIn
    },
    user() {
      return this.$auth.user
    },
  },
  methods: {
    logout() {
      return this.$auth.logout()
    },
  },
}
</script>

<style>
a,
a:hover,
a:visited {
  color: black;
  text-decoration: inherit;
}
</style>
