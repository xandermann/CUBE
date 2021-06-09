<template>
  <div>
    <h1>Mon compte</h1>

    <client-only>
      <div v-if="$auth.user && coordinates">
        <b-form action="">
          <b-form-group label="Adresse email">
            <b-form-input
              type="email"
              placeholder="Adresse email"
              :value="$auth.user.email"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Prénom">
            <b-form-input
              type="text"
              placeholder="Prénom"
              :value="$auth.user.firstname"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Nom">
            <b-form-input
              type="text"
              placeholder="Nom"
              :value="$auth.user.lastname"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Ville">
            <b-form-input
              v-model="coordinates.city"
              type="text"
              placeholder="Ville"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Code postal">
            <b-form-input
              v-model="coordinates.postal_code"
              type="text"
              placeholder="Code postal"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Pays">
            <b-form-input
              v-model="coordinates.country"
              type="text"
              placeholder="Pays"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Numéro de téléphone">
            <b-form-input
              v-model="coordinates.number_phone"
              type="text"
              placeholder="Numéro de téléphone"
              required
            ></b-form-input>
          </b-form-group>

          <b-button variant="success">Sauvegarder</b-button>
        </b-form>

        <hr class="mt-4 mb-4" />

        <h2>Télécharger vos données</h2>

        <b-button variant="success"
          >Demandez une archive avec vos données personnelles</b-button
        >

        <hr class="mt-4 mb-4" />

        <h2>Supprimez votre compte</h2>

        <b-button variant="danger">Supprimez votre compte</b-button>

        <hr class="mt-4 mb-4" />
      </div>
    </client-only>
  </div>
</template>

<script>
export default {
  data() {
    return {
      coordinates: {},
    }
  },
  mounted() {
    this.$axios
      .get(`${process.env.API_URL}/api/coordinates`, {
        withCredentials: true,
      })
      .then((response) => response.data)
      .then((coordinates) => (this.coordinates = coordinates))
  },
}
</script>
