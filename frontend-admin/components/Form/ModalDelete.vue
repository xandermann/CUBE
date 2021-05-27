<template>
  <b-modal
    :id="'Delete' + id"
    :title="'Supprimer ' + titreModale"
    :hide-footer="hiddenActions"
    @ok="submitForm"
  >
    <b-alert v-if="result" show>{{ result }}</b-alert>
    <b-form v-if="!hiddenActions">
      <p>Cette suppression est irréversible</p>
    </b-form>
  </b-modal>
</template>

<script>
export default {
  props: { id: Number, titreModale: String, url: String },
  data() {
    return {
      form: {},
      result: '',
      hiddenActions: false,
    }
  },
  methods: {
    submitForm(event) {
      event.preventDefault()
      this.deleteEntity(this.$props.url)
    },
    async deleteEntity(url) {
      this.hiddenActions = true
      this.result = 'Suppression en cours'
      await this.$axios
        .$delete(url)
        .then((response) => {
          this.result = "L'élément a été supprimé avec succès"
        })
        .catch((error) => {
          this.result = error
        })
    },
  },
}
</script>
