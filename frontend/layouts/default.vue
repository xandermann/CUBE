<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="/">GoodFood</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <client-only>
          <b-navbar-nav v-if="loggedIn">
            <b-nav-item href="restaurants">Liste des restaurants</b-nav-item>
            <!--
          <b-nav-item href="#" disabled>Disabled</b-nav-item>
        -->
          </b-navbar-nav>
        </client-only>

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
                <b-dropdown-item href="#">Mon compte</b-dropdown-item>
                <b-dropdown-item href="logout">Se déconnecter</b-dropdown-item>
              </b-nav-item-dropdown>
            </template>

            <template v-if="!loggedIn">
              <b-navbar-nav right>
                <b-nav-item href="login">Connexion</b-nav-item>
                <b-nav-item href="#">Inscription</b-nav-item>
              </b-navbar-nav>
            </template>
          </client-only>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <b-container class="mt-4">
      <b-row class="text-center">
        <b-col cols="8">
          <Nuxt />
        </b-col>
        <b-col>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero nihil
            maxime in quidem deleniti qui tenetur tempore numquam omnis rem quia
            quis dolores sit fugit nobis animi dicta perspiciatis reprehenderit
            quos, dolorem expedita excepturi, eveniet vel repellendus? Eaque
            dolor facilis provident ratione minus iure magnam optio eligendi
            soluta nostrum saepe, tempora distinctio fuga neque explicabo
            suscipit architecto debitis rerum repellat animi hic assumenda.
            Voluptas iusto officia laudantium dolorum? Quibusdam similique
            cumque, eaque ullam laboriosam illum! Minima enim quae rem quis
            quam, tempora tenetur iste aperiam eum dolor? Numquam, maiores nam
            quasi porro excepturi veniam soluta hic inventore totam, vel ipsam.
          </p>

          <b-button>Télécharger l'application mobile</b-button>
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
}
</script>
