<template>
  <b-container fluid class="p-0">
    <span v-if="$fetchState.pending" class="loading"></span>
    <b-alert v-else-if="$fetchState.error" show variant="danger"
      >Une erreur s'est produite, merci de contacter votre
      administrateur</b-alert
    >
    <div class="p-5">
      <b-row>
        <b-col col sm="12" md="6">
          <div class="Card">
            <h3>{{ resto.nom }}</h3>
            <p>Adresse : {{ resto.adresseComplete }}</p>
            <p>Pays : {{ resto.pays }}</p>
            <p>Ville : {{ resto.ville }}</p>
            <p>Téléphone : {{ resto.telephone }}</p>
          </div>
        </b-col>
        <b-col col sm="12" md="6">
          <div class="Card">
            <h3>Ventes :</h3>
            <p>Aujourd'hui : 15</p>
          </div>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <div class="Card">
            <h3>Gestion des stocks :</h3>
          </div>
        </b-col>
      </b-row>
    </div>
  </b-container>
</template>
<style scoped>
.Card {
  background-color: lightblue;
  margin: 5px;
  padding: 5px;
  width: 100%;
  height: 100%;
  border-radius: 5px;
}
.Card p {
  font-size: 15px !important;
}
</style>
<script>
import { Restaurant } from '../../assets/models/viewModels/list/Restaurant'
export default {
  data() {
    return {
      resto: {},
    }
  },
  async fetch() {
    const id = this.$route.params.id
    try {
      const url = this.$config.apiURL + '/api/restaurants/' + id
      this.resto = await fetch(url)
        .then((res) => res.json())
        .then((rest) => new Restaurant(rest))
    } catch {
      this.resto = {}
    }
  },
}
</script>
