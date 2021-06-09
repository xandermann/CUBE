<template>
  <div>
    <div v-for="order in orders" :key="order.id">
      <h1>Commande numero #{{ order.id }}</h1>

      <h2>Total: {{ order.total_price | price }}</h2>
      <p :var="(d = new Date(order.created_at))">
        Passée le {{ d.getDate() }}/{{ d.getMonth() }}/{{ d.getFullYear() }} à
        {{ d.getHours() }}:{{ d.getMinutes() }}
      </p>

      <b-button
        variant="primary"
        :href="`${API_URL}/pdf/invoices/${order.id}`"
        target="_blank"
        >Voir la facture</b-button
      >

      <p>Liste des plats commandés:</p>

      <table class="table">
        <tr v-for="dish in order.dishes" :key="dish.id">
          <td>{{ dish.name }}</td>
          <td>{{ dish.price | price }}</td>
        </tr>
      </table>

      <b-row>
        <b-col class="pt-4">
          <p>Noter le restaurant</p>
        </b-col>
        <b-col>
          <div class="rating rating2">
            <!--
		--><a href="#5" title="Give 5 stars" @click="note(order, 5)">★</a
            ><!--
		--><a href="#4" title="Give 4 stars" @click="note(order, 4)">★</a
            ><!--
		--><a href="#3" title="Give 3 stars" @click="note(order, 3)">★</a
            ><!--
		--><a href="#2" title="Give 2 stars" @click="note(order, 2)">★</a
            ><!--
		--><a href="#1" title="Give 1 star" @click="note(order, 1)">★</a>
          </div>
        </b-col>
      </b-row>

      <details>
        <summary>Signaler un soucis avec la commande</summary>

        <b-form-textarea
          id="textarea"
          v-model="order.complaint"
          placeholder="Entrez la plainte ici"
          rows="3"
          max-rows="6"
        ></b-form-textarea>

        <b-button variant="warning" @click="complaint(order)">Valider</b-button>
      </details>

      <div class="mt-4 mb-4">&nbsp;</div>
    </div>
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
  data() {
    return {
      API_URL: process.env.API_URL,
      orders: [],
    }
  },
  mounted() {
    this.$axios
      .get(`${process.env.API_URL}/api/users/1/orders`)
      .then((response) => response.data)
      .then((paginate) => paginate.data)
      .then((orders) => (this.orders = orders))
      .catch(() => {})
  },
  methods: {
    note(order, value) {
      this.$axios
        .post(
          `${process.env.API_URL}/api/users/${this.$auth.user.id}/reviews`,
          {
            restaurant_id: order.restaurant_id,
            note: value,
            message: '-',
          },
          {
            withCredentials: true,
          }
        )
        .catch(() => {})
    },
    complaint(order) {},
  },
}
</script>

<style>
.rating {
  width: 226px;
  margin: 0 auto 1em;
  font-size: 45px;
  overflow: hidden;
}
.rating a {
  float: right;
  color: #aaa;
  text-decoration: none;
  -webkit-transition: color 0.4s;
  -moz-transition: color 0.4s;
  -o-transition: color 0.4s;
  transition: color 0.4s;
}
.rating a:hover,
.rating a:hover ~ a,
.rating a:focus,
.rating a:focus ~ a {
  color: orange;
  cursor: pointer;
}
.rating2 {
  direction: rtl;
}
.rating2 a {
  float: none;
}
</style>
