<template>
  <div>
    <b-form>
      <b-row>
        <b-col>
          <b-form-group
            id="input-group-1"
            label="Recherche"
            label-for="input-1"
          >
            <b-form-input
              id="input-1"
              v-model="search"
              type="email"
              placeholder="Nom du restaurant"
              required
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            id="input-group-3"
            label="Heure de livraison"
            label-for="input-3"
          >
            <b-form-timepicker
              v-model="time"
              locale="fr"
              formatted="Pas d'heure séléctionnée"
            ></b-form-timepicker>
          </b-form-group>
        </b-col>
      </b-row>

      <div class="horizontal-scroll">
        <b-button v-for="i in 18" :key="i">Filtre {{ i }}</b-button>
      </div>
    </b-form>

    <div class="m-4"></div>

    <div v-if="restaurants === null">Chargement...</div>

    <nuxt-link
      v-for="restaurant in restaurants"
      :key="restaurant.id"
      :to="`/restaurants/${restaurant.id}/menus`"
    >
      <div>
        <div style="height: 180px; background-color: #ccc"></div>

        <b-row>
          <b-col cols="9">
            <div>
              Restaurant <strong>{{ restaurant.name }}</strong>
            </div>
            <div>{{ restaurant.coordinate.full_address }}</div>
          </b-col>

          <b-col>Note: <strong>?/5</strong></b-col>
        </b-row>
      </div>
    </nuxt-link>
  </div>
</template>

<script>
export default {
  async mounted() {
    this.restaurants = await this.$axios
      .get(`${process.env.API_URL}/api/restaurants`)
      .then((response) => response.data)
      .then((j) => j.data)
      .catch(console.error)
  },
  data() {
    return {
      restaurants: null,
      search: '',
      time: null,
    }
  },
}
</script>

<style scoped>
.horizontal-scroll {
  overflow: auto;
  white-space: nowrap;
}
</style>
