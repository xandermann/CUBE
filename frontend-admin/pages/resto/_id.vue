<template>
  <b-container fluid class="p-0">
    <b-overlay :show="$fetchState.pending" rounded="sm">
      <b-alert v-if="$fetchState.error" show variant="danger"
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
        <b-row class="pt-4">
          <b-col>
            <div class="Card">
              <h3>Gestion des stocks :</h3>
              <List :elems="stock" :modal="modaleAjoutStock" />
            </div>
          </b-col>
        </b-row>
        <b-row class="pt-4">
          <b-col>
            <div class="Card">
              <h3>Gestion des plats :</h3>
              <List :elems="plats" :modal="modaleAjoutPlat" />
            </div>
          </b-col>
          <b-col>
            <div class="Card">
              <h3>Gestion des menus :</h3>
              <List :elems="menus" :modal="modaleAjoutMenu" />
            </div>
          </b-col>
        </b-row>
      </div>
    </b-overlay>
  </b-container>
</template>

<script>
import { Restaurant } from '../../assets/models/viewModels/list/Restaurant'
import { ListStockRestaurant } from '../../assets/models/viewModels/list/Stock'
import { ListPlatsRestaurant } from '../../assets/models/viewModels/list/PlatsRestaurants'
import { ListMenusRestaurant } from '../../assets/models/viewModels/list/MenusRestaurants'
import { AjoutStockResto } from '../../assets/models/modales/resto/Add/AjoutStockResto'
import { AjoutPlatResto } from '../../assets/models/modales/resto/Add/AjoutPlatResto'
import { AjoutMenuResto } from '../../assets/models/modales/resto/Add/AjoutMenuResto'
export default {
  data() {
    return {
      stock: new ListStockRestaurant(
        this.$config.apiURL +
          '/api/restaurants/' +
          this.$route.params.id +
          '/stock'
      ),
      plats: new ListPlatsRestaurant(
        this.$config.apiURL +
          '/api/restaurants/' +
          this.$route.params.id +
          '/dishes'
      ),
      menus: new ListMenusRestaurant(
        this.$config.apiURL +
          '/api/restaurants/' +
          this.$route.params.id +
          '/menus'
      ),
      modaleAjoutStock: new AjoutStockResto(this.$route.params.id),
      modaleAjoutPlat: new AjoutPlatResto(this.$route.params.id),
      modaleAjoutMenu: new AjoutMenuResto(this.$route.params.id),
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
