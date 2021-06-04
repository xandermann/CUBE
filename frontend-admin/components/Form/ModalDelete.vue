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
  props: {
    id: Number,
    titreModale: String,
    url: String,
    objectToDelete: Object,
  },
  data() {
    return {
      form: {},
      result: '',
      hiddenActions: false,
      urlDelete:
        this.$props.objectToDelete != null
          ? this.$props.objectToDelete.modalProperties.url
          : this.$props.url,
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

      if (this.$props.objectToDelete != null) {
        const toDelete = {}
        toDelete[
          this.$props.objectToDelete.modalInputs[0].property
        ] = this.$props.objectToDelete.modalInputs[0].defaultValue
        alert(JSON.stringify(toDelete))
        await this.$axios
          .request(this.urlDelete, toDelete, 'delete')
          .then((response) => {
            this.result = "L'élément a été supprimé avec succès"
          })
          .catch((error) => {
            this.result = error
          })
      } else {
        await this.$axios
          .$delete(this.urlDelete)
          .then((response) => {
            this.result = "L'élément a été supprimé avec succès"
          })
          .catch((error) => {
            this.result = error
          })
      }
    },
  },
}
</script>
