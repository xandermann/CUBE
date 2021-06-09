<template>
  <div>
    <b-alert v-model="showError" variant="danger" dismissible
      >Ooops, quelque chose c'est mal passé</b-alert
    >

    <template v-if="restaurant">
      <h2>{{ restaurant.name }}</h2>
      <p>Note: 4/5</p>

      <div class="border">
        <div>Restaurant: {{ restaurant.name }}</div>
        <div>Adresse: {{ restaurant.coordinate.full_address }}</div>
        <div>Téléphone: {{ restaurant.coordinate.number_phone }}</div>
      </div>

      <hr />

      <h1>Carte</h1>

      <div v-for="menu in menus" :key="menu.id" class="border">
        <b-row class="m-1 p-2">
          <b-col>
            <h2>Menu: {{ menu.name }}</h2>
            <p>Le prix de ce menu est {{ menu.price }}€</p>
          </b-col>

          <b-col>
            <b-button variant="success" @click="addMenu(menu)"
              >Ajouter ({{ menu.quantity }})</b-button
            >

            <b-button variant="warning" @click="removeMenu(menu)"
              >Supprimer ({{ menu.quantity }})</b-button
            >

            <p>Total {{ (menu.quantity * menu.price) | price }}</p>
            <!-- <p>[TODO: image]</p> -->
          </b-col>
        </b-row>

        <div class="mt-4">Dans ce menu vous trouverez les plats suivants:</div>

        <div v-for="dish in menu.dishes" :key="dish.id">
          <b-row class="m-1 p-2">
            <b-col>
              <h3>{{ dish.name }}</h3>
              <p>Le prix de ce plat est {{ dish.price }}€</p>
            </b-col>

            <b-col>
              <b-button variant="success" @click="addDish(dish)"
                >Ajouter {{ dish.quantity }}</b-button
              >
              <b-button variant="warning" @click="removeDish(dish)"
                >Supprimer {{ dish.quantity }}</b-button
              >

              <p>Total: {{ (dish.quantity * dish.price) | price }}</p>
            </b-col>
          </b-row>
        </div>
      </div>

      <div class="mt-4"></div>

      <!-- <nuxt-link to="/basket"> -->
      <b-row>
        <b-col>
          <h3>Prix: {{ (Math.round(total * 100) / 100) | price }}</h3>
        </b-col>
        <b-col>
          <b-button variant="info" class="mb-4" @click="pay"
            >Passer la commande</b-button
          >
        </b-col>
      </b-row>
      <!-- </nuxt-link> -->
    </template>
  </div>
</template>

<script>
export default {
  filters: {
    price(price) {
      const p = `${(Math.round(price * 100) / 100).toFixed(2)}`.replace(
        '.',
        ','
      )

      return `${p}€`
    },
  },
  middleware: 'auth',
  data() {
    return {
      restaurant: null,
      menus: [],
      showError: false,
    }
  },
  computed: {
    total() {
      return (
        this.menus.reduce((acc, menu) => {
          return (
            acc +
            menu.quantity * menu.price +
            menu.dishes.reduce((acc, dish) => {
              return acc + dish.quantity * dish.price
            }, 0)
          )
        }, 0) + 0.5
      )
    },
  },
  mounted() {
    this.$axios
      .get(`${process.env.API_URL}/api/restaurants/${this.$route.params.id}`)
      .then((response) => response.data)
      .then((restaurant) => (this.restaurant = restaurant))
      .catch(() => {})

    this.$axios
      .get(
        `${process.env.API_URL}/api/restaurants/${this.$route.params.id}/menus`
      )
      .then((response) => response.data)
      .then((paginate) => paginate.data)

      .then((menus) => {
        menus.forEach((menu) => {
          menu.quantity = 0

          menu.dishes.forEach((dish) => {
            dish.quantity = 0
          })
        })

        this.menus = menus
      })
      .catch(() => {})
  },
  methods: {
    addMenu(menu) {
      menu.quantity++
    },
    removeMenu(menu) {
      if (menu.quantity === 0) return
      menu.quantity--
    },
    addDish(dish) {
      dish.quantity++
    },
    removeDish(dish) {
      if (dish.quantity === 0) return
      dish.quantity--
    },
    pay() {
      const sum = this.menus.reduce((acc, menu) => acc + menu.quantity)
      if (sum <= 0) return

      this.$axios
        .post(
          `${process.env.API_URL}/api/orders`,
          {
            restaurant_id: this.restaurant.id,
            menus: this.menus,
            date: new Date(),
            dishes: [],
          },
          { withCredentials: true }
        )
        .then(() => this.$router.push('/orders'))
        .catch(() => (this.showError = true))
    },
  },
}
</script>
