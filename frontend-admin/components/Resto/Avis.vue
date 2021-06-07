<template>
  <div>
    <b-overlay :show="$fetchState.pending" rounded="sm">
      <span>Avis : </span>
      <b-form-rating
        v-model="rating"
        inline
        readonly
        no-border
        variant="warning"
        show-value
        @click.native="showAvis"
      ></b-form-rating>
    </b-overlay>
  </div>
</template>
<script>
export default {
  data() {
    return {
      rating: 0,
    }
  },
  async fetch() {
    let noteTemp = 0
    let nbNotes = 0
    const id = this.$route.params.id
    try {
      const url = this.$config.apiURL + '/api/restaurants/' + id + '/reviews'
      this.resto = await fetch(url)
        .then((res) => res.json())
        .then((rest) =>
          rest.data.map((note) => {
            noteTemp += parseFloat(note.pivot.note)
            nbNotes++
            return noteTemp / nbNotes
          })
        )
        .then(() => (this.rating = Math.round(noteTemp / nbNotes)))
    } catch {
      this.resto = {}
    }
  },
  methods: {
    showAvis() {
      this.$router.push({
        path: this.$route.params.id + `/avis`,
      })
    },
  },
}
</script>
