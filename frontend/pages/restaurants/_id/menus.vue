<template>
  <div>
    <template v-if="restaurant">
      <h2>{{ restaurant.name }}</h2>
      <p>Note: 4/5</p>

      <div class="border">
        <div>Restaurant: {{ restaurant.name }}</div>
        <div>Adresse: {{ restaurant.coordinate.full_address }}</div>
        <div>Téléphone: {{ restaurant.coordinate.number_phone }}</div>
      </div>
    </template>

    <hr />

    <h1>Carte</h1>

    <div v-for="menu in menus" :key="menu.id" class="border">
      <b-row class="m-1 p-2">
        <b-col>
          <h2>{{ menu.name }}</h2>

          <p>{{ menu.price }}€</p>
        </b-col>

        <b-col>
          <b-button @click="addItem(menu)"
            >Ajouter ({{ menu.nb_taken }})</b-button
          >

          <b-button @click="removeItem(menu)"
            >Supprimer ({{ menu.nb_taken }})</b-button
          >
          <p>[TODO: image]</p>
        </b-col>
      </b-row>
    </div>

    <div class="mt-4"></div>

    <nuxt-link to="/basket">
      <b-button variant="success">Passer la commande</b-button>
    </nuxt-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      restaurant: null,
      menus: [],
    }
  },
  mounted() {
    this.$axios
      .get(`${process.env.API_URL}/api/restaurants/1`)
      .then((response) => response.data)
      .then((restaurant) => (this.restaurant = restaurant))
      .catch(console.error)

    this.$axios
      .get(`${process.env.API_URL}/api/restaurants/1/menus`)
      .then((response) => response.data)
      .then((paginate) => paginate.data)

      .then((menus) => {
        menus.forEach((menu) => {
          menu.nb_taken = 0
        })

        this.menus = menus
      })
      .catch(console.error)
  },
  methods: {
    addItem(menu) {
      menu.nb_taken++
    },
    removeItem(menu) {
      if (menu.nb_taken === 0) return
      menu.nb_taken--
    },
  },
}
</script>
