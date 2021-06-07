<template>
  <b-modal
    :id="'Delete' + id"
    :title="'Supprimer ' + titreModale"
    :hide-footer="hiddenActions"
    @ok="submitForm"
    @close="$emit('hasBeenHidden', true)"
  >
    <b-progress
      v-if="result == 'pending'"
      variant="info"
      :animated="true"
      class="mt-3"
      ><b-progress-bar :value="100"
        ><span>Suppression en cours</span></b-progress-bar
      ></b-progress
    >
    <b-progress
      v-if="result == 'success'"
      variant="success"
      :animated="false"
      class="mt-3"
      ><b-progress-bar :value="100"
        ><span>Suppression réussie</span></b-progress-bar
      ></b-progress
    >
    <b-progress
      v-if="result == 'error'"
      :value="100"
      variant="danger"
      :animated="false"
      class="mt-3"
      ><b-progress-bar :value="100"
        ><span>Suppression échouée : {{ errorMessage }}</span></b-progress-bar
      ></b-progress
    >
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
      errorMessage: '',
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
      this.result = 'pending'

      if (this.$props.objectToDelete != null) {
        const toDelete = {}
        toDelete[
          this.$props.objectToDelete.modalInputs[0].property
        ] = this.$props.objectToDelete.modalInputs[0].defaultValue
        await this.$axios
          .request(this.urlDelete, toDelete, 'delete')
          .then((response) => {
            this.result = 'success'
          })
          .catch((error) => {
            this.result = 'error'
            this.errorMessage = error
          })
      } else {
        await this.$axios
          .$delete(this.urlDelete)
          .then((response) => {
            this.result = 'success'
          })
          .catch((error) => {
            this.result = 'error'
            this.errorMessage = error
          })
      }
    },
  },
}
</script>
