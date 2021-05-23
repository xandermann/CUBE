<template>
  <b-modal :id="'Delete' + id" :title="'Supprimer ' + titreModale">
    <b-form>
      <p>Cette suppression est irréversible</p>
    </b-form>
  </b-modal>
</template>

<script>
export default {
  props: { id: Number, titreModale: String },
  data() {
    return {
      form: {},
    }
  },
}
</script>
