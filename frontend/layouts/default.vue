<template>
  <div>
    <div class="fixed-bottom p-4" v-if="!cookie_banner_hidden">
      <div class="bg-dark text-white w-100 mw-100" role="alert">
        <div class="toast-body p-4 d-flex flex-column">
          <h4>Cookies</h4>
          <p>
            Ce site utilise des cookies pour vous offrir le meilleur service. En
            poursuivant votre navigation, vous acceptez l’utilisation des
            cookies.
          </p>
          <div class="ml-auto">
            <button
              type="button"
              class="btn btn-outline-light mr-3"
              @click="cookie_banner_hidden = true"
            >
              Je refuse
            </button>
            <button
              type="button"
              class="btn btn-light"
              @click="cookie_banner_hidden = true"
            >
              J'accepte
            </button>
          </div>
        </div>
      </div>
    </div>

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
        <div class="col-lg-8 col-sm-12">
          <Nuxt />
        </div>
        <div class="d-none d-lg-block">
          <p>À compléter</p>

          <b-button variant="success"
            >Télécharger l'application mobile</b-button
          >
        </div>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cookie_banner_hidden: false,
    }
  },
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
