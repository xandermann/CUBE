<template>
  <div class="d-flex flex-column align-items-center">
    <b-button class="m-3" @click="validateAddress()"
      >Calculer la localisation</b-button
    >
    <div v-if="getMarker" class="w-100">
      <label :for="title">{{ title }}</label>
      <div style="height: 400px; width: 100%">
        <l-map ref="mymap" :zoom="13" :center="[marker.lat, marker.lng]">
          <l-tile-layer
            url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"
          ></l-tile-layer>
          <l-marker :lat-lng="[marker.lat, marker.lng]"></l-marker>
        </l-map>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    address: Object,
  },
  data() {
    return {
      marker: null,
    }
  },
  computed: {
    getMarker() {
      return this.marker
    },
  },
  mounted() {
    this.marker = null
  },
  methods: {
    validateAddress() {
      if (
        this.address.city !== undefined &&
        this.address.full_address !== undefined &&
        this.address.postal_code !== undefined &&
        this.address.country !== undefined
      ) {
        this.getAddress(
          this.address.full_address +
            ' ' +
            this.address.city +
            ' ' +
            this.address.postal_code +
            ' ' +
            this.address.country
        )
      }
    },
    async getAddress(addressToSearch) {
      await this.$axios
        .$get(
          `https://geocode.search.hereapi.com/v1/geocode?apiKey=CCd9iGrZI7VZTbUVjlF5EqOYfJ1iC0Qzn5LCq0I1BoM&q=${addressToSearch}`
        )
        .then((response) => {
          this.marker = {}
          this.marker.lat = response.items[0].position.lat
          this.marker.lng = response.items[0].position.lng
          this.$emit('lat', response.items[0].position.lat)
          this.$emit('lng', response.items[0].position.lng)
          // this.$emit('input', this.getMarker)
        })
        .catch((error) => {
          alert(JSON.stringify(error))
        })
    },
  },
}
</script>
